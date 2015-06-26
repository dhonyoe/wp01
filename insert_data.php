<?php

/*
  $data = array(
  'title' => 'abc',
  'content' => 'Testing',
  'status' => 'a',
  'date_time' => time()
  );
 */
//echo '<pre>';

mysql_connect('localhost', 'jd', 'jd');
mysql_select_db('json_test');

$sql = "SELECT * FROM post_data";
$_data = array();
if($res = mysql_query($sql)) {
	while($row = mysql_fetch_assoc($res)) {
		$_data[] = $row;
	}
}

echo json_encode($_data);

die;

$input = file_get_contents('php://input');

//echo $input;


//print_r($_POST);
//$json = json_decode($_POST['json'], true);


$json = json_decode($input, true);
//print_r($json);
//die;

$data = array(
	'title' => $json['title'],
	'content' => $json['content'],
	'status' => $json['status'],
	'date_time' => time()
);




$sql = "INSERT INTO "
		. "`post_data` (`title`, `content`, `status`, `date_time`)"
		. "VALUES ('{$data['title']}', '{$data['content']}', {$data['status']}, '{$data['date_time']}')";

$return = array('status' => 0, 'message' => '');

if (mysql_query($sql)) {
	$id = mysql_insert_id();
	$return['status'] = 1;
	$return['message'] = $id;
} else {
	$error = mysql_error();
	$return['message'] = $error;
}

echo json_encode($return);
