<?php
require_once('../database/db_con.php');

if(isset($_POST['tid'])){
	if(isset($_COOKIE["setcookie".$_POST['tid'].""])){//judge cookie to prevent dupicate submission
    	echo "Have Done";
    }
    else{
    	$sql="select `like` from topic where tid='".$_POST['tid']."';";
		$result=$con->query($sql) or die('MySQL Error: ' . mysqli_error());
		$row=$result->fetch_assoc();

		$row['like']++;
		$sql="update topic set `like`='".$row['like']."' where tid='".$_POST['tid']."';";
		$result=$con->query($sql) or die('MySQL Error: ' . mysqli_error());
		
		setcookie("setcookie".$_POST['tid']."", "1", time()+72000000); //set cookie to prevent dupicate submission-Yuan Ji achieve this logic for fixing bugs
		
		echo $row['like'];
    }
}
else{
	die('MySQL Error: ' . mysqli_error());
}

?>