<?php
class Recipe_CategoryCRUD
{
   private $id = "";
   private $recipe_id = "";
   private $category_id = "";
   private $created_at = "";
   private $modified_at = "";

   public function __construct($id)
   {
      if ($id != 0) {
         $read = Recipe_CategoryCRUD::read($id);
         foreach ($read as $key => $value) {
            $this->id = $value['id'];
            $this->recipe_id = $value['recipe_id'];
            $this->category_id = $value['category_id'];
            $this->created_at = $value['created_at'];
            $this->modified_at = $value['modified_at'];
         }
      }
   }
   public function getId()
   {
      return $this->id;
   }
   public function getRecipeId()
   {
      return $this->recipe_id;
   }
   public function setRecipeId($recipe_id)
   {
      $this->recipe_id = $recipe_id;
   }
   public function getCategoryId()
   {
      return $this->category_id;
   }
   public function setCategoryId($category_id)
   {
      $this->category_id = $category_id;
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
      Recipe_CategoryCRUD::update($this->id, $this->recipe_id, $this->category_id);
   }

   public function deleteSelf()
   {
      Recipe_CategoryCRUD::delete($this->id);
   }

   public static function read($id)
   {
      $conn = (new Connection("localhost", "root", "", "receptari"))->connect();
      $result = $conn->query("SELECT * FROM `recipe_category` WHERE id = $id");
      $conn->close();
      return $result;
   }

   public static function readWithRecipeId($recipe_id)
   {
      $conn = (new Connection("localhost", "root", "", "receptari"))->connect();
      $result = $conn->query("SELECT * FROM `recipe_category` WHERE recipe_id = $recipe_id");
      $conn->close();
      return $result;
   }

   public static function create(int $recipe_id, int $category_id)
   {
      $conn = (new Connection("localhost", "root", "", "receptari"))->connect();
      $conn->query("INSERT INTO `recipe_category` (recipe_id, category_id) VALUES ($recipe_id, $category_id)");
      $conn->close();
   }

   public static function update($id, $recipe_id, $category_id)
   {
      $conn = (new Connection("localhost", "root", "", "receptari"))->connect();
      $conn->query("UPDATE `recipe_category` SET recipe_id = $recipe_id, category_id = $category_id  WHERE id = $id");
      $conn->close();
   }

   public static function delete($id)
   {
      $conn = (new Connection("localhost", "root", "", "receptari"))->connect();
      $conn->query("DELETE FROM `recipe_category` WHERE id = $id");
      $conn->close();
   }


}
?>