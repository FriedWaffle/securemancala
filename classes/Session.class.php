<?php

    include("PDO.DB.class.php");


    class Session extends DB
    {
        function initialization($Name)
        {
            $Id = $this->retrieveId($Name);
            try
            {
                $one = 1;

                $stmt = $this->conn->prepare("insert into session (waitTurn, playerone_Id, playerone_go) values (:waitTurn, :playerId, :playerGo)");
                $stmt->bindParam(":waitTurn",$Id);
                $stmt->bindParam(":playerId",$Id);
                $stmt->bindParam(":playerGo",$one);
                $insert = $stmt->execute();

                if($insert > 0)
                {
                    echo "Success";
                }
                else
                {
                    echo "Failed";
                }


            }
            catch(PDOException $e)
            {
                echo $e;
            }
        }
        
        
        function deleteSession($Name)
        {
            $Id = $this->retrieveId($Name);
            try
            {
                $stmt = $this->conn->prepare("delete from session where playerone_Id = :Id");
                $stmt->bindParam(":Id",$Id);
                $delete = $stmt->execute();

                if($delete > 0)
                {
                    echo "success";
                }
                else
                {
                    echo "fail";
                }
            }
            catch(PDOException $e)
            {
                echo $e;
            }
        }
    }
?>