<?php include_once $_SERVER['DOCUMENT_ROOT'] .
		'projects/sitepoint-phpmysql/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><?php htmlOut($pagetitle); ?></title>
	</head>
	<body>
		<h1><?php htmlOut($pagetitle); ?></h1>
		<form action="?<?php htmlOut($action); ?>" method="post">
			<div>
				<label for="name">Name: <input type="text" name="name"
						id="name" value="<?php htmlOut($name); ?>"></label>
			</div>
			<div>
				<label for="email">Email: <input type="text" name="email"
						id="email" value="<?php htmlOut($email); ?>"></label>
			</div>
			<div>
				<input type="hidden" name="id" value="<?php
						htmlOut($id); ?>">
				<input type="submit" value="<?php htmlOut($button); ?>">
			</div>
		</form>
	</body>
</html>