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
					<form action="entry.php" method="get">
						Text questions per test: <input type="text" name="text">
						Multiple choice questions per test: <input type="text" name="mult">
						Total text questions: <input type="text" name="textTotal">
						Total multiple choice questions: <input type="text" name="multTotal">
						Maximum number of options on multiple choice questions: <input type="text" name="max">
						Total tests to output: <input type="text" name="tests">
						<input type="submit" value="Go To Data Entry">
					</form>
				</td>
				<td class="right" width="15%">
				</td>
			</tr>
		</table>
	</body>
</html>