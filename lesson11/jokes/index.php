<?php

include_once $_SERVER['DOCUMENT ROOT'] . 'projects/sitepoint-phpmysql/includes/magicquotes.inc.php';

if (isset($_GET['addjoke']))
{
	include 'form.html.php';
	exit();
}

include_once $_SERVER['DOCUMENT ROOT'] . 'projects/sitepoint-phpmysql/includes/db.inc.php';

if (isset($_POST['joketext']))
{
	$joketext = mysqli_real_escape_string($link, $_POST['joketext']);
	$sql = 'INSERT INTO joke SET
			joketext="' . $joketext . '",
			jokedate=CURDATE()';
	if (!mysqli_query($link, $sql))
	{
		$error = 'Error adding submitted joke: ' . mysqli_error($link);
		include 'error.html.php';
		exit();
	}

	header('Location: .');
	exit();
}

if (isset($_GET['deletejoke']))
{
	$id = mysqli_real_escape_string($link, $_POST['id']);
	$sql = "DELETE FROM joke WHERE id='$id'";
	if (!mysqli_query($link, $sql))
	{
		$error = 'Error deleting joke: ' . mysqli_error($link);
		include 'error.html.php';
		exit();
	}

	header('Location: .');
	exit();
}

$result = mysqli_query($link, 'SELECT id, joketext FROM joke');
if (!$result)
{
	$error = 'Error fetching jokes: ' . mysqli_error($link);
	include 'error.html.php';
	exit();
}

while ($row = mysqli_fetch_array($result))
{
	$jokes[] = array('id' => $row['id'], 'text' => $row['joketext']);
}

include 'jokes.html.php';
?>