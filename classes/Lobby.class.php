<?php

include("PDO.DB.class.php");

class Lobby extends DB
{
    function initialization($Name, $Gname)
    {
        $Id = $this->retrieveId($Name);

        try
        {
            $stmt = $this->conn->prepare("insert into lobby (name) values (:Gname)");
            $stmt->bindParam(":Gname",$Gname);

            $stmtSelect = $this->conn->prepare("select player.id as 'playa', lobby.id as 'lobbyist' from player, lobby where player.id = :id and lobby.name = :Gname");
            $stmtSelect->bindParam(':id',$Id);
            $stmtSelect->bindParam(':Gname', $Gname);

            $stmtHost = $this->conn->prepare("insert into host (player_id, lobby_id) values (:playa, :lobbyist)");

            $this->conn->beginTransaction();
            
            $insert = $stmt->execute();
            
            if($insert > 0)
            {
                $stmtSelect->execute();
            }
            

            $row = $stmtSelect->fetch();

            $stmtHost->bindParam(":playa",$row['playa']);
            $stmtHost->bindParam(":lobbyist",$row['lobbyist']);
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
}

?>