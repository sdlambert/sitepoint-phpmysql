<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Pass it Along | Part I</title>
	</head>
	<body>
		<p>
			<?php
			$firstname = htmlspecialchars($_POST['firstname'], ENT_QUOTES, 'UTF-8');
			$lastname = htmlspecialchars($_POST['lastname'], ENT_QUOTES, 'UTF-8');
			echo 'Welcome to our web site, ' . $firstname . ' ' . $lastname . '!';
			?>
		</p>
		<p>Click <a href="formpass2.php?firstname=<?php echo $firstname ?>">here</a> to pass on the $firstname variable.</p>
	</body>
</html>