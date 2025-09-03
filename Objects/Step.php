<?php
class Step
{
   private $id = "";
   private $recipe_id = "";
   private $step_index = "";
   private $text = "";
   private $created_at = "";
   private $modified_at = "";

   public function __construct($id)
   {
      if ($id != 0) {
         $read = Step::read($id);
         foreach ($read as $key => $value) {
            $this->id = $value['id'];
            $this->recipe_id = $value['recipe_id'];
            $this->step_index = $value['step_index'];
            $this->text = $value['text'];
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

   public function getStepIndex(): int
   {
      return $this->step_index;
   }

   public function setStepIndex($step_index)
   {
      $this->step_index = $step_index;
   }

   public function getText()
   {
      return $this->text;
   }

   public function setText($text)
   {
      $this->text = $text;
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
      Step::update($this->id, $this->recipe_id, $this->step_index, $this->text);
   }

   public function deleteSelf()
   {
      Step::delete($this->id);
   }

   public static function read($id)
   {
      $conn = (new Connection("localhost", "root", "", "receptari"))->connect();
      $result = $conn->query("SELECT * FROM steps WHERE id = $id");
      $conn->close();
      return $result;
   }

   public static function readWithRecipeId($recipe_id)
   {
      $conn = (new Connection("localhost", "root", "", "receptari"))->connect();
      $result = $conn->query("SELECT * FROM steps WHERE recipe_id = $recipe_id");
      $conn->close();
      return $result;
   }

   public static function create($recipe_id, $step_index, $text)
   {
      $conn = (new Connection("localhost", "root", "", "receptari"))->connect();
      $conn->query("INSERT INTO steps (recipe_id, step_index, text) VALUES ($recipe_id, $step_index, '$text')");
      $conn->close();
   }

   public static function update($id, $recipe_id, $step_index, $text)
   {
      $conn = (new Connection("localhost", "root", "", "receptari"))->connect();
      $conn->query("UPDATE steps SET recipe_id = $recipe_id, step_index = $step_index, text = '$text' WHERE id = $id");
      $conn->close();
   }

   public static function delete($id)
   {
      $conn = (new Connection("localhost", "root", "", "receptari"))->connect();
      $conn->query("DELETE FROM steps WHERE id = $id");
      $conn->close();
   }
}
?>