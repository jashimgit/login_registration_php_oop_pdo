<?php
/**
 * Created by PhpStorm.
 * User: ripi
 * Date: 10/23/18
 * Time: 5:36 PM
 */

class Format {



	// Validate data for login form

	public function validate($data){
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
}