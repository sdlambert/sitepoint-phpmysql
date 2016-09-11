<?php

$config = parse_ini_file('./dbconfig.ini');

$dbuser = $config['dbuser'];
$dbpassword = $config['dbpassword'];

echo "Establishing link...<br>";
$link = mysqli_connect('localhost', $dbuser, $dbpassword);

echo "Checking connection...<br>";
// connected?
if(!$link) {
	$output = 'Unable to connect to database server.';
	include 'output.html.php';
	exit();
}

echo "Setting character encoding to UTF-8...<br>";
// set charset?
if (!mysqli_set_charset($link, 'utf8')) {
	$output = 'Unable to set the database connection encoding.';
	include 'output.html.php';
	exit();
}

echo "Selecting the database...<br>";
// select db
if (!mysqli_select_db($link, 'ijdb')) {
	$output = 'Unable to set the database connection encoding.';
	include 'output.html.php';
	exit();
}

$sql = 'CREATE TABLE joke (
          id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
          joketext TEXT,
          jokedate DATE NOT NULL
        ) DEFAULT CHARACTER SET utf8';
if (!mysqli_query($link, $sql))
{
	$output = 'Error creating joke table: ' . mysqli_error($link);
	include 'output.html.php';
	exit();
}
$output = 'Joke table successfully created.';
include 'output.html.php';



?>