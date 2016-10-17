<?php

include_once $_SERVER['DOCUMENT_ROOT'] .
	'projects/sitepoint-phpmysql/includes/magicquotes.inc.php';

require_once $_SERVER['DOCUMENT_ROOT'] . 'projects/sitepoint-phpmysql/includes/access.inc.php';

if (!userIsLoggedIn())
{
	include '../login.html.php';
	exit();
}

if (!userHasRole('Content Editor'))
{
	$error = 'Only Content Editors may access this page.';
	include '../accessdenied.html.php';
	exit();
}

// DELETE JOKE
// ==============================
// User has requested to delete a joke

if (isset($_POST['action']) and $_POST['action'] == 'Delete')
{
	include $_SERVER['DOCUMENT_ROOT'] . 'projects/sitepoint-phpmysql/includes/db.inc.php';

	$id = mysqli_real_escape_string($link, $_POST['id']);

	// Delete category assignments for this joke
	$sql = "DELETE FROM jokecategory WHERE jokeid='$id'";
	if (!mysqli_query($link, $sql))
	{
		$error = 'Error removing joke from categories.';
		include 'error.html.php';
		exit();
	}

	// Delete the joke
	$sql = "DELETE FROM joke WHERE id='$id'";

	if (!mysqli_query($link, $sql))
	{
		$error = 'Error deleting joke.';
		include 'error.html.php';
		exit();
	}

	header('Location: .');
	exit();
}

// EDIT JOKE
// ==============================
// Edit existing joke

if (isset($_GET['editform']))
{
	include $_SERVER['DOCUMENT_ROOT'] . 'projects/sitepoint-phpmysql/includes/db.inc.php';

	$text   = mysqli_real_escape_string($link, $_POST['text']);
	$author = mysqli_real_escape_string($link, $_POST['author']);
	$id     = mysqli_real_escape_string($link, $_POST['id']);

	if($_POST['visible'] == 1) {
		$visible = "YES";
	}
	else
		$visible = "NO";

	if ($author == '')
	{
		$error = 'You must choose an author for this joke.
				Click &lsquo;back&rsquo; and try again.';
		include 'error.html.php';
		exit();
	}

	$sql = "UPDATE joke SET
	        joketext = '$text',
	        authorid = '$author',
	        visible  = '$visible'
	        WHERE id = '$id'";

	if (!mysqli_query($link, $sql))
	{
		$error = 'Error updating submitted joke.';
		include 'error.html.php';
		exit();
	}

	$sql = "DELETE FROM jokecategory WHERE jokeid='$id'";

	if (!mysqli_query($link, $sql))
	{
		$error = 'Error removing obsolete joke category entries.';
		include 'error.html.php';
		exit();
	}

	if (isset($_POST['categories']))
	{
		foreach ($_POST['categories'] as $category)
		{
			$categoryid = mysqli_real_escape_string($link, $category);
			$sql = "INSERT INTO jokecategory SET
					jokeid     = '$id',
					categoryid = '$categoryid'";
			if (!mysqli_query($link, $sql))
			{
				$error = 'Error inserting joke into selected category.';
				include 'error.html.php';
				exit();
			}
		}
	}
	header('Location: .');
	exit();
}

// NEW JOKE
// ==============================
// Add new joke has been selected

if (isset($_GET['add'])) {
	include $_SERVER['DOCUMENT_ROOT'] . 'projects/sitepoint-phpmysql/includes/db.inc.php';

	$pagetitle = 'New Joke';
	$action    = 'addform';
	$text      = '';
	$authorid  = '';
	$id        = '';
	$button    = 'Add joke';

	// Build the list of authors
	$sql    = "SELECT id, name FROM author";
	$result = mysqli_query($link, $sql);

	if (!$result) {
		$error = 'Error fetching list of authors.';
		include 'error.html.php';
		exit();
	}

	while ($row = mysqli_fetch_array($result)) {
		$authors[] = array('id' => $row['id'], 'name' => $row['name']);
	}

	// Build the list of categories
	$sql    = "SELECT id, name FROM category";
	$result = mysqli_query($link, $sql);

	if (!$result) {
		$error = 'Error fetching list of categories.';
		include 'error.html.php';
		exit();
	}

	while ($row = mysqli_fetch_array($result)) {
		$categories[] = array(
			'id'       => $row['id'],
			'name'     => $row['name'],
			'selected' => FALSE);
	}

	include 'form.html.php';
	exit();
}


// MODERATE JOKES
// ================================
// Requets to moderate hidden jokes.

if(isset($_GET['moderate'])) {
	include $_SERVER['DOCUMENT_ROOT'] . 'projects/sitepoint-phpmysql/includes/db.inc.php';

	$sql    = "SELECT id, joketext FROM joke WHERE visible = 'NO'";
	$result = mysqli_query($link, $sql);

	if (!$result) {
		$error = 'Error fetching jokes for moderation.';
		include 'error.html.php';
		exit();
	}
	$jokes = array();

	while ($row = mysqli_fetch_array($result)) {
		$jokes[] = array('id' => $row['id'],
			                'text' => $row['joketext']);
	}
	include('moderatejokes.html.php');
	exit();
}

// SUBMIT NEW JOKE
// ===============================
// The new joke is being submitted

if (isset($_GET['addform']))
{
	include $_SERVER['DOCUMENT_ROOT'] . 'projects/sitepoint-phpmysql/includes/db.inc.php';

	$text   = mysqli_real_escape_string($link, $_POST['text']);
	$author = mysqli_real_escape_string($link, $_POST['author']);

	if($_POST['visible'] == 1) {
		$visible = "YES";
	}
	else
		$visible = "NO";

	if ($author == '') {
		$error = 'You must choose an author for this joke. Click &lsquo;back&rsquo; and try again.';
		include 'error.html.php';
		exit();
	}

	// Add joke into database
	$sql = "INSERT INTO joke SET
	        joketext = '$text',
	        jokedate = CURDATE(),
	        visible  = '$visible',
	        authorid = '$author'";

	if (!mysqli_query($link, $sql)) {
		$error = 'Error adding submitted joke.';
		include 'error.html.php';
		exit();
	}

	// Get id of the joke we just added
	$jokeid = mysqli_insert_id($link);

	// Associate joke with categories, if any
	if (isset($_POST['categories'])) {
		foreach ($_POST['categories'] as $category) {
			$categoryid = mysqli_real_escape_string($link, $category);
			$sql = "INSERT INTO jokecategory SET
			        jokeid     = '$jokeid',
			        categoryid = '$categoryid'";

			if (!mysqli_query($link, $sql)) {
				$error = 'Error inserting joke into selected category.';
				include 'error.html.php';
				exit();
			}
		}
	}

	header('Location: .');
	exit();
}

// EDIT
// ===================
// Edit existing jokes

if (isset($_POST['action']) and $_POST['action'] == 'Edit') {
	include $_SERVER['DOCUMENT_ROOT'] . 'projects/sitepoint-phpmysql/includes/db.inc.php';

	$id     = mysqli_real_escape_string($link, $_POST['id']);
	$sql    = "SELECT id, joketext, authorid, visible FROM joke WHERE id='$id'";
	$result = mysqli_query($link, $sql);

	if (!$result) {
		$error = 'Error fetching joke details.';
		include 'error.html.php';
		exit();
	}

	$row       = mysqli_fetch_array($result);
	$pagetitle = 'Edit Joke';
	$action    = 'editform';
	$text      = $row['joketext'];
	$authorid  = $row['authorid'];
	$id        = $row['id'];
	$visible   = ($row['visible'] == 'YES') ? TRUE : FALSE;
	$button    = 'Update joke';

	// Build the list of authors
	$sql    = "SELECT id, name FROM author";
	$result = mysqli_query($link, $sql);

	if (!$result) {
		$error = 'Error fetching list of authors.';
		include 'error.html.php';
		exit();
	}

	while ($row = mysqli_fetch_array($result)) {
		$authors[] = array('id' => $row['id'], 'name' => $row['name']);
	}

	// Get list of categories containing this joke
	$sql    = "SELECT categoryid FROM jokecategory WHERE jokeid='$id'"; // 1
	$result = mysqli_query($link, $sql);

	if (!$result) {
		$error = 'Error fetching list of selected categories.';
		include 'error.html.php';
		exit();
	}

	while ($row = mysqli_fetch_array($result)) {
		$selectedCategories[] = $row['categoryid']; // 2
	}

	// Build the list of all categories
	$sql    = "SELECT id, name FROM category";
	$result = mysqli_query($link, $sql);

	if (!$result) {
		$error = 'Error fetching list of categories.';
		include 'error.html.php';
		exit();
	}

	while ($row = mysqli_fetch_array($result)) {
		$categories[] = array(
			'id'       => $row['id'],
			'name'     => $row['name'],
			'selected' => in_array($row['id'], $selectedCategories)); // 3
	}

	include 'form.html.php';
	exit();
}

// SEARCH
// ========================
// Search has been selected

if (isset($_GET['action']) and $_GET['action'] == 'search') {
	include $_SERVER['DOCUMENT_ROOT'] . 'projects/sitepoint-phpmysql/includes/db.inc.php';

	// The basic SELECT statement
	$select = 'SELECT id, joketext';
	$from   = ' FROM joke';
	$where  = ' WHERE TRUE';

	// Author
	$authorid = mysqli_real_escape_string($link, $_GET['author']);

	if ($authorid != '') {
		// An author is selected
		$where .= " AND authorid='$authorid'";
	}

	// Category
	$categoryid = mysqli_real_escape_string($link, $_GET['category']);

	if ($categoryid != '') {
		// A category is selected
		$from  .= ' INNER JOIN jokecategory ON id = jokeid';
		$where .= " AND categoryid='$categoryid'";
	}

	// Joke text
	$text = mysqli_real_escape_string($link, $_GET['text']);

	if ($text != '') {
		// Some search text was specified
		$where .= " AND joketext LIKE '%$text%'";
	}

	// Get results
	$result = mysqli_query($link, $select . $from . $where);

	if (!$result) {
		$error = 'Error fetching jokes.';
		include 'error.html.php';
		exit();
	}

	while ($row = mysqli_fetch_array($result)) {
		$jokes[] = array('id' => $row['id'], 'text' => $row['joketext']);
	}

	include 'jokes.html.php';
	exit();
}

// DEFAULT
// ===================
// Display search form

include $_SERVER['DOCUMENT_ROOT'] . 'projects/sitepoint-phpmysql/includes/db.inc.php';

$result = mysqli_query($link, 'SELECT id, name FROM author');

if (!$result) {
	$error = 'Error fetching authors from database!';
	include 'error.html.php';
	exit();
}

while ($row = mysqli_fetch_array($result)) {
	$authors[] = array('id' => $row['id'], 'name' => $row['name']);
}

$result = mysqli_query($link, 'SELECT id, name FROM category');

if (!$result) {
	$error = 'Error fetching categories from database!';
	include 'error.html.php';
	exit();
}

while ($row = mysqli_fetch_array($result)) {
	$categories[] = array('id' => $row['id'], 'name' => $row['name']);
}

include 'searchform.html.php';
?>