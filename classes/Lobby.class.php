<?php

include("PDO.DB.class.php");

class Lobby extends DB
{
    function initialization($Name, $Gname, $role)
    {
        $Id = $this->retrieveId($Name);

        try
        {
            $stmt = $this->conn->prepare("insert into lobby (name) values (:Gname)");
            $stmt->bindParam(":Gname",$Gname);

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
                $arr[$i] = array('id' => $row['id'], 'playeronego' => $row['playeronego'], 'playertwogo' => $row['playertwogo'], 'gostatus' => $row['gostatus'] , 'name' => $row['name']);
            }

            return $arr;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    function joinLobby($lobbyId, $name, $role)
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
}

?>