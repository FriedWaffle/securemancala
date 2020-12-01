<?php

include("PDO.DB.class.php");

class Lobby extends DB
{
    function initialization($Name, $Gname, $role, $cap)
    {
        $Id = $this->retrieveId($Name);

        try
        {
            $stmt = $this->conn->prepare("insert into lobby (name, cap) values (:Gname, :cap)");
            $stmt->bindParam(":Gname",$Gname);
            $stmt->bindParam(":cap",$cap);

            $stmtSelect = $this->conn->prepare("select player.id as 'playa', lobby.id as 'lobbyist' from player, lobby where player.id = :id and lobby.name = :Gname");
            $stmtSelect->bindParam(':id',$Id);
            $stmtSelect->bindParam(':Gname', $Gname);

            $stmtHost = $this->conn->prepare("insert into lobbyplayer (player_id, lobby_id, role) values (:playa, :lobbyist, :role)");

            $this->conn->beginTransaction();
            
            $insert = $stmt->execute();
            
            if($insert > 0)
            {
                $stmtSelect->execute();
            }

            $row = $stmtSelect->fetch();

            $stmtHost->bindParam(":playa",$row['playa']);
            $stmtHost->bindParam(":lobbyist",$row['lobbyist']);
            $stmtHost->bindParam(":role", $role);
            $stmtHost->execute();

            $this->conn->commit();

            $array = array('player_id'=>$row['playa'], 'lobby_id'=>$row['lobbyist']);

            return $array;
        }
        catch(PDOException $e)
        {
            $this->conn->rollBack();
            echo $e->getMessage();
        }
    }

    function allLobbies()
    {
        try
        {
            $stmt = $this->conn->prepare("select * from lobby");
            $stmt->execute();

            $arr = array();
            $i = 0;

            while($row = $stmt->fetch())
            {
                $arr[$i] = array('id' => $row['id'], 'playeronego' => $row['playeronego'], 'playertwogo' => $row['playertwogo'], 'gostatus' => $row['gostatus'] , 'name' => $row['name'], 'cap'=> $row['cap']);

                $i++;
            }

            return $arr;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    function findLobbyPlayers($lobby_id)
    {
        try
        {
            $stmt = $this->conn->prepare("select lobbyplayer.player_id as 'playerId', lobbyplayer.role as 'roles', player.username as 'user', lobbyplayer.ready as 'ready', lobby.gostatus as 'go' from lobbyplayer join player on lobbyplayer.player_id = player.id join lobby on lobbyplayer.lobby_id = lobby.id where lobby_id = :lobbyId");
            $stmt->bindParam(':lobbyId',$lobby_id);
            $stmt->execute();

            $arr = array();
            $i = 0;

            while($row = $stmt->fetch())
            {
                $arr[$i] = array('player_id' => $row['playerId'], 'role' => $row['roles'], 'username' => $row['user'], 'ready' => $row['ready'], 'go' => $row['go']);

                $i++;
            }

            return $arr;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    function joinLobby($lobbyId, $name, $role, $cap)
    {
        $Id = $this->retrieveId($name);
        try
        {
            $stmt = $this->conn->prepare("insert into lobbyplayer(player_id, lobby_id, role) values (:player, :lobby, :role)");
            $stmt->bindParam(":player", $Id);
            $stmt->bindParam(":lobby", $lobbyId);
            $stmt->bindParam(":role", $role);
            $status = $stmt->execute();

            if($status > 0)
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
            echo $Id;
            //echo $e->getMessage();
        }
    }

    function getReady($name, $lobby_Id, $ready)
    {
        $Id = $this->retrieveId($name);

        try
        {
            $stmt = $this->conn->prepare("update lobbyplayer set ready = :ready where lobby_id = :lobbyId and player_id = :playerId");
            $stmt->bindParam(':ready', $ready);
            $stmt->bindParam(':lobbyId', $lobby_Id);
            $stmt->bindParam(':playerId', $Id);

            $update = $stmt->execute();

            if($update > 0)
            {
                echo "Success";
            }
            else
            {
                echo "Fail";
            }
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }
}

?>