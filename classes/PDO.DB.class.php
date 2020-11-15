<?php

    class DB
    {
        public $conn;

        function __construct()
        {
            try
            {
                //$this->conn = new PDO("mysql:host={$_SERVER['DB_SERVER']};dbname={$_SERVER['DB']};", $_SERVER['DB_USER'], $_SERVER['DB_PASSWORD']);
                $this->conn = new PDO("mysql:host=localhost;dbname=turnbase;",'friedicecream','Campbell3%emilia');
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e)
            {
                echo $_SERVER['DB_SERVER'];
                echo "Connection failed: ".$e->getMessage();
            }
        }
        
        function retrieveId($Name)
        {
            try
            {
                $stmt = $this->conn->prepare("select id from player where username = :uname");
                $stmt->bindParam(":uname",$Name);
                $stmt->execute();

                $row = $stmt->fetch();

                return $row['id'];
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        function quickSelect($Id)
        {
            try
            {
                $stmt = $this->conn->prepare("select lobby_id from lobbyplayer where player_id = :player_id");
                $stmt->bindParam(":player_id", $Id);
                $stmt->execute();

                $row = $stmt->fetch();

                echo $row['lobby_id'];

            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        function hashPass($pass)
        {
            return $this->hashPass = hash('sha256', $pass);
        }
    }
?>