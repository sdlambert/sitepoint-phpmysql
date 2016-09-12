<?php
// magic quotes
if (get_magic_quotes_gpc())
{
  function stripslashes_deep($value)
  {
    $value = is_array($value) ?
        array_map('stripslashes_deep', $value) :
        stripslashes($value);
    return $value;
  }
  $_POST = array_map('stripslashes_deep', $_POST);
  $_GET = array_map('stripslashes_deep', $_GET);
  $_COOKIE = array_map('stripslashes_deep', $_COOKIE);
  $_REQUEST = array_map('stripslashes_deep', $_REQUEST);
}


// Adding a joke? Give them the form and stop executing
if (isset($_GET['addjoke']))
{
  include 'form.html.php';
  exit();
}

// read in dbconfig
$dbconfig = parse_ini_file('./dbconfig.ini');

$dbuser = $dbconfig['dbuser'];
$dbpassword = $dbconfig['dbpassword'];

// connect to DB
$link = mysqli_connect('localhost', $dbuser, $dbpassword);

// check for errors, if found stop executing
if (!$link)
{
	$error = 'Unable to connect to the database server.';
	include 'error.html.php';
	exit();
}

if (!mysqli_set_charset($link, 'utf8'))
{
	$output = 'Unable to set database connection encoding.';
	include 'output.html.php';
	exit();
}

if (!mysqli_select_db($link, 'ijdb'))
{
	$error = 'Unable to locate the joke database.';
	include 'error.html.php';
	exit();
}

// Inserting the joke? Create the query to INSERT into the DB
if (isset($_POST['joketext'])) {
	// prevent SQL injection
	$joketext = mysqli_real_escape_string($link, $_POST['joketext']);
	$sql = 'INSERT INTO joke SET
    joketext="' . $joketext . '",
    jokedate=CURDATE()';
  // make query
  if (!mysqli_query($link, $sql))
  {
  	// handle any errors
    $error = 'Error adding submitted joke: ' . mysqli_error($link);
    include 'error.html.php';
    exit();
  }
  // redirect to the controller, stop executing
  header('Location: .');
  exit();
}

// Default
$result = mysqli_query($link, 'SELECT joketext FROM joke');
if (!$result)
{
	// check for errors, if found stop executing
	$error = 'Error fetching jokes: ' . mysqli_error($link);
	include 'error.html.php';
	exit();
}

// display jokes
while ($row = mysqli_fetch_array($result))
{
	$jokes[] = $row['joketext'];
}

include 'jokes.html.php';
?>