<?php
session_start();

if(isset($_SESSION['username'])&&$_SESSION['username']=="admin"){
	echo "<li><a href='../frontend/admin.php'>Admin</a></li>";
}

?>