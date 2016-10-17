<?php

include_once $_SERVER['DOCUMENT_ROOT'] . 'projects/sitepoint-phpmysql/includes/magicquotes.inc.php';

if (isset($_GET['addjoke']))
{
	include 'form.html.php';
	exit();
}

include_once $_SERVER['DOCUMENT_ROOT'] . 'projects/sitepoint-phpmysql/includes/db.inc.php';

if (isset($_POST['joketext']))
{
	$authorname  = mysqli_real_escape_string($link, $_POST['authorname']);
	$authoremail = mysqli_real_escape_string($link, $_POST['authoremail']);

	$sql = 'SELECT id FROM author
	        WHERE name="' . $authorname . '"AND
	        email="' . $authoremail . '"';

	if (!$result = mysqli_query($link, $sql))
	{
		$error = 'Error selecting existing author: ' . mysqli_error($link);
		include 'error.html.php';
		exit();
	}

	if(mysqli_num_rows($result) > 0) {
		// We have an existing author
		$row      = mysqli_fetch_array($result);
		$authorid = $row['id'];

	} else {
		// we have a new author
		$sql = 'INSERT INTO author (name, email)
		        VALUES ("' . $authorname . '", "' . $authoremail . '")';

		if (!mysqli_query($link, $sql))
		{
			$error = 'Error adding new author: ' . mysqli_error($link);
			include 'error.html.php';
			exit();
		}

		$authorid = mysqli_insert_id($link);
	}

	echo "$authorid";

	$joketext    = mysqli_real_escape_string($link, $_POST['joketext']);
	$sql         = 'INSERT INTO joke SET
	                joketext="' . $joketext . '",
	                jokedate=CURDATE(),
	                authorid=' . $authorid;

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
	$id  = mysqli_real_escape_string($link, $_POST['id']);
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

$result = mysqli_query($link, 'SELECT id, joketext FROM joke WHERE visible = \'YES\'');

if (!$result)
{
	$error = 'Error fetching jokes: ' . mysqli_error($link);
	include 'error.html.php';
	exit();
}

$jokes = array();

while ($row = mysqli_fetch_array($result))
{
	$jokes[] = array('id' => $row['id'], 'text' => $row['joketext']);
}

include 'jokes.html.php';
?>