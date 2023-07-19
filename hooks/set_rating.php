<?php

    define('PREPEND_PATH', '../');
    $hooks_dir = dirname(__FILE__);
    include("$hooks_dir/../defaultLang.php");
    include("$hooks_dir/../language.php");
    include("$hooks_dir/../lib.php");
	
	$data=array_map('makeSafe',$_REQUEST);
	
	if (!isset($data['id']) ||!isset($data['rating'])) {
		echo 0;
		exit;
	}
	
	$mi = getMemberInfo();

// check if we have already a rating 
	$sql="SELECT if(count(1)=1,id,0) from ratings where member='{$mi['username']}' and  snackid={$data['id']} ";
	$count = sqlvalue($sql);
	
	if ($count) {
		$sql="UPDATE ratings set rating={$data['rating']} where member='{$mi['username']}' and  snackid={$data['id']} ";
	}
// add entry to ratings table
	else {
		$sql="INSERT into ratings set member='{$mi['username']}', snackid={$data['id']}, rating={$data['rating']}";
	}
	sql($sql,$eo);
// calculate new rating
	$sql="update snacks left join ( select snackid, count(rating) cn, avg(rating) av from ratings where snackid={$data['id']}) t on snacks.id=t.snackid set rating=av, starcount=cn where id={$data['id']}";
	sql($sql,$eo);
	$sql="SELECT id, rating, starcount from snacks where id={$data['id']} LIMIT 1";
	$row=db_fetch_assoc(sql($sql,$eo));
	$row['myrating']=$data['rating'];
	echo json_encode($row);