<?php
require_once "inc/headers.php";
require_once "inc/functions.php";

//http://localhost/todolist/search.php/criteria
$uri = parse_url(filter_input(INPUT_SERVER,"PATH_INFO"),PHP_URL_PATH);
//$parameters = explode("/", $uri);
$criteria = $uri[1];

try {
$db = openDB();
$sql = "select * from task where description like '%$criteria%'";
$query = $db->query($sql);
$results = $query->fetchAll(PDO::FETCH_ASSOC);
echo header ("HTTP/1.1 200 OK");
echo json_encode($results);
}
catch (PDOException $pdoex) {
    returnError($pdoex);
}