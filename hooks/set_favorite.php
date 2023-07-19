<?php

    define('PREPEND_PATH', '../');
    $hooks_dir = dirname(__FILE__);
    include("$hooks_dir/../defaultLang.php");
    include("$hooks_dir/../language.php");
    include("$hooks_dir/../lib.php");
	
	$data=array_map('makeSafe',$_REQUEST);
	
	if (!isset($data['id']) ||!isset($data['favorite'])) {
		echo 0;
		exit;
	}
	
	$mi = getMemberInfo();
	// only add for regigesterd users
	if ($mi['username'] != 'guest') {
	$eo=[];
	// check if we have already a favorites 
	$sql="SELECT if(count(1)=1,id,0) from favorites where member='{$mi['username']}' and  snackid={$data['id']}";
		$count = sqlvalue($sql);
		if ($count) {
		$sql="DELETE FROM favorites where member='{$mi['username']}' and  snackid={$data['id']}";
			sql($sql,$eo);
		}
	// add entry to favorites table
		else if ($data['favorite']){
			$sql="INSERT into favorites set member='{$mi['username']}', snackid={$data['id']}";
			sql($sql,$eo);
		}
		echo 1 ;
	}
	else {
		echo 0;
	}
	