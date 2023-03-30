<?php
class UsersDao{
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

    public function get_by_id($id){
        $stm = $this->conn->prepare("SELECT * FROM users WHERE id=:id");
        $stm->execute(['id' => $id]);
        return $stm->fetchALL();
    }
    public function add($user){
        $stm = $this->conn->prepare("INSERT INTO users(first_name, last_name, country) VALUES (:first_name, :last_name, :country)");
        $stm->execute($user);
        $user ['id'] = $this->conn->lastInsertId();
        return $user;
    }
    public function update($user, $id){
        $user['id'] = $id;
        $stm = $this->conn->prepare("UPDATE users SET first_name = :first_name, last_name = :last_name, country = :country WHERE id =:id");
        $stm->execute($user);
        return $user;
    }

    public function delete($id){
        $stm = $this->conn->prepare("DELETE FROM users WHERE id =:id");
        $result=$stm->execute(['id'=>$id]);
    }
    
}
?>