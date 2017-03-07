<?php
	session_start();
	mysql_connect("localhost","projectt_rev","123456");
	
	mysql_select_db("projectt_time");

	$strSQL = "SELECT * FROM employee WHERE `code` like '".mysql_real_escape_string($_POST['code'])."' and `Name` = '".mysql_real_escape_string($_POST['name'])."'";
	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);
	
        
	
	if(!$objResult)
	{
                        header("location:../index.php");
	}
	else
	{
			
			$_SESSION["code"] = $objResult["code"];
			$_SESSION["name"] = $objResult["Name"];
			$_SESSION["position"] = $objResult["position"];
			$_SESSION["hotel"] = $objResult["hotel"];
                        
			session_write_close();
                                                if($_SESSION["name"] != 'admin')
                                                    header("location:../home.php");
                                                else
                                                    header("location:../adminpage.php");
	}
	
	mysql_close();
	
?>