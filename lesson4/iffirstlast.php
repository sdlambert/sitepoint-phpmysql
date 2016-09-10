<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Form Example</title>
	</head>
	<body>
		<p>
			<?php
			$firstname = $_REQUEST['firstname'];
			$lastname = $_REQUEST['lastname'];
			if ($firstname == 'Scott' and $lastname == 'Lambert')
			{
				echo 'Welcome, oh glorious leader!';
			}
			else
			{
				echo 'Welcome to our web site, ' .
						htmlspecialchars($firstname, ENT_QUOTES, 'UTF-8') .
						htmlspecialchars($lastname, ENT_QUOTES, 'UTF-8') . '!';
			}
			?>
		</p>
	</body>
</html>