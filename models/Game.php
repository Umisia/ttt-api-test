<?php

class Game {
    private $conn;
    private $table = 'games';
    public $id;
    public $userid;
    public $result;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read_game_by_id() {
        $query = 'SELECT games.id as gameid, games.userid as userid, games.result as gameresult, moves.field as field, moves.symbol as symbol FROM '.$this->table.' left join moves on moves.gameid = games.id where games.id = ?';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        return $stmt;
      
    }

    public function create(){
        $query = 'INSERT INTO '.$this->table.' SET userid = :userid, result = :result';
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':userid', $this->userid);
        $stmt->bindParam(':result', $this->result);
    
        if($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
          return true;
        }
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    public function read_by_username($username) {
        $query = 'SELECT games.id as gameid, games.result as gameresult, users.id as userid, users.name as username FROM games INNER JOIN users ON users.id = games.userid WHERE users.name = ?';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $username);
        $stmt->execute();
        return $stmt;
    }

    public function read(){
        $query = 'SELECT * FROM '.$this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function update_result($gresult){
        $query = "UPDATE games SET result = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $gresult);
        $stmt->bindParam(2, $this->id);
    
        if($stmt->execute()) {
          return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
}

?>