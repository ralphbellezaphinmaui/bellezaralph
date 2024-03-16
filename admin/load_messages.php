<?php
    include "admin_db.php";
    $newcount = $_POST['newcount'];



    $sqli = "SELECT id,author,message,admin_time FROM messages ORDER BY id desc LIMIT $newcount";
    
    $result = mysqli_query($mysqli,$sqli);
    if(mysqli_num_rows($result) > 0){
        while($rows=mysqli_fetch_assoc($result)){

            echo "<pre>";
            echo "<div style ='padding-left: 15px;color:green'>";
            echo "<b> Admin: ";
            echo $rows['author'];
            echo " Date/Time: ".$rows['admin_time'];
            echo "</b>";
            echo "</div>";
            echo "</pre>";
            echo "<br>";
            echo "<div style ='padding-left: 15px;color:black'>";
            echo "$rows[message]";
            echo "</div>";

            echo "<br>";
            echo "<br>";


        }
    }
    else{
        echo "No messages.";
    }

    


?>


