<?php
	$MAX_OPTIONS = intval($_GET['max']);
?>

<html>
	<head>
		<title>
			Test Generator
		</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<table>
			<tr>
				<td class="left" width="15%">
				</td>
				<td class="centre" width="70%">
					<?php
						$text = intval($_GET["text"]);
						$mult = intval($_GET["mult"]);
						$textTotal = intval($_GET["textTotal"]);
						$multTotal = intval($_GET["multTotal"]);
						echo '<form action="process.php" method="post">';
						echo 'Title: <input type="text" name="title">'
						$j = 0;
						for ($i = 0; $i < $text; ++$i)
						{
							echo '<div style="heading">Text Question ' + $i + ' </div>';
							echo '<div style="q' . $j . '"><p>Question: <textarea name="qt' . $i . '"></textarea></p>';
							echo '<p>Answer: <textarea name="at' . $i . '"></textarea></p></div>';
							$j = 1 - $j;
						}
						for ($i = 0; $i < $text; ++$i)
						{
							echo '<div style="heading">Multiple Choice Question ' . $i . ' </div>';
							echo '<div style="q' . $j . '"><p>Question Text: <textarea name="qm' . $i . '"></textarea></p>';
							echo '<p>Options: <br><list>';
							for ($k = 0; $k < $MAX_OPTIONS; ++$k)
							{
								echo '<li><input type="text" name="om' . $i . "-" . $k . '"></li>';
							}
							echo '</list></p>';
							echo '<p>Answer:<br><list>'
							for ($k = 0; $k < $MAX_OPTIONS; ++$k)
							{
								echo '<li><input type="radio" name="am' . $i . '" value = ' . $k . '></li>';
							}
							echo '</list></p>';
							$j = 1 - $j;
						}
						echo '<div style="submit"><input type="submit" value="Generate LaTeX">';
						echo '<input type="hidden" name="text" value="' . $text . '">';
						echo '<input type="hidden" name="mult" value="' . $mult . '">';
						echo '<input type="hidden" name="textTotal" value="' . $textTotal . '">';
						echo '<input type="hidden" name="multTotal" value="' . $multTotal . '">';
						echo '<input type="hidden" name="tests" value = "' . $_GET['tests'] . '">'
						echo '<input type="hidden" name="max" value = "' . $MAX_OPTIONS . '">';
						echo '</form>';
					?>
				</td>
				<td class="right" width="15%">
			</tr>
		</table>
	</body>
</html>