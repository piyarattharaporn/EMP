<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<?php
        include 'connect.php';
	session_start();
        
        date_default_timezone_set('Asia/Bangkok');
        $t=time();
        
        $date = date("d-F-Y",$t);
        $name = $_SESSION['name'];
        $check = $_POST['check'];
        if($check == "Check in")
        {
            $initInTime = date("H:i:s",$t);
            $initOutTime = " ";
            
            $sql = "INSERT INTO `worklog`(
                     `date`, 
                     `name`,
                     `inTime`,			 
                     `outTime`
                     )

                     VALUES (
                     '$date',
                     '$name',
                     '$initInTime',			 
                     '$initOutTime'			 
                     )";

            if (!mysqli_query($con,$sql)) {
              die('Error: ' . mysqli_error($con));
            }

            mysqli_close($con);
        }
        
        
        else if($check == "Check out")
        {
            $initOutTime = date("H:i:s",$t);
            
            $sqlNewEntry = mysqli_query($con, "SELECT * FROM `worklog` WHERE `name` = '".$name."' ORDER BY `id` ASC");
            while ($row_NewEntry = mysqli_fetch_array($sqlNewEntry)) {
                $current_id = $row_NewEntry['id'];
            }
            echo $current_id;
           
            $sql = "UPDATE `worklog` SET `outTime`= '$initOutTime' WHERE date <= '".$date."' and `name` = '".$name."' and `id` = '".$current_id."' ";

            if (!mysqli_query($con,$sql)) {
              die('Error: ' . mysqli_error($con));
            }
        }    
        
        

            header("location:../home.php");
	
	
?>
</body>
</html>