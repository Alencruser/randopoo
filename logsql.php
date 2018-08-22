<?php 
require_once 'vendor/j4mie/idiorm/idiorm.php';
ORM::configure('mysql:host=den1.mysql3.gear.host;dbname=phptraining');
ORM::configure('username', 'phptraining');
ORM::configure('password', 'Hq3vKw24~?Zf');
ORM::configure('driver_options', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
 ?>