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
                $stmt->bindParam(':id', $Id);

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

            }catch(PDOException $e)
            {
                $this->conn->rollBack();
                echo $e->getMessage();

            }
            finally
            {
                //echo $Id;
            }
        }

        function turn($spinbottle, $lobby_id)
        {
            try
            {
                $stmt = $this->conn->prepare('update lobby set turn = :turn where id = :lobby_id');
                $stmt->bindParam(':turn', $spinbottle);
                $stmt->bindParam(':lobby_id', $lobby_id);
                $status = $stmt->execute();

                if($status > 0)
                {
                    echo "Success";
                }
                else
                {
                    echo "Failed";
                }

            }catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        function turnStatus($lobby_id)
        {
            try
            {
                $stmt = $this->conn->prepare('select turn from lobby where id = :id');
                $stmt->bindParam(':id',$lobby_id);
                $stmt->execute();

                $row = $stmt->fetch();

                echo $row['turn'];

            }catch(PDOException $e)
            {
                $e->getMessage();
            }
        }
    }
?>