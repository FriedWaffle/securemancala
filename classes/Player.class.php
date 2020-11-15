<?php

include('PDO.DB.class.php');


class Player extends DB
{
    // function __construct()
    // {
    //     try
    //     {
    //         //$this->conn = new PDO("mysql:host={$_SERVER['DB_SERVER']};dbname={$_SERVER['DB']}", $_SERVER['DB_USER'], $_SERVER['DB_PASSWORD']);
    //         $this->conn = new PDO("mysql:host=localhost;dbname=turnbase;",'joel','Dare7devil');
    //         $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //     }
    //     catch(PDOException $e)
    //     {
    //         echo "Connection failed: ".$e->getMessage();
    //     }
    // }

    function addPlayer($player, $pass)
    {
        try
        {
                $hashed = $this->hashPass($pass);

                $token = $this->hashPass($pass+$player);
 
                $stmt = $this->conn->prepare("insert into player (username, password, token) values (:player, :pass, :token)");
                $stmt->bindParam(':player', $player);
                $stmt->bindParam(':pass', $hashed);
                $stmt->bindParam(':token', $token);
                $insert = $stmt->execute();

                if($insert > 0)
                {
                    echo "Success";
                }
                else
                {
                    echo "Insert fail";
                }
        }
        catch(PDOException $e)
        {
            echo $e;
        }
    }

    function checkLogIn($player, $pass)
    {
        try
        {

            $stmt = $this->conn->prepare("select username, password from player where username = :player");
            $stmt->bindParam(":player", $player);
            $stmt->execute();

            $row = $stmt->fetch();
            
            if($this->hashPass($pass) === $row['password'])
            {
                return true;
            }
            else
            {
                return false;
            }

            // if($this->hashPass($pass) === $row['password'])
            // {
            //     return true;
            // }
            // else
            // {
            //     return false;
            // }

        }
        catch(PDOException $e)
        {
            echo $e;
        }
    }

    function verifyUnique($player)
    {
        try
        {
            $stmt = $this->conn->prepare("select username from player where username = :player");
            $stmt->bindParam(":player", $player);
            $check = $stmt->execute();

            if($check > 0)
            {
                return false;
            }
            else
            {
                return true;
            }


        }
        catch(PDOException $e)
        {
            echo $e;
        }
    }

    function getAllPlayer($playerName)
    {
        try
        {
            $stmt = $this->conn->prepare("select username, id from player where username != :playerName");
            $stmt->bindParam(":playerName", $playerName);
            $stmt->execute();

            $array = array();
            $i = 0;
            while($row = $stmt->fetch())
            {
                $array[$i]['id'] = $row['id'];
                $array[$i]['username'] = $row['username'];
                $i++;
            }

            return $array;

        }
        catch(PDOException $e)
        {
            echo $e;
        }
    }

    
}

?>