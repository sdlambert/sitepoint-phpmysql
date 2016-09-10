<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Query String Link Example</title>
	</head>
	<body>
		<p>
			<?php

			$name = $_GET['name'];

			// We use the htmlspecialchars() function here to ensure that no
			// malicious code makes it into our page.

			echo 'Welcome to our web site, ' .
						htmlspecialchars($name, ENT_QUOTES, 'utf-8') . '!';

			?>
		</p>
	</body>
</html>