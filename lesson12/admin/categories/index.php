<?php

include_once $_SERVER['DOCUMENT_ROOT'] .
	'projects/sitepoint-phpmysql/includes/magicquotes.inc.php';

//ADD

// Load the form to add a new category
if (isset($_GET['add'])) {

	// set page variables
	$pagetitle = 'New Category';
	$action    = 'addform';
	$name      = '';
	$id        = '';
	$button    = 'Add category';

	include 'form.html.php';
	exit();
}

// New category submitted
if (isset($_GET['addform'])) {
	include $_SERVER['DOCUMENT_ROOT'] . 'projects/sitepoint-phpmysql/includes/db.inc.php';

	$name = mysqli_real_escape_string($link, $_POST['name']);
	$sql  = "INSERT INTO category (name) VALUES ('$name')";

	if(!mysqli_query($link, $sql)) {
		$error = 'Error adding submitted category.';
		include 'error.html.php';
		exit();
	}
}

//EDIT

if (isset($_POST['action']) and $_POST['action'] == 'Edit') {
	include $_SERVER['DOCUMENT_ROOT'] . 'projects/sitepoint-phpmysql/includes/db.inc.php';

	$id     = mysqli_real_escape_string($link, $_POST['id']);
	$sql    = "SELECT id, name FROM category WHERE id='$id'";
	$result = mysqli_query($link, $sql);

	if (!$result) {
		$error = 'Error fetching author details.';
		include 'error.html.php';
		exit();
	}

	// Set page variables
	$row       = mysqli_fetch_array($result);
	$pagetitle = 'Edit Category';
	$action    = 'editform';
	$name      = $row['name'];
	$id        = $row['id'];
	$button    = 'Update category';

	include 'form.html.php';
	exit();
}

if (isset($_GET['editform'])) {
	include $_SERVER['DOCUMENT_ROOT'] . 'projects/sitepoint-phpmysql/includes/db.inc.php';

	$id   = mysqli_real_escape_string($link, $_POST['id']);
	$name = mysqli_real_escape_string($link, $_POST['name']);
	$sql  = "UPDATE category
	         SET name='$name'
					 WHERE id='$id'";

	if (!mysqli_query($link, $sql))
	{
		$error = 'Error updating submitted author.';
		include 'error.html.php';
		exit();
	}

	header('Location: .');
	exit();
}

// DELETE CATEGORY
if (isset($_POST['action']) and $_POST['action'] == 'Delete') {
	include $_SERVER['DOCUMENT_ROOT'] . 'projects/sitepoint-phpmysql/includes/db.inc.php';

	// Get all joke ids belonging to the category
	$id     = mysqli_real_escape_string($link, $_POST['id']);
	$sql    = "SELECT jokeid FROM jokecategory WHERE categoryid='$id'";
	$result = mysqli_query($link, $sql);

	if (!$result)
	{
		$error = 'Error getting list of categories from jokecategory.';
		include 'error.html.php';
		exit();
	}

	// Delete each joke of that category from the joke table
	while ($row = mysqli_fetch_array($result)) {
		$jokeid = $row[0];
		$sql    = "DELETE FROM joke WHERE id='$jokeid'";

		if (!mysqli_query($link, $sql)) {
			$error = 'Error deleting jokes from joke table.';
			include 'error.html.php';
			exit();
		}
	}

	// Delete the jokecategory entries
	$sql    = "DELETE FROM jokecategory WHERE categoryid='$id'";
	$result = mysqli_query($link, $sql);

	if (!$result)
	{
		$error = 'Error deleting jokecategory entries.';
		include 'error.html.php';
		exit();
	}

	// Delete the category itself
	$sql    = "DELETE FROM category WHERE id='$id'";
	$result = mysqli_query($link, $sql);

	if(!$result) {
		$error = 'Error deleting category entry.';
		include 'error.html.php';
		exit();
	}

	header('Location: .');
	exit();
}

//DEFAULT
//Display category list
include $_SERVER['DOCUMENT_ROOT'] . 'projects/sitepoint-phpmysql/includes/db.inc.php';

$result = mysqli_query($link, 'SELECT id, name FROM category');
if(!$result) {
	$error = 'Error fetching categories from database!';
	include 'error.html.php';
	exit();
}

while ($row = mysqli_fetch_array($result)) {
	$categories[] = array('id' => $row['id'], 'name' => $row['name']);
}

include 'categories.html.php';

?>