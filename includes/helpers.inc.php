<?php 	
	function errorMsg($errorText)
	{
		$error = $errorText . $e->getMessage();
		include 'error.html.php';
		exit();
	}
	function html($text)
	{
		return htmlspecialchars($text,ENT_QUOTES,'UTF-8');
	}
	function htmlout($text){
		echo html($text);
	}
 ?>