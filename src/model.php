<?php
require_once "functions.php";
class Model
{
    public $db;
    public function __construct(){
        $this->db = new PDO("mysql:host=localhost;dbname=Posts", "root", "");
        $this->db->exec('CREATE DATABASE IF NOT EXISTS Posts');
    }


    public function login($login,$password)
    {
        //$sql
        // code...
        $sql = "SELECT * FROM users WHERE login = :login";

        $statement = $this->db->prepare($sql);
        $statement->bindValue(":login", $login);
        $statement->execute();
        if($statement->rowCount() > 0){
            foreach ($statement as $row) {
              $id_user = $row["id"];
              $login_user = $row["login"];
              $password_user = $row["password"];
            }
        }
        if ($login == $login_user && password_verify($password, $password_user)) {
            echo 'Password is valid!';
        } else {
            echo 'Invalid password.';
        }
    }
    public function register($login,$password)
    {
        //$sql
        // code...
        //
        if (preg_match('/^[a-zA-Z0-9_][a-zA-Z0-9_]*$/', $login)) 
        {
            $password = password_hash($password,PASSWORD_DEFAULT);
            echo "hash: ".$password;
            $sql = "INSERT INTO users (login,password) VALUES (:login,:password)";
            $statement = $this->db->prepare($sql);
            
            $statement->bindValue(":login", $login);
            $statement->bindValue(":password", $password);
            $statement->execute();

        }
    }
    public function create_table($sql){
        //make database
        $this->db->exec($sql);
    }
    public function save_db_post($sql){
        
        if (isset($_POST["post"])){
            $name_file = generateRandomString(16);
            $target_file = download_image($name_file);
            $target_file = substr($target_file,65);
            //echo "file download: ".$target_file; 
            $statement = $this->db->prepare($sql);
            //:pathimg
            $statement->bindValue(":datapost", $_POST["post"]);
            $statement->bindValue(":pathimg", $target_file);
            $statement->execute();
            
        }
        
    }
    public function save_db_post_by_id($id, $data_post){
        $post_name = "post".$id;

        echo "<br>"; 
        echo "post_name = " . $post_name;
        echo "<br>";
        echo "data_post = " . $data_post;
        echo "<br>"; 
        $name_file = generateRandomString(16);
        echo "rand: " . $name_file;
        echo "<br>"; 
        $target_file = download_image($name_file);
        echo "target_file: " . substr($target_file,65);
        $target_file = substr($target_file,65);
        echo "<br>"; 
        //echo $sql;
        if (isset($data_post) && preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*$/', $data_post)) {
            $sql = "INSERT INTO $post_name (data,pathimage) VALUES (:datapost,:pathimg)";
            $statement = $this->db->prepare($sql);
            
            $statement->bindValue(":datapost", $data_post);
            $statement->bindValue(":pathimg", $target_file);
            $statement->execute();

        }
        
    }
    public function get_db_post($id){

        //sql code
        $sql = "SELECT * FROM posts WHERE id = :id";
        //data tables
        //execute
        $statement = $this->db->prepare($sql);
        $statement->bindValue(":id", $id);
        $statement->execute();
        //extract from db
        if($statement->rowCount() > 0){
            foreach ($statement as $row) {
              $id_post = $row["id"];
              $data = $row["data"];
              $pathimg = $row["pathimage"];
            }
        }
        if (!isset($id_post) && !isset($data) && !isset($pathimg)){
            //header("Location:/404.html");
            //http_response_code(404); // Set the HTTP response code to 404
            //header("Location: /src/404.html"); // Redirect to your custom 404 page
            //exit; // Stop executing the current script
        }

        $post = array("id"=>$id_post, "data"=>$data, "pathimage"=>$pathimg);
        return $post;

    }
    public function get_db_all_posts(){
        $sql = "SELECT * FROM posts";
        $result = $this->db->query($sql);
        $posts_sql_post = array();

        while($row = $result->fetch()){
            //add to all data to posts_sql_post
            $post = array();
            $id = $row["id"];
            $data_post = $row["data"];
            $img = $row["pathimage"]; 
            array_push($post, ["id"=>$id, "data"=>$data_post,"pathimage"=>$img]);
            array_push($posts_sql_post, ["post"=>$post]);
        }
        return $posts_sql_post;
    }
    public function create_table_subpost($id){
        $post_name = "post".$id; 

        //$sql = "CREATE TABLE IF NOT EXISTS :namepost (id INTEGER AUTO_INCREMENT PRIMARY KEY, data varchar(256), pathimage varchar(256))";

        if (preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*$/', $post_name)) {
            $sql = "CREATE TABLE IF NOT EXISTS $post_name (id INT AUTO_INCREMENT PRIMARY KEY, data varchar(256), pathimage varchar(256))";
            $statement = $this->db->prepare($sql);
            $statement->execute();
        }
    }
    public function get_db_subpost($id){
        $post_name = "post" . $id;
        $posts_sql_post = array();
        // Validate and sanitize the table name
        if (preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*$/', $post_name)) {
            // Construct the SQL query with the sanitized table name
            $sql = "SELECT * FROM " . $post_name;
            
            // Execute the query
            $statement = $this->db->prepare($sql);
            $statement->execute();

            
            if ($statement->rowCount() > 0) {
                foreach ($statement as $row) {
                    $post = array();
                    $id = $row["id"];
                    $data_post = $row["data"];
                    $img = $row["pathimage"]; 
                    array_push($post, ["id"=>$id, "data"=>$data_post,"pathimage"=>$img]);
                    array_push($posts_sql_post, ["post"=>$post]);
                }
            }
            
            //$post = array("id" => $id_post, "data" => $data);
            return $posts_sql_post;
        } else {
            // Handle an invalid table name here (e.g., log an error or return an error response)
            return null;
        }
    }
    public function close(){
        $this->db = null;
    }
}

$post = new Model();
$post->create_table("CREATE TABLE IF NOT EXISTS posts (id INTEGER AUTO_INCREMENT PRIMARY KEY, data varchar(256), pathimage varchar(256))");
$post->create_table("CREATE TABLE IF NOT EXISTS users (id INTEGER AUTO_INCREMENT PRIMARY KEY, login varchar(256), password varchar(256))");

if (isset($_SERVER['HTTP_REFERER']) && substr($_SERVER['HTTP_REFERER'],16) == "/") {
    $post->save_db_post("INSERT INTO posts (data,pathimage) VALUES (:datapost,:pathimg)");
}

if (isset($_POST["login"]) && isset($_POST["psw"])) {
    $post->register($_POST["login"],$_POST["psw"]);
}

if (isset($_POST["login_log"]) && isset($_POST["psw_log"])) {
    $post->login($_POST["login_log"],$_POST["psw_log"]);
}

?>
<script type = "text/javascript">
    if(document.location.href.indexOf('src/model.php') > -1) {
        window.location = "/index.php"; 
    }
</script>