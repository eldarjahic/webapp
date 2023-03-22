<?php
class usersDao{
    private $conn;

    public function __construct(){
        
        try {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $schema = "webapp";
            $this->conn = new PDO("mysql:host=$servername;dbname=$schema", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function get_all(){
        $stm = $this->conn->prepare("SELECT * FROM users");
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
    public function add($first_name, $last_name, $country){
        $stm = $this->conn->prepare("INSERT INTO users(first_name, last_name, country) VALUES (:first_name, :last_name, :country)");
        $result=$stm->execute(['first_name'=>$first_name, 'last_name'=>$last_name, 'country'=>$country]);
    }
    public function update($first_name, $last_name, $country, $id){
        $stm = $this->conn->prepare("UPDATE users SET first_name = :first_name, last_name = :last_name, country = :country WHERE id =:id");
        $result=$stm->execute(['first_name'=>$first_name, 'last_name'=>$last_name, 'country'=>$country, 'id'=>$id]);
    }

    public function delete($id){
        $stm = $this->conn->prepare("DELETE FROM users WHERE id =:id");
        $result=$stm->execute(['id'=>$id]);
    }
    
}
?>