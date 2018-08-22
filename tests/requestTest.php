<?php 
use PHPUnit\Framework\TestCase;
require "read.php";
require "check_login.php";

class request extends TestCase 
{
	public function testrequest(){
		$request=ORM::for_table('hiking')->find_many();
		$this->assertInternalType('array',$request);
		$this->assertNotEmpty($request);
	}
}
class login extends TestCase {
	public function testlogin(){
		$user="Alencruser";
		$login=ORM::for_table('users')->where('login',$user)->find_many();
		$this->assertInternalType('array',$login);
		$this->assertNotEmpty($login);
	}
}

?>
