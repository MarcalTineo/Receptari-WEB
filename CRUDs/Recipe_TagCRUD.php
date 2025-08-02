<?php
class Recipe_TagCRUD
{
   private $id = "";
   private $recipe_id = "";
   private $tag_id = "";
   private $created_at = "";
   private $modified_at = "";

   public function __construct($id)
   {
      if ($id != 0) {
         $read = Recipe_TagCRUD::read($id);
         foreach ($read as $key => $value) {
            $this->id = $value['id'];
            $this->recipe_id = $value['recipe_id'];
            $this->tag_id = $value['tag_id'];
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
   public function getTagId()
   {
      return $this->tag_id;
   }
   public function setTagId($tag_id)
   {
      $this->tag_id = $tag_id;
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
      Recipe_TagCRUD::update($this->id, $this->recipe_id, (int) $this->tag_id);
   }

   public function deleteSelf()
   {
      Recipe_TagCRUD::delete($this->id);
   }

   public static function read($id)
   {
      $conn = (new Connection("localhost", "root", "", "receptari"))->connect();
      $result = $conn->query("SELECT * FROM `recipe_tags` WHERE id = $id");
      $conn->close();
      return $result;
   }

   public static function readWithRecipeId($recipe_id)
   {
      $conn = (new Connection("localhost", "root", "", "receptari"))->connect();
      $result = $conn->query("SELECT * FROM `recipe_tags` WHERE recipe_id = $recipe_id");
      $conn->close();
      return $result;
   }

   public static function create($recipe_id, $tag_id)
   {
      $conn = (new Connection("localhost", "root", "", "receptari"))->connect();
      $conn->query("INSERT INTO `recipe_tags` (recipe_id, tag_id) VALUES ($recipe_id, $tag_id)");
      $conn->close();
   }

   public static function update($id, $recipe_id, $tag_id)
   {
      $conn = (new Connection("localhost", "root", "", "receptari"))->connect();
      $conn->query("UPDATE `recipe_tags` SET recipe_id = $recipe_id, tag_id = $tag_id  WHERE id = $id");
      $conn->close();
   }

   public static function delete($id)
   {
      $conn = (new Connection("localhost", "root", "", "receptari"))->connect();
      $conn->query("DELETE FROM `recipe_tags` WHERE id = $id");
      $conn->close();
   }


}
?>