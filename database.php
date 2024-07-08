<?php
require_once __DIR__ . '/vendor/autoload.php'; // Load Composer's autoloader

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// $db_connect = mysqli_connect('localhost', 'root', '', 'unibooks');

// if(!$db_connect){
//    die('error connecting to database'. mysqli_connect_error()); echo "sucess";
// } else{echo "bad";}
class Database
{
    private $dsn;
    private $username;
    private $password;
    private $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    );
    protected $conn;

    public function __construct()
    {
        // Set database connection parameters from environment variables
        // $this->dsn = getenv('DB_HOST');
        // $this->username = getenv('DB_USER');
        // $this->password = getenv('DB_PASS');
        $this->dsn = $_ENV['DB_HOST'];
        $this->username = $_ENV['DB_USER'];
        $this->password = $_ENV['DB_PASS'];
    }

    public function open()
    {
        try {
            $this->conn = new PDO($this->dsn, $this->username, $this->password, $this->options);
            return $this->conn;
        } catch (PDOException $e) {
            echo "There is some problem in connection: " . $e->getMessage();
        }
    }

    public function close()
    {
        $this->conn = null;
    }
}

// Instantiate the Database class and open a connection
$pdo = new Database();
$conn = $pdo->open();

// Remember to close the connection when done
$pdo->close();


// class Database
// {

//     private $server = "mysql:host=sdb-c.hosting.stackcp.net;dbname=unibooks_unibooks-31373122b0";
//     private $username = "main_user";
//     private $password ="Work@1234567890";
//     private $options  = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,);
//     protected $conn;

//     public function open()
//     {
//         try {
//             $this->conn = new PDO($this->server, $this->username, $this->password, $this->options);
//             return $this->conn;
//         } catch (PDOException $e) {
//             echo "There is some problem in connection: " . $e->getMessage();
//         }
//     }

//     public function close()
//     {
//         $this->conn = null;
//     }
// }

// $pdo = new Database();
// $conn = $pdo->open();

