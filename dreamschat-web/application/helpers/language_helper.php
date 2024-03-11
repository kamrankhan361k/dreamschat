<?php
function custom_language($user, $lang)
{
	$user_lang = array();
	// print_r($user);
	// print_r($lang);
	$str = file_get_contents('language.json');
	//echo "<pre>"; print_r($str); //exit;
	$json = json_decode($str, true);
	
	$user_lang = $json['language'][$user][$lang];
	//echo "<pre>"; print_r($user_lang); exit;
	return $user_lang;
   
}
?>