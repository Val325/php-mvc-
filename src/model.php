<?php
class Model
{
    public $db;
    public function __construct(){
        $this->db = new PDO("mysql:host=localhost;dbname=Posts", "root", "");
        $this->db->exec('CREATE DATABASE IF NOT EXISTS Posts');
    }
    public function create_table($sql){
        //make database
        $this->db->exec($sql);
    }
    public function save_db_post($sql){
        if (isset($_POST["post"])){
            $statement = $this->db->prepare($sql);
            $statement->bindValue(":datapost", $_POST["post"]);
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
            }
        }
        if (!isset($id_post) && !isset($data)){
            header("Location:/404.html");
        }

        $post = array("id"=>$id_post, "data"=>$data);
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
            array_push($post, ["id"=>$id, "data"=>$data_post]);
            array_push($posts_sql_post, ["post"=>$post]);
        }
        return $posts_sql_post;
    }
    public function close(){
        $this->db = null;
    }
}

$post = new Model();
$post->create_table("CREATE TABLE IF NOT EXISTS posts (id INTEGER AUTO_INCREMENT PRIMARY KEY, data varchar(256))");
$post->save_db_post("INSERT INTO posts (data) VALUES (:datapost)");
?>
<script type = "text/javascript">
    if(document.location.href.indexOf('src/model.php') > -1) {
        window.location = "/index.php"; 
    }
</script>