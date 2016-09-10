<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Pass it Along | Part II</title>
	</head>
	<body>
		<p>
			<?php
			$firstname = htmlspecialchars($_GET['firstname'], ENT_QUOTES, 'UTF-8');
			echo 'Welcome to our web site, ' . $firstname . '!';
			?>
		</p>
	</body>
</html>