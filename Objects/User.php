<?php
class User
{
   private $id = "";
   private $name = "";
   private $surname1 = "";
   private $surname2 = "";
   private $role_id = "";
   private $email = "";
   private $phone = "";
   private $username = "";
   private $password = "";
   private $address = "";
   private $recipes_created = "";
   private $last_access = "";
   private $created_at = "";
   private $modified_at = "";



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
   public function getSurname1()
   {
      return $this->surname1;
   }
   public function setSurname1($surname1)
   {
      $this->surname1 = $surname1;
   }
   public function getSurname2()
   {
      return $this->surname2;
   }
   public function setSurname2($surname2)
   {
      $this->surname2 = $surname2;
   }
   public function getRoleId()
   {
      return $this->role_id;
   }
   public function setRoleId($role_id)
   {
      $this->role_id = $role_id;
   }
   public function getEmail()
   {
      return $this->email;
   }
   public function setEmail($email)
   {
      $this->email = $email;
   }
   public function getPhone()
   {
      return $this->phone;
   }
   public function setPhone($phone)
   {
      $this->phone = $phone;
   }
   public function getUsername()
   {
      return $this->username;
   }
   public function setUsername($username)
   {
      $this->username = $username;
   }
   public function getPassword()
   {
      return $this->password;
   }
   public function setPassword($password)
   {
      $this->password = $password;
   }
   public function getAddress()
   {
      return $this->address;
   }
   public function setAddress($address)
   {
      $this->address = $address;
   }
   public function getRecipesCreated()
   {
      return $this->recipes_created;
   }
   public function setRecipesCreated($recipes_created)
   {
      $this->recipes_created = $recipes_created;
   }
   public function getLastAccess()
   {
      return $this->last_access;
   }
   public function setLastAccess($last_access)
   {
      $this->last_access = $last_access;
   }
   public function getCreatedAt()
   {
      return $this->created_at;
   }
   public function getModifiedAt()
   {
      return $this->modified_at;
   }

   /**
    * Creates this user object in the database.
    * @return void
    */
   public function createSelf()
   {
      User::create(
         $this->name,
         $this->surname1,
         $this->surname2,
         $this->role_id,
         $this->email,
         $this->phone,
         $this->username,
         $this->password,
         $this->address,
         $this->recipes_created,
         $this->last_access
      );
   }
   public function updateSelf()
   {
      User::update(
         $this->id,
         $this->name,
         $this->surname1,
         $this->surname2,
         $this->role_id,
         $this->email,
         $this->phone,
         $this->username,
         $this->password,
         $this->address,
         $this->recipes_created,
         $this->last_access
      );
   }
   public function deleteSelf()
   {
      //delete reviws
      $reviews = Review::readWithUserId($this->id);
      foreach ($reviews as $value) {
         Review::delete($value['id']);
      }
      //assign all created recipes by this user to Anonymous.
      $recipes = Recipe::readWithUserId($this->id);
      foreach ($recipes as $key => $value) {
         $recipe = new Recipe($value['id']);
         $recipe->setUserAutorId(1);//id 1 is reserved for "Anonymous" user.
         $recipe->updateSelf();
      }

      User::delete($this->id);
   }

   public static function create($name, $surname1, $surname2, $role_id, $email, $phone, $username, $password, $address, $recipes_created, $last_access)
   {
      $conn = (new Connection("localhost", "root", "", "receptari"))->connect();
      $result = $conn->query("INSERT INTO users (name, surname1, surname2, role_id, email, phone, username, password, address, recipes_created, last_acces) VALUES 
      ('$name', '$surname1', '$surname2', $role_id, '$email', '$phone', '$username', '$password', '$address', $recipes_created, '$last_access')");
      $conn->close();
      return $result;
   }
   public static function read($id)
   {
      $conn = (new Connection("localhost", "root", "", "receptari"))->connect();
      $result = $conn->query("SELECT * FROM users WHERE id = $id");
      $conn->close();
      return $result;
   }
   public static function update($id, $name, $surname1, $surname2, $role_id, $email, $phone, $username, $password, $address, $recipes_created, $last_access)
   {
      $conn = (new Connection("localhost", "root", "", "receptari"))->connect();
      $result = $conn->query("UPDATE users SET name = '$name', surname1 = '$surname1', surname2 = '$surname2', role_id = $role_id, email = '$email',
      phone = '$phone', username = '$username', password = '$password' address = '$address', recipes_created = '$recipes_created', last_acces = '$last_access' WHERE id = $id");
      $conn->close();
      return $result;
   }
   public static function delete($id)
   {
      $conn = (new Connection("localhost", "root", "", "receptari"))->connect();
      $result = $conn->query("DELETE FROM users WHERE id = $id");
      $conn->close();
      return $result;
   }



}
?>