<?php

$filename = md5(mt_rand()).'.jpg';
$status = (boolean) move_uploaded_file($_FILES['files']['tmp_name'], '/tmp/'.$filename);

$response = (object) [
	'status' => $status
];

if ($status) {
	$response->url = '/tmp/'.$filename;
}

echo json_encode($response);
