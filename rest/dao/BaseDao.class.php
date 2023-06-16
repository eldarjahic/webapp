<?php
require_once __DIR__ . '/../utils/DBConnection.class.php';

class BaseDao
{
    private $conn;
    private $table_name;

    public function __construct($table_name)
    {
        $this->table_name = $table_name;
        $this->conn = DBConnection::getInstance();
    }
    public function get_all()
    {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function get_by_id($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " WHERE id=:id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetchALL();
    }
    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM " . $this->table_name . " WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

    }
    public function add($entity)
    {
        $query = "INSERT INTO " . $this->table_name . " (";
        foreach ($entity as $column => $value) {
            $query .= $column . ', ';
        }
        $query = substr($query, 0, -2);
        $query .= ") VALUES (";
        foreach ($entity as $column => $value) {
            $query .= ":" . $column . ', ';
        }
        $query = substr($query, 0, -2);
        $query .= ")";
        $stmt = $this->conn->prepare($query);
        $stmt->execute($entity);
        $entity['id'] = $this->conn->lastInsertId();
        return $entity;
    }
    public function update($entity, $id, $id_column = "id")
    {
        $query = "UPDATE " . $this->table_name . " SET ";
        foreach ($entity as $column => $value) {
            $query .= $column . "=:" . $column . ", ";

        }
        $query = substr($query, 0, -2);
        $query .= " WHERE ${id_column} = :id";
        $stmt = $this->conn->prepare($query);
        $entity['id'] = $id;
        $stmt->execute($entity);
        return $entity;
    }
    public function execute_query($query, $params)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>