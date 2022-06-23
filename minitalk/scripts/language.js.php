<?php
/**
 * 이 파일은 미니톡 클라이언트의 일부입니다. (https://www.minitalk.io)
 *
 * 자바스크립트내에서 언어셋을 사용하기 위한 함수를 정의한다.
 * 
 * @file /scripts/language.js.php
 * @author Arzz (arzz@arzz.com)
 * @license MIT License
 * @modified 2021. 10. 5.
 */
REQUIRE_ONCE str_replace('/scripts/language.js.php','',str_replace(DIRECTORY_SEPARATOR,'/',$_SERVER['SCRIPT_FILENAME'])).'/configs/init.config.php';
header('Content-Type: application/x-javascript; charset=utf-8');

$language = Request('language');
$languages = Request('languages') ? explode(',',Request('languages')) : array();

/**
 * 미니톡 클라이언트의 언어파일을 불러온다.
 */
$package = json_decode(file_get_contents(__MINITALK_PATH__.'/package.json'));
$lang = null;
$oLang = null;
if (is_file(__MINITALK_PATH__.'/languages/'.$language.'.json') == true) {
	$lang = file_get_contents(__MINITALK_PATH__.'/languages/'.$language.'.json');
	if ($language != $package->language) $oLang = file_get_contents(__MINITALK_PATH__.'/languages/'.$package->language.'.json');
} elseif (is_file(__MINITALK_PATH__.'/languages/'.$package->language.'.json') == true) {
	$lang = file_get_contents(__MINITALK_PATH__.'/languages/'.$package->language.'.json');
}

if ($lang != null) echo 'Minitalk.addLanguage("core","",'.$lang.','.($oLang == null ? 'null' : $oLang).');'.PHP_EOL;

for ($i=0, $loop=count($languages);$i<$loop;$i++) {
	list($type,$target,$defaultLanguage) = explode('@',$languages[$i]);
	
	$lang = null;
	$oLang = null;
	
	if ($type == 'plugin') {
		if (is_file(__MINITALK_PATH__.'/plugins/'.$target.'/languages/'.$language.'.json') == true) {
			$lang = file_get_contents(__MINITALK_PATH__.'/plugins/'.$target.'/languages/'.$language.'.json');
			if ($language != $defaultLanguage) $oLang = file_get_contents(__MINITALK_PATH__.'/plugins/'.$target.'/languages/'.$defaultLanguage.'.json');
		} elseif (is_file(__MINITALK_PATH__.'/plugins/'.$target.'/languages/'.$defaultLanguage.'.json') == true) {
			$lang = file_get_contents(__MINITALK_PATH__.'/plugins/'.$target.'/languages/'.$defaultLanguage.'.json');
		} else {
			$lang = null;
		}
	}
	
	if ($lang != null) echo 'Minitalk.addLanguage("'.$type.'","'.ucfirst($target).'",'.$lang.','.($oLang == null ? 'null' : $oLang).');'.PHP_EOL;
}
?>