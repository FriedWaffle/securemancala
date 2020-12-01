<?php

    include("PDO.DB.class.php");

    class Chat extends DB
    {
        function create_chat($name)
        {
           $Id = $this->retrieveId($name);
           try
           {
                $stmt = $this->conn->prepare("select lobby_id from lobbyplayer where player_id = :id");
                $stmt->bindParam(":id",$Id);

                $stmtInsert = $this->conn->prepare("insert into chat(lobby_id) values(:lobby_id)");
                
                $this->conn->beginTransaction();

                $stmt->execute();

                $row = $stmt->fetch();
                
                $stmtInsert->bindParam(":lobby_id", $row['lobby_id']);
                $status = $stmtInsert->execute();

                $this->conn->commit();

                if($status > 0)
                {
                    
                }
                else
                {
                    echo "Failed";
                }

                

            }catch(PDOException $e)
            {
                $this->conn->rollBack();
                
            }
            finally{

               $this->quickSelect($Id);
            }
        }

        function send($name, $message, $lobby_id)
        {
            $Id = $this->retrieveId($name);
            try
            {
                $stmt = $this->conn->prepare("select id from chat where lobby_id = :lobby_id");
                $stmt->bindParam(':lobby_id', $lobby_id);
                
                $stmtInsert = $this->conn->prepare("insert into message (message, chat_id, player_id) values (:msg, :chat_id, :player_id)");

                $this->conn->beginTransaction();

                $stmt->execute();

                $row = $stmt->fetch();

                $chatId = $row['id'];


                $stmtInsert->bindParam(':msg', $message);
                $stmtInsert->bindParam(':chat_id',$chatId);
                $stmtInsert->bindParam(':player_id',$Id);

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

        function read($lobby_id)
        {
            try
            {
                $stmt = $this->conn->prepare("select player.username, message.message, lobbyplayer.ready, lobbyplayer.role from player inner join message on player.id = message.player_id inner join lobbyplayer on player.id = lobbyplayer.player_id inner join chat on lobbyplayer.lobby_id = chat.lobby_id where lobbyplayer.lobby_id = :id order by message.id");
                //$stmt = $this->conn->prepare("select player.username, message.chat_id, message.message, message.id from player join lobbyplayer on player.id = lobbyplayer.player_id join lobby on lobbyplayer.lobby_id = lobby.id join chat on lobby.id = chat.lobby_id join message on chat.id = message.chat_id where lobby.id = :id");
                $stmt->bindParam(":id",$lobby_id);
                $stmt->execute();

                $arr = array();
                $i = 0;
                while($row = $stmt->fetch())
                {
                    $arr[$i] = array('player' => $row['username'], 'msg' => $row['message'], 'chat_id' => $row['chat_id'], 'id' => $row['id'], 'ready' => $row['ready'], 'role' => $row['role']);
                    $i++;
                }

                return $arr;

            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }
    }
?>