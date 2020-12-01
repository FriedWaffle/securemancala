<?php

    include('PDO.DB.class.php');

    class Mancala extends DB
    {
        function create_mancala($lobby_id)
        {
            
            try
            {
                $stmt = $this->conn->prepare('insert into mancala (lobby_id) values (:lobby_id)');
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

        function updateSlots($slotArr, $lobby_id)
        {
            try
            {
                $stmt = $this->conn->prepare('update mancala set one = :one, two = :two, three = :three, four = :four, five = :five, six = :six, seven = :seven, eight = :eight, nine = :nine, ten = :ten, eleven = :eleven, twelve = :twelve where lobby_id = :lobby_id');
                $stmt->bindParam(':one', $slotArr[0]);
                $stmt->bindParam(':two', $slotArr[1]);
                $stmt->bindParam(':three', $slotArr[2]);
                $stmt->bindParam(':four', $slotArr[3]);
                $stmt->bindParam(':five', $slotArr[4]);
                $stmt->bindParam(':six', $slotArr[5]);
                $stmt->bindParam(':seven', $slotArr[6]);
                $stmt->bindParam(':eight', $slotArr[7]);
                $stmt->bindParam(':nine', $slotArr[8]);
                $stmt->bindParam(':ten', $slotArr[9]);
                $stmt->bindParam(':eleven', $slotArr[10]);
                $stmt->bindParam(':twelve', $slotArr[11]);
                $stmt->bindParam(':lobby_id', $lobby_id);
                
                $status = $stmt->execute();

                if($status > 0)
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

        function getSlots($lobby_id)
        {
            try
            {   
                $stmt = $this->conn->prepare('select * from mancala where lobby_id = :lobby_id');
                $stmt->bindParam(':lobby_id', $lobby_id);
                $stmt->execute();


                $row = $stmt->fetch();

                $arr = array(0=>$row['one'], 1=>$row['two'], 2=>$row['three'], 3=>$row['four'], 4=>$row['five'], 5=>$row['six'], 6=>$row['seven'], 7=>$row['eight'], 8=>$row['nine'], 9=>$row['ten'], 10=>$row['eleven'], 11=>$row['twelve']);

                return $arr;

            }
            catch(PDOExcetpion $e)
            {
                echo $e->getMessage();
            }
        }

        function leftScore($lobby_id, $score)
        {
            try
            {
                $stmt = $this->conn->prepare('update mancala set left_goal = :left where lobby_id = :lobby_id');
                $stmt->bindParam(':left', $score);
                $stmt->bindParam(':lobby_id', $lobby_id);

                $update = $stmt->execute();

                if($update > 0)
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
                echo $e->getMessage();                
            }
        }

        function rightScore($lobby_id, $score)
        {
            try
            {
                $stmt = $this->conn->prepare('update mancala set right_goal = :right where lobby_id = :lobby_id');
                $stmt->bindParam(':right', $score);
                $stmt->bindParam(':lobby_id', $lobby_id);

                $update = $stmt->execute();

                if($update > 0)
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
                echo $e->getMessage();                
            }
        }

        function getScores($lobby_id)
        {
            try
            {
                $stmt = $this->conn->prepare('select left_goal, right_goal from mancala where lobby_id = :lobby_id');
                $stmt->bindParam(':lobby_id', $lobby_id);

                $stmt->execute();

                $row = $stmt->fetch();

                $arr = array('lScore'=>$row['left_goal'], 'rScore'=>$row['right_goal']);

                return $arr;
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }
    }
?>