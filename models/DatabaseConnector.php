
<?php
/*
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
*/
?>

<?php
Class DatabaseConnector {
	private  $server = "mysql:host=localhost;dbname=grade_book";
	private  $user = "root";
	private  $pass = "";
	private $options  = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,);
	protected $con;
 
	public function openConnection() {
	   try {
			$this->con = new PDO($this->server, $this->user,$this->pass,$this->options);
			return $this->con;
		} catch (PDOException $e) {
			 echo "There is some problem in connection: " . $e->getMessage();
		}
	}

	public function closeConnection() {
		 $this->con = null;
	}
}
?>
