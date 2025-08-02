<?php
class Review
{
   private $id = "";
   private $user_id = "";
   private $recipe_id = "";
   private $score = "";
   private $comment = "";
   private $created_at = "";
   private $modified_at = "";

   public function __construct($id)
   {
      if ($id != 0) {
         $read = Review::read($id);
         foreach ($read as $key => $value) {
            $this->id = $value['id'];
            $this->user_id = $value['user_id'];
            $this->recipe_id = $value['recipe_id'];
            $this->score = $value['score'];
            $this->comment = $value['comment'];
            $this->created_at = $value['created_at'];
            $this->modified_at = $value['modified_at'];
         }
      }
   }

   public function getId()
   {
      return $this->id;
   }

   public function getUserId()
   {
      return $this->user_id;
   }

   public function setUserId($user_id)
   {
      $this->user_id = $user_id;
   }

   public function getRecipeId()
   {
      return $this->recipe_id;
   }

   public function setRecipeId($recipe_id)
   {
      $this->recipe_id = $recipe_id;
   }

   public function getScore()
   {
      return $this->score;
   }

   public function setScore($score)
   {
      $this->score = $score;
   }

   public function getComment()
   {
      return $this->comment;
   }

   public function setComment($comment)
   {
      $this->comment = $comment;
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
      Review::update($this->id, $this->user_id, $this->recipe_id, $this->score, $this->comment);
   }

   public function deleteSelf()
   {
      Review::delete($this->id);
   }

   public static function read($id)
   {
      $conn = (new Connection("localhost", "root", "", "receptari"))->connect();
      $result = $conn->query("SELECT * FROM reviews WHERE id = $id");
      $conn->close();
      return $result;
   }

   public static function readWithRecipeId($recipe_id)
   {
      $conn = (new Connection("localhost", "root", "", "receptari"))->connect();
      $result = $conn->query("SELECT * FROM reviews WHERE recipe_id = $recipe_id");
      $conn->close();
      return $result;
   }

   public static function readWithUserId($user_id)
   {
      $conn = (new Connection("localhost", "root", "", "receptari"))->connect();
      $result = $conn->query("SELECT * FROM reviews WHERE user_id = $user_id");
      $conn->close();
      return $result;
   }

   public static function create($user_id, $recipe_id, $score, $comment)
   {
      $conn = (new Connection("localhost", "root", "", "receptari"))->connect();
      $conn->query("INSERT INTO reviews (user_id, recipe_id, score, comment) VALUES ($user_id, $recipe_id, $score, '$comment')");
      $conn->close();
   }

   public static function update($id, $user_id, $recipe_id, $score, $comment)
   {
      $conn = (new Connection("localhost", "root", "", "receptari"))->connect();
      $conn->query("UPDATE reviews SET user_id = $user_id, recipe_id = $recipe_id, score = $score, comment = '$comment'  WHERE id = $id");
      $conn->close();
   }

   public static function delete($id)
   {
      $conn = (new Connection("localhost", "root", "", "receptari"))->connect();
      $conn->query("DELETE FROM reviews WHERE id = $id");
      $conn->close();
   }

}
?>