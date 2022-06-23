<?php
/**
 * 이 파일은 미니톡 클라이언트의 일부입니다. (https://www.minitalk.io)
 *
 * 미니톡 클라이언트 관리자 로그인을 처리한다.
 * 
 * @file /process/login.php
 * @author Arzz (arzz@arzz.com)
 * @license MIT License
 * @modified 2021. 10. 5.
 */
if (defined('__MINITALK__') == false) exit;

$errors = array();
$user_id = Request('user_id') ? Request('user_id') : $errors['user_id'] = $this->getErrorText('REQUIRED');
$password = Request('password') ? Request('password') : $errors['password'] = $this->getErrorText('REQUIRED');

if (count($errors) == 0) {
	$mHash = new Hash();
	$check = $this->db()->select($this->table->admin)->where('user_id',$user_id)->getOne();
	if ($check != null && $mHash->password_validate($password,$check->password) == true) {
		$results->success = true;
		$loginString = Encoder(json_encode(array('idx'=>$check->idx,'ip'=>GetClientIp(),'time'=>time())));
		$this->db()->update($this->table->admin,array('latest_login'=>time()))->where('idx',$check->idx)->execute();
		$_SESSION['MINITALK_LOGGED'] = $loginString;
		if (Request('auto_login') == 'TRUE') {
			setcookie('MINITALK_LOGGED',$loginString,time() + 86400 * 60,'/');
		}
	} else {
		$results->success= false;
	}
} else {
	$results->success = false;
	$results->errors = $errors;
}
?>