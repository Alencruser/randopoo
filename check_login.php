<?php
session_start();
require "logsql.php";
try {
	if(isset($_POST["username"]) && isset($_POST["password"])){
		$login=ORM::for_table('users')->where('login', htmlspecialchars($_POST["username"]))->find_many();
		foreach($login as $v){
			if($v["password"]==htmlspecialchars($_POST["password"])){
				$_SESSION["login"]="blbl";
				header('location:read.php');
			}else {
				header('location:login.php');
			}
		}}
	}catch(PDOException $e){
		echo "Erreur : ".$e->getMessage();
	}