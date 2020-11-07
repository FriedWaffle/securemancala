<?php

    include("PDO.DB.class.php");

    class Chat extends DB
    {
        function initialization($Name)
        {
            try
            {
                $Id = $this->retrieveId($Name);

                $stmt = $this->conn->prepare("select id from session where playerone_id = :id");
                $stmt->bindParam(":id", $Id);

                

                $this->conn->beginTransaction();



            }
            catch(PDOException $e)
            {
                echo "Didn't work ";
            }
        }
    }
?>