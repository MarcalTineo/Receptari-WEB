<?php
class Tag
{
   private $id = "";
   private $name = "";
   private $description = "";
   private $created_at = "";
   private $modified_at = "";

   public function __construct($id)
   {
      if ($id != 0) {
         $read = Tag::read($id);
         foreach ($read as $key => $value) {
            $this->id = $value['id'];
            $this->name = $value['name'];
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
   public function getName()
   {
      return $this->name;
   }
   public function setName($name)
   {
      $this->name = $name;
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
      Tag::update($this->id, $this->name, $this->description);
   }

   public function deleteSelf()
   {
      Tag::delete($this->id);
   }

   //CRUD
   public static function read($id)
   {
      $conn = (new Connection("localhost", "root", "", "receptari"))->connect();
      $result = $conn->query("SELECT * FROM tags WHERE id = $id");
      $conn->close();
      return $result;
   }

   public static function create($name, $description)
   {
      $conn = (new Connection("localhost", "root", "", "receptari"))->connect();
      $conn->query("INSERT INTO tags (name, description) VALUES ('$name', '$description')");
      $conn->close();
   }

   public static function update($id, $name, $description)
   {
      $conn = (new Connection("localhost", "root", "", "receptari"))->connect();
      $conn->query("UPDATE tags SET name = '$name', description = '$description' WHERE id = $id");
      $conn->close();
   }

   public static function delete($id)
   {
      $conn = (new Connection("localhost", "root", "", "receptari"))->connect();
      $conn->query("DELETE FROM tags WHERE id = $id");
      $conn->close();
   }
}
?>