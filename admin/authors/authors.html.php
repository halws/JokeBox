<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/php/chapter7/includes/helpers.inc.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title> </head>
<body>
	<h1>Authors controlling</h1>
	<p><a href="?add">Add new author</a></p>
	<ul>
		<?php foreach ($authors as $author): ?>

				<li><form action="" method="post">
					<div>
								<?php htmlout($author['name']); ?>
						<input type="hidden" name="id" value=" <?php echo $author['id']; ?>">
						<input type="submit" name="action" value="Edit">
						<input type="submit" name="action" value="Delete">
					</div>
				</form></li>
		<?php endforeach ?>
	</ul>
	<p><a href="..">Back to main page</a></p>
</body>
</html>