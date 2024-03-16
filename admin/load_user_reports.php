
<?php
    include "admin_db.php";
    $newcount = $_POST['newcount'];



    $sqli = "SELECT participants,caller,callee,startTime,endTime,user_id,user_firstname,user_lastname,user_email,category,user_time FROM calldata ORDER BY id desc LIMIT $newcount";
    
    $result = mysqli_query($mysqli,$sqli);
    if(mysqli_num_rows($result) > 0){
        while($rows=mysqli_fetch_assoc($result)){
            echo "<pre>";
            echo "<div style ='font:15px; color:#008000';>";
            echo " email: ";
            echo $rows['user_email'];
            echo " Date/Time Reported: ".$rows['user_time'];
            echo "<br>";
            echo "<b> User: ";
            echo $rows['user_firstname'];
            echo " ";
            echo $rows['user_lastname'];
            echo "<br>";
            echo "<br>";
            echo " Report Category:";
            echo "<div style ='padding-left: 8px;font:15px;color:#ff0000'>";
            echo $rows['category'];
            echo "</div>";
            echo "</b>";
            echo "<div>";
            echo "</pre>";
            echo "<br>";
            echo "<div style ='padding-right:15px;padding-left: 15px;font:15px;color:#FFFFFF'>";
            echo "Participants: ".$rows['participants'];
            echo "<br>";
            echo "Caller: ".$rows['caller'];
            echo "<br>";
            echo "Callee: ".$rows['callee'];
            echo "<br>";
            echo "Call Started: ".$rows['startTime'];
            echo "<br>";
            echo "Call Ended: ".$rows['endTime'];
            echo "</div>";
            echo "<br>";
            echo "<br>";

        }
    }
    else{
        echo "No messages.";
    }

    


?>


