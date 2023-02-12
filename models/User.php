<?php

class User {
    private $conn;
    private $table = 'users';

    public $id;
    public $name;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read() {
        $query = 'SELECT * FROM '.$this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function read_single(){
        $query = 'SELECT * FROM '.$this->table.' WHERE id=?';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->id = $row['id'];
        $this->name = $row['name'];
    }

    public function create(){
        $query = 'INSERT INTO '.$this->table.' SET name = :name';
        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $stmt->bindParam(':name', $this->name);

        if($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return true;
        }
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    public function get_user_id_by_username(){
        $query = 'SELECT id FROM users WHERE name =?';
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->name);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
       
        if($row) {
            $this->id = $row['id'];
            return true;
        } else {
            return false;
        }
        
     

    }

}

?>