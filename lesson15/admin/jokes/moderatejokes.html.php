<?php include_once $_SERVER['DOCUMENT_ROOT'] . 'projects/sitepoint-phpmysql/includes/helpers.inc.php';?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Manage Jokes: Moderate</title>
	</head>
	<body>
		<h1>Moderate Jokes</h1>
		<?php if (isset($jokes)): ?>
		<table>
			<tr><th>Joke Text</th><th>Options</th></tr>
			<?php foreach ($jokes as $joke): ?>
			<tr valign="top">
				<td><?php htmlOut($joke['text']);?></td>
				<td>
					<form action="?" method="post">
						<div>
							<input type="hidden" name="id" value="<?php
htmlOut($joke['id']);?>">
							<input type="submit" name="action" value="Edit">
							<input type="submit" name="action" value="Delete">
						</div>
					</form>
				</td>
			</tr>
			<?php endforeach;?>
		</table>
		<?php else: ?>
			<p>We could not find any results matching your criteria. Please try again.</p>
		<?php endif;?>
		<p><a href="?">New search</a></p>
		<p><a href="..">Return to JMS home</a></p>
		<?php include '../logout.inc.html.php'; ?>
	</body>
</html>