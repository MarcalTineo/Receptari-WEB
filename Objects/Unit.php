<?php
class Unit
{
   private $id = "";
   private $metric = "";
   private $imperial = "";
   private $conversion = "";
   private $created_at = "";
   private $modified_at = "";

   public function __construct($id)
   {
      if ($id != 0) {
         $read = Unit::read($id);
         foreach ($read as $key => $value) {
            $this->id = $value['id'];
            $this->metric = $value['metric'];
            $this->imperial = $value['imperial'];
            $this->conversion = $value['conversion'];
            $this->created_at = $value['created_at'];
            $this->modified_at = $value['modified_at'];
         }
      }
   }

   public function getId()
   {
      return $this->id;
   }

   public function getMetric()
   {
      return $this->metric;
   }

   public function setMetric($metric)
   {
      $this->metric = $metric;
   }

   public function getImperial()
   {
      return $this->imperial;
   }

   public function setImperial($imperial)
   {
      $this->imperial = $imperial;
   }

   public function getConversion()
   {
      return $this->conversion;
   }

   public function setConversion($conversion)
   {
      $this->conversion = $conversion;
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
      Unit::update($this->id, $this->metric, $this->imperial, $this->conversion);
   }

   public function deleteSelf()
   {
      Unit::delete($this->id);
   }

   public static function read($id)
   {
      $conn = (new Connection("localhost", "root", "", "receptari"))->connect();
      $result = $conn->query("SELECT * FROM units WHERE id = $id");
      $conn->close();
      return $result;
   }

   public static function create($metric, $imperial, $conversion)
   {
      $conn = (new Connection("localhost", "root", "", "receptari"))->connect();
      $conn->query("INSERT INTO units (metric, imperial, conversion) VALUES ($metric, $imperial, $conversion)");
      $conn->close();
   }

   public static function update($id, $metric, $imperial, $conversion)
   {
      $conn = (new Connection("localhost", "root", "", "receptari"))->connect();
      $conn->query("UPDATE units SET metric = $metric, imperial = $imperial, conversion = $conversion WHERE id = $id");
      $conn->close();
   }

   public static function delete($id)
   {
      $conn = (new Connection("localhost", "root", "", "receptari"))->connect();
      $conn->query("DELETE FROM units WHERE id = $id");
      $conn->close();
   }

}
?>