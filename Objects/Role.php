<?php
class Role
{
   private $id = "";
   private $role = "";
   private $description = "";
   private $created_at = "";
   private $modified_at = "";

   public function __construct($id)
   {
      if ($id != 0) {
         $read = Role::read($id);
         foreach ($read as $key => $value) {
            $this->id = $value['id'];
            $this->role = $value['role'];
            $this->description = $value['description'];
            $this->created_at = $value['created_at'];
            $this->modified_at = $value['modified_at'];
         }
      }
   }

   public function getId()
   {
      return $this->id;
   }

   public function getRole()
   {
      return $this->role;
   }

   public function setRole($role)
   {
      $this->role = $role;
   }

   public function getDescription()
   {
      return $this->description;
   }

   public function setDescription($description)
   {
      $this->description = $description;
   }

   public function getCreatedAt()
   {
      return $this->created_at;
   }

   public function getModifiedAt()
   {
      return $this->modified_at;
   }

   public function updateSelf()
   {
      Role::update($this->id, $this->role, $this->description);
   }

   public function deleteSelf()
   {
      Role::delete($this->id);
   }

   public static function read($id)
   {
      $conn = (new Connection("localhost", "root", "", "receptari"))->connect();
      $result = $conn->query("SELECT * FROM roles WHERE id = $id");
      $conn->close();
      return $result;
   }

   public static function create($role, $description)
   {
      $conn = (new Connection("localhost", "root", "", "receptari"))->connect();
      $conn->query("INSERT INTO roles (role, description) VALUES ('$role', '$description')");
      $conn->close();
   }

   public static function update($id, $role, $description)
   {
      $conn = (new Connection("localhost", "root", "", "receptari"))->connect();
      $conn->query("UPDATE roles SET role = '$role', description = '$description' WHERE id = $id");
      $conn->close();
   }

   public static function delete($id)
   {
      $conn = (new Connection("localhost", "root", "", "receptari"))->connect();
      $conn->query("DELETE FROM roles WHERE id = $id");
      $conn->close();
   }

}
?>