<?php


class Session {


	// Init session

	public static function init(){
		session_start();
	}

	// Set session data


	public static function set($key, $value){
		$_SESSION['key'] = $value;
	}

	public  static function get($key){

		if (isset($_SESSION['key'])){
			return $_SESSION['key'];
		} else {
			return false;

		}
	}
	public static function checkSession(){
		self::init();
		if (self::get('login') == false ){
			self::destroy();
			header('Location: login.php');
		} else {
			return false;
		}
	}

	public function checkLogin() {
		if(self::get('login') == true){
			header('location:index.php');
		}else{
			header('location:login.php');
		}
	}

	public static function destroy(){
		session_destroy();
		header('Location:login.php');
	}
}