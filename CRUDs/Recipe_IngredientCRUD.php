<?php
class Recipe_Ingredient
{
   private $id = "";
   private $recipe_id = "";
   private $ingredient_id = "";
   private $quantity = "";
   private $unit_id = "";
   private $created_at = "";
   private $modified_at = "";

   public function __construct($id)
   {
      if ($id != 0) {
         $read = Recipe_Ingredient::read($id);
         foreach ($read as $key => $value) {
            $this->id = $value['id'];
            $this->recipe_id = $value['recipe_id'];
            $this->ingredient_id = $value['ingredient_id'];
            $this->quantity = $value['quantity'];
            $this->unit_id = $value['unit_id'];
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
   public function getIngredientId()
   {
      return $this->ingredient_id;
   }
   public function setIngredientId($ingredient_id)
   {
      $this->ingredient_id = $ingredient_id;
   }
   public function getQuantity()
   {
      return $this->quantity;
   }
   public function setQuantity($quantity)
   {
      $this->quantity = $quantity;
   }
   public function getUnitId()
   {
      return $this->unit_id;
   }
   public function setUnitId($unit_id)
   {
      $this->unit_id = $unit_id;
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
      Recipe_Ingredient::update($this->id, $this->recipe_id, $this->ingredient_id, $this->quantity, $this->unit_id);
   }

   public function deleteSelf()
   {
      Recipe_Ingredient::delete($this->id);
   }

   public static function read($id)
   {
      $conn = (new Connection("localhost", "root", "", "receptari"))->connect();
      $result = $conn->query("SELECT * FROM recipe_ingredients WHERE id = $id");
      $conn->close();
      return $result;
   }

   public static function readWithRecipeId($recipe_id)
   {
      $conn = (new Connection("localhost", "root", "", "receptari"))->connect();
      $result = $conn->query("SELECT * FROM recipe_ingredients WHERE recipe_id = $recipe_id");
      $conn->close();
      return $result;
   }

   public static function create($recipe_id, $ingredient_id, $quantity, $unit_id)
   {
      $conn = (new Connection("localhost", "root", "", "receptari"))->connect();
      $conn->query("INSERT INTO recipe_ingredients (recipe_id, ingredient_id, quantity, unit_id) VALUES ($recipe_id, $ingredient_id, $quantity, $unit_id)");
      $conn->close();
   }

   public static function update($id, $recipe_id, $ingredient_id, $quantity, $unit_id)
   {
      $conn = (new Connection("localhost", "root", "", "receptari"))->connect();
      $conn->query("UPDATE recipe_ingredients SET recipe_id = $recipe_id, recipe_id = $recipe_id,  quantity = $quantity, unit_id = $unit_id WHERE id = $id");
      $conn->close();
   }

   public static function delete($id)
   {
      $conn = (new Connection("localhost", "root", "", "receptari"))->connect();
      $conn->query("DELETE FROM recipe_ingredients WHERE id = $id");
      $conn->close();
   }

}
?>