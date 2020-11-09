<?php

    include("PDO.DB.class.php");


    class Gameplay extends DB
    {
        function initialization($Name, $Gname)
        {
            $Id = $this->retrieveId($Name);
            try
            {
                $one = 1;

                $gameId = 0;

                $stmt = $this->conn->prepare("insert into gameplay (name, wait_turn, playeronego, cap) values (:Gname, :waitTurn, :playerGo, 1)");
                $stmt->bindParam(":Gname", $Gname);
                $stmt->bindParam(":waitTurn",$Id);
                $stmt->bindParam(":playerGo",$one);

                $stmtSelect = $this->conn->prepare("select id from gameplay where wait_turn = :waitTurn");
                $stmtSelect->bindParam(':waitTurn', $Id);

                $stmtInsert = $this->conn->prepare("insert into gameplayer (player_id, game_id) values (:playerId, :gameId)");
                $stmtInsert->bindParam(":playerId", $Id);
                
                $this->conn->beginTransaction();

                $stmt->execute();

                $stmtSelect->execute();

                $newId = $stmtSelect->fetch();

                $gameId = $newId['id'];

                $stmtInsert->bindParam(":gameId",$gameId);

                $insert = $stmtInsert->execute();

                $this->conn->commit();

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
                $this->conn->rollBack();
                echo $e->getMessage();
            }
        }
        
        
        function deleteGameplay($Name)
        {
            $Id = $this->retrieveId($Name);
            try
            {
                $stmt = $this->conn->prepare("delete from gameplay where playerone_Id = :Id");
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