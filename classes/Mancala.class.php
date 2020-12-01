<?php

    include('PDO.DB.class.php');

    class Mancala extends DB
    {
        function create_mancala($name)
        {
            $Id = $this->retrieveId($name);
            try
            {
                $stmt = $this->conn->prepare('select id from lobbyplayer where player_id = :id');
                $stmt->bindParam(':id', $name);


                $stmtInsert = $this->conn->prepare('insert into mancala (lobbyplayer_id) values (:lobbyplayer_id)');
                
                $this->conn->beginTransaction();

                $stmt->execute();

                $row = $stmt->fetch();
                
                $stmtInsert->bindParam(':lobbyplayer_id', $row['id']);

                $status = $stmtInsert->execute();

                $this->conn->commit();

                if($status > 0)
                {
                    echo "Success";
                }
                else
                {
                    echo "Failed";
                }

            }catch(PDOExcetion $e)
            {
                $this->conn->rollBack();
                echo $e->getMessage();
                
            }
        }
    }


    function gameStatus()
    {
        
    }
?>