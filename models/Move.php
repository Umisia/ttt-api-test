<?php

class Move {
    private $conn;
    private $table = 'moves';

    public $id;
    public $gameid;
    public $field;
    public $symbol;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function register(){
        $query = 'INSERT INTO '.$this->table.' SET gameid = :gameid, field = :field, symbol = :symbol';
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':gameid', $this->gameid);
        $stmt->bindParam(':field', $this->field);
        $stmt->bindParam(':symbol', $this->symbol);

        if($stmt->execute()) {
            return true;
        }
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
    public function read_available(){
        $query = 'SELECT field, symbol FROM moves WHERE gameid=?';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->gameid);
        $stmt->execute();
        return $stmt;
    }


}

?>