<?php
class DashboardModel extends Model {
  function __construct() {
    parent::__construct();
    //echo "Help model.";
  }

  public function xhrInsert() {
    //echo $_POST["text"];
    $text = $_POST["text"];
    $statment = $this->db->prepare("INSERT INTO data (text) VALUES (:text)");
    $statment->execute(array(":text" => $text));
    $data = array("text" => $text, "id" => $this->db->lastInsertId());
    echo json_encode($data);
  }

  public function xhrGetListings() {
    $statment = $this->db->prepare("SELECT * FROM data");
    $statment->setFetchMode(PDO::FETCH_ASSOC);
    $statment->execute();
    $data = $statment->fetchAll();
    echo json_encode($data);
  }

  public function xhrDeleteListing() {
    $id = $_POST['id'];
    //echo $id;
    $statment = $this->db->prepare("DELETE FROM data WHERE id=$id");
    $statment->execute();
    //echo "deleted";
  }
}
?>
