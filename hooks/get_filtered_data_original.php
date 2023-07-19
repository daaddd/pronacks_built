<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
function remove_html_comments($content = '') {
	return preg_replace('/<!--(.|\s)*?-->/', '', $content);
}

define('PREPEND_PATH', '../');
$hooks_dir = dirname(__FILE__);
include("$hooks_dir/../defaultLang.php");
include("$hooks_dir/../language.php");
include("$hooks_dir/../lib.php");

$data=array_map('makeSafe',$_REQUEST);
$mi = getMemberInfo();
$fields=['brand'=>'brand',
		 'category'=>'category',
		 'flavor'=>'flavor',
		 'item'=>'item',
		 'serving_size'=>'serving_size',
		 'calories'=>'filter_calories',
		 'fat'=>'filter_fat',
		 'carbs'=>'filter_carbs',
		 'protein'=>'filter_protein',
		 'fiber'=>'filter_fiber',
		 'sodium'=>'filter_sodium',
		 'rating'=>'filter_rating'];
$and="";
$file="".$hooks_dir."/../snacks_view.php";
$contents = file_get_contents($file);
$pattern = "/RecordsPerPage = \d*/";
preg_match($pattern, $contents, $matches);
$count=explode("= ",$matches[0])[1];
$where="WHERE 1=1 ";
if ($data['SearchString'] != '') {
	$where.=" and concat(".implode(",",array_keys($fields))." like '%".$data['SearchString']."%'";
}
unset($fields['serving_size']);
foreach ($fields as $field => $req) {
	if ($field==$req && isset($data[$req]) && $data[$req] != "") {
		$where.=" and ".$field." in ('".str_replace(",","','",$data[$field])."')";
	}
	else if ($data[$req] != "") {
		$minmax=explode(",",$data[$req]);
		$where.=" and CAST(COALESCE(".$field.",0) as DECIMAL(10,2)) between ".str_replace(",",".",$minmax[0])." and ".str_replace(",",".",$minmax[1]);
	}
}
// check if we can make this dynamic  TODO
$rowTemplate = remove_html_comments(@file_get_contents('../templates/snacks_templateTV_new.html'));
$and="";
if ($data['search'] != '') {
	$and.=" and concat('.', item, '.', brand, '.', flavor, '.', calories, '.', fat, '.', carbs, '.', protein, '.', fiber, '.', sodium, '.', serving_size, '.') like '.%".str_replace(" ","%",$data['search'])."%.'";
}
$orderby=" ORDER BY ";
$sort=' snacks.id desc';
if ($data['sorter'] != '') {
	$sortarr=explode(" ",$data['sorter']);
	$sort=" CAST(".$sortarr[0]." as decimal(10,2)) ".$sortarr[1].",".$sort;
}
if ($data['pagination'] != '') {
	if ($data['pagination'] == '1') {
		$curitem=$data['FirstRecord']+$count;
		$limit=" LIMIT ".($curitem-1).",".$count;
	}
	else {
		$curitem=($data['FirstRecord'])-$count;
		$limit=" LIMIT ".($curitem-1).", ".$count;
	}
}
else {
	$curitem=1;
	$limit.=" LIMIT ".$count."";
}
$sort=$orderby.$sort;
if ($data['filter_favorites'] == 1) {
	$join = " join favorites on (favorites.snackid = snacks.id and favorites.member='".$mi['username']."') ";
}
else {
	$join='';
}

$sql="SELECT snacks.ID from snacks ".$join."".$where."".$and."";	

$totalitems=db_num_rows(sql($sql,$eo));
$sql=$sql.$sort.$limit;
$res=sql($sql,$eo);
$new=[0];
$existing=array();
while ($row = db_fetch_assoc($res)) {
	$new[]=$row['ID'];
}
$newtempl=array();
$whereids.=" and snacks.id in (".implode(",",$new).")";
$sql="SELECT * from (SELECT `ID`, `brand`, `category`, `flavor`, `item`, `Illustration`, `serving_size`, `calories`, `fat`, `carbs`, `protein`, `fiber`, `sodium`, `am_link`, `name`, `rating`, `starcount`,
	(select count(1) from favorites f where f.member='".$mi['username']."' and f.snackid=snacks.id) as favorite from snacks) snacks ".$join."".$where." ".$whereids."".$sort."";

$res=sql($sql,$eo);
while ($row = db_fetch_assoc($res)) {
	$rtempl=$rowTemplate;
	foreach ($row as $f=>$v) {
		$rtempl = str_replace("<%%VALUE(".$f.")%%>", thisOr($v, ''), $rtempl);
	}
	$newtempl[]=$rtempl;
}
// get all select2 options for not yet filtered values
if ($data['brand'] == '') {
	$sql="select GROUP_CONCAT(brand) from (SELECT DISTINCT concat('{id:\"',brand, '\",text: \"',brand ,' (',count(brand),')','\"}') as brand from snacks ".$join."".$where."".$and." GROUP by brand) a";
	$sql="select concat('[',GROUP_CONCAT(brand),']') from (SELECT DISTINCT concat('{\"id\":\"',brand, '\",\"text\": \"',brand ,' (',count(brand),')','\"}') as brand from snacks ".$join."".$where."".$and." GROUP by brand) a";
	$brand=sql($sql,$eo);
}
else $brand="";
if ($data['category'] == '') {	
	$sql="select GROUP_CONCAT(category) from (SELECT DISTINCT concat('{id:\"',category, '\",text: \"',category ,' (',count(category),')','\"}') as category from snacks ".$join."".$where."".$and." GROUP by category) a";
	$sql="select concat('[',GROUP_CONCAT(category),']') from (SELECT DISTINCT concat('{\"id\":\"',category, '\",\"text\": \"',category ,' (',count(category),')','\"}') as category from snacks ".$join."".$where."".$and." GROUP by category) a";
	$category=sql($sql,$eo);
}
else $category="";
if ($data['flavor'] == '') {
	$sql="select GROUP_CONCAT(flavor) from (SELECT DISTINCT concat('{id:\"',flavor, '\",text: \"',flavor ,' (',count(flavor),')','\"}') as flavor from snacks ".$join."".$where."".$and." GROUP by flavor) a";
	$sql="select concat('[',GROUP_CONCAT(flavor),']') from (SELECT DISTINCT concat('{\"id\":\"',flavor, '\",\"text\": \"',flavor ,' (',count(flavor),')','\"}') as flavor from snacks ".$join."".$where."".$and." GROUP by flavor) a";
	$flavor=sql($sql,$eo);
}
else $flavor="";
if ($data['item'] == '') {
	$sql="select GROUP_CONCAT(item) from (SELECT DISTINCT concat('{id:\"',item, '\",text: \"',item ,' (',count(item),')','\"}') as item from snacks ".$join."".$where."".$and." GROUP by item) a";
	$sql="select concat('[',GROUP_CONCAT(item),']') from (SELECT DISTINCT concat('{\"id\":\"',item, '\",\"text\": \"',item ,' (',count(item),')','\"}') as item from snacks ".$join."".$where."".$and." GROUP by item) a";
	$item=sql($sql,$eo);	
}
else $item="";
echo json_encode([$existing,implode("",$newtempl),$totalitems,$count,$curitem,[$brand,$category,$flavor,$item]]);
return;