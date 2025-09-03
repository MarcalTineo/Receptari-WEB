<?php
class Recipe
{
   private $id = "";
   private $name = "";
   private $description = "";
   private $categories_id = [];
   private $tags_id = [];
   private $ingredients = [];
   private $steps = [];
   private $reviews_id = [];
   private $user_autor_id = "";
   private $created_at = "";
   private $modified_at = "";

   public function __construct($id)
   {
      //if the constructor is called with id 0, will return an empty recipe.
      if ($id != 0) {
         $read = Recipe::read($id);
         foreach ($read as $key => $value) {
            $this->id = $value['id'];
            $this->name = $value['name'];
            $this->description = $value['description'];
            $this->user_autor_id = $value['user_autor_id'];
            $this->created_at = $value['created_at'];
            $this->modified_at = $value['modified_at'];
         }
         //other stuff
         //tags
         $tags_return = Recipe_TagCRUD::readWithRecipeId($id);
         foreach ($tags_return as $key => $value) {
            array_push($this->tags_id, (int) $value['tag_id']);
         }

         //categories
         $categories_return = Recipe_CategoryCRUD::readWithRecipeId($id);
         foreach ($categories_return as $key => $value) {
            array_push($this->categories_id, (int) $value['category_id']);
         }

         //ingredients
         $ingredients_return = Recipe_Ingredient::readWithRecipeId($id);
         foreach ($ingredients_return as $key => $value) {
            array_push(
               $this->ingredients,
               [
                  'ingredient_id' => (int) $value['ingredient_id'],
                  'quantity' => (float) $value['quantity'],
                  'unit_id' => (int) $value['unit_id']
               ]
            );
         }

         //steps
         $steps_return = Step::readWithRecipeId($id);
         foreach ($steps_return as $key => $value) {
            array_push(
               $this->steps,
               [
                  'step_index' => (int) $value['step_index'],
                  'text' => $value['text']
               ]
            );
         }
         //ordernar els passos
         // usort($this->steps, function ($a, $b) {
         //    return $b[0] <=> $a[0];
         // });

         //reviews
         $reviews_return = Review::readWithRecipeId($id);
         foreach ($reviews_return as $key => $value) {
            array_push($this->reviews_id, (int) $value['id']);
         }
      }
   }

   public function getId()
   {
      return $this->id;
   }

   public static function getValidIds()
   {
      $conn = (new Connection("localhost", "root", "", "receptari"))->connect();
      $result = $conn->query("SELECT * FROM recipes");
      $ids = [];
      foreach ($result as $key => $value) {
         array_push($ids, $value['id']);
      }
      $conn->close();
      return $ids;
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
   public function getTags()
   {
      return $this->tags_id;
   }
   public function setTags($tags_id)
   {
      $this->tags_id = $tags_id;
   }
   public function addTag($tag_id)
   {
      if (!array_key_exists($tag_id, $this->tags_id)) {
         array_push($this->tags_id, $tag_id);
      } else {
         die("The recipe with id " . $this->id . " already has the tag " . $tag_id);
      }

   }
   public function removeTag($tag_id)
   {
      if (array_key_exists($tag_id, $this->tags_id)) {
         array_splice($this->tags_id, array_search($tag_id, $this->tags_id));
      } else {
         die("The recipe with id " . $this->id . " does not have the category with id" . $tag_id);
      }

   }
   public function getCategories()
   {
      return $this->categories_id;
   }

   public function getFirstCategoryName($category_index = 0)
   {
      $categories_id = $this->getCategories();
      if ($category_index >= count($categories_id))
         return;
      $cat = new Category($categories_id[$category_index]);
      $name = $cat->getName();
      return $name;
   }
   public function setCategories($categories_id)
   {
      $this->categories_id = $categories_id;
   }
   public function addCategory($category_id)
   {
      if (!array_key_exists($category_id, $this->categories_id)) {
         array_push($this->categories_id, $category_id);
      } else {
         die("The recipe with id " . $this->id . " already has the category " . $category_id);
      }
   }
   public function removeCategory($category_id)
   {
      if (array_key_exists($category_id, $this->categories_id)) {
         array_splice($this->categories_id, array_search($category_id, $this->categories_id));
      } else {
         die("The recipe with id " . $this->id . " does not have the category with id" . $category_id);
      }
   }
   public function getIngredients()
   {
      return $this->ingredients;
   }
   public function setIngredients($ingredients)
   {
      $this->ingredients = $ingredients;
   }

   public function getSteps()
   {
      return $this->steps;
   }
   public function setSteps($steps_id)
   {
      $this->steps_id = $steps_id;
   }
   public function getReviews()
   {
      return $this->reviews_id;
   }
   public function getUserAutorId()
   {
      return $this->user_autor_id;
   }
   public function setUserAutorId($user_id)
   {
      $this->user_autor_id = $user_id;
   }

   public function CreateSelf()
   {
      Recipe::create($this->name, $this->description, $this->user_autor_id);
      foreach ($this->tags_id as $value) {
         Recipe_TagCRUD::create($this->id, $value);
      }
      foreach ($this->categories_id as $value) {
         Recipe_CategoryCRUD::create($this->id, $value);
      }
      foreach ($this->ingredients as $value) {
         Recipe_Ingredient::create(
            $this->id,
            $value['ingredient_id'],
            $value['quantity'],
            $value['unit_id']
         );
      }
      foreach ($this->steps as $value) {
         Step::create(
            $this->id,
            $value['step_index'],
            $value['text']
         );
      }
   }

   public function updateSelf()
   {
      $this->updateTags();
      $this->updateCategories();
      $this->updateSteps();
      $this->updateIngredients();

      $this->update(
         $this->id,
         $this->name,
         $this->description,
         $this->user_autor_id
      );
   }

   private function updateTags()
   {
      $tags_return = Recipe_TagCRUD::readWithRecipeId($this->id);
      $old_tags_id = [];
      //if there are tags in database and not in object -> remove them
      foreach ($tags_return as $key => $value) {
         if (!in_array($value['tag_id'], $this->tags_id)) {
            //remove database entries for old tags
            Recipe_TagCRUD::delete($value['id']);
         }
         array_push($old_tags_id, $value['tag_id']);
      }

      //if there are tags in object and not in database -> add them
      foreach ($this->tags_id as $key => $value) {
         if (!in_array($value, $old_tags_id)) {
            //create new database entries for new tags
            Recipe_TagCRUD::create($this->id, $value);
         }
      }
   }
   private function updateCategories()
   {
      //update categories
      $categories_return = Recipe_CategoryCRUD::readWithRecipeId($this->id);
      $old_categories_id = [];
      //if there are categories in database and not in object -> remove them
      foreach ($categories_return as $key => $value) {
         if (!in_array($value['category_id'], $this->categories_id)) {
            //remove database entries for old categories
            Recipe_CategoryCRUD::delete($value['id']);
         }
         array_push($old_categories_id, $value['category_id']);
      }

      //if there are categories in object and not in database -> add them
      foreach ($this->categories_id as $key => $value) {
         if (!in_array($value, $old_categories_id)) {
            //create new database entries for new categories
            Recipe_CategoryCRUD::create($this->id, $value);
         }
      }
   }
   private function updateSteps()
   {
      //--Get old steps ids
      $step_return = Step::readWithRecipeId($this->id);
      $old_step_ids = [];
      foreach ($step_return as $key => $value) {
         array_push($old_step_ids, (int) $value['id']);
      }
      //--
      $step_index = 0;
      foreach ($this->steps as $key => $value) {
         //--Update steps using old ids
         Step::update($old_step_ids[$step_index], $this->id, $this->steps[$step_index]['step_index'], $this->steps[$step_index]['text']);

         if ($step_index >= count($old_step_ids)) {
            //--Create new steps if run out of ids
            Step::create($this->id, $this->steps[$step_index]['step_index'], $this->steps[$step_index]['text']);
         }
         $step_index++;
      }

      //--delete old steps if there is unused ids
      while ($step_index < count($old_step_ids)) {
         Step::delete($old_step_ids[$step_index]);
         $step_index++;
      }

   }
   private function updateIngredients()
   {
      //get old ingredients
      $ingredient_return = Recipe_Ingredient::readWithRecipeId($this->id);
      $old_ingredient_ids = [];
      foreach ($ingredient_return as $key => $value) {
         array_push($old_ingredient_ids, (int) $value['id']);
      }

      $i = 0;
      foreach ($this->ingredients as $key => $value) {
         //overwrite using old ids
         Recipe_Ingredient::update(
            $old_ingredient_ids[$i],
            $this->id,
            $this->ingredients[$i]['ingredient_id'],
            $this->ingredients[$i]['quantity'],
            $this->ingredients[$i]['unit_id'],
         );

         if ($i >= count($old_ingredient_ids)) {
            //create new ids if necessary
            Recipe_Ingredient::create(
               $this->id,
               $this->ingredients[$i]['ingredient_id'],
               $this->ingredients[$i]['quantity'],
               $this->ingredients[$i]['unit_id'],
            );
         }
         $i++;
      }
      //delete old unused ids
      while ($i < count($old_ingredient_ids)) {
         Recipe_Ingredient::delete($old_ingredient_ids[$i]);
         $i++;
      }
   }

   public function deleteSelf()
   {
      $conn = (new Connection("localhost", "root", "", "receptari"))->connect();
      $conn->query("DELETE FROM recipe_ingredients WHERE recipe_id = $this->id");
      $conn->query("DELETE FROM recipe_category WHERE recipe_id = $this->id");
      $conn->query("DELETE FROM recipe_tags WHERE recipe_id = $this->id");
      $conn->query("DELETE FROM reviews WHERE recipe_id = $this->id");
      $conn->query("DELETE FROM steps WHERE recipe_id = $this->id");
      $conn->query("DELETE FROM recipes WHERE id = $this->id");
      $conn->close();
   }

   public static function read($id)
   {
      $conn = (new Connection("localhost", "root", "", "receptari"))->connect();
      $result = $conn->query("SELECT * FROM recipes WHERE id = $id");
      $conn->close();
      return $result;
   }

   public static function readWithUserId($user_id)
   {
      $conn = (new Connection("localhost", "root", "", "receptari"))->connect();
      $result = $conn->query("SELECT * FROM recipes WHERE user_autor_id = $user_id");
      $conn->close();
      return $result;
   }

   public static function create($name, $description, $user_autor_id)
   {
      $conn = (new Connection("localhost", "root", "", "receptari"))->connect();
      $conn->query("INSERT INTO recipes (name, description, user_autor_id) VALUES ('$name', '$description', '$user_autor_id')");
      $conn->close();
   }

   public static function update($id, $name, $description, $user_autor_id)
   {
      $conn = (new Connection("localhost", "root", "", "receptari"))->connect();
      $conn->query("UPDATE recipes SET name = '$name', description = '$description', user_autor_id = '$user_autor_id' WHERE id = $id");
      $conn->close();
   }

   public static function delete($id)
   {
      $conn = (new Connection("localhost", "root", "", "receptari"))->connect();
      $conn->query("DELETE FROM recipes WHERE id = $id");
      $conn->close();
   }

}

?>