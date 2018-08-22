<?php
require "logsql.php";
$rando=ORM::for_table('hiking')->where('id',htmlspecialchars($_POST["id"]))->find_one();
$rando->delete();
header('location:read.php');
?>