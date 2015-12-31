<?php
	$MAX_ANSWERS = $_POST['max'];
	$text = intval($_POST['text']);
	$mult = intval($_POST['mult']);
	$textTotal = intval($_POST['textTotal']);
	$multTotal = intval($_POST['multTotal']);
	$textQuestions = array();
	$textAnswers = array();
	for ($i = 0; $i < $textTextTotal; ++$i)
	{
		$textQuestions[$i] = $_POST['qt' . $i];
		$textAnswers[$i] = $_POST['at' . $i];
	}
	$multQuestions = array();
	$multOptions = array();
	$multAnswers = array();
	for ($i = 0; $i < $multTotal; ++$i)
	{
		$multQuestions[$i] = $_POST['qm' . $i];
		$multOptions[$i] = array();
		for ($j = 0; $j < $MAX_ANSWERS; ++$j)
		{
			$multOptions[$i][$j] = $_POST['om' . $i . "-" . $j];
			$multAnswers[$i] = $_POST['am' . $i];
		}
	}
	$output = "\documentclass{article}


% Margins
\topmargin=-0.45in
\evensidemargin=0in
\oddsidemargin=0in
\textwidth=6.5in
\textheight=9.0in
\headsep=0.25in 


\linespread{1.1} % Line spacing

\setcounter{secnumdepth}{0} % Removes default section numbers
\newcounter{problemCounter} % Creates a counter to keep track of the number of problems

\newcommand{\problemName}{}
\newenvironment{problem}[1][Question \arabic{problemCounter}]{ 
\stepcounter{problemCounter} % Increase counter for number of problems
\renewcommand{\problemName}{#1} % Assign \homeworkProblemName the name of the problem
\section{\problemName} % Make a section in the document with the custom problem count
\enterProblemHeader{\problemName} % Header and footer within the environment
}{
\exitProblemHeader{\problemName} % Header and footer after the environment
}

\newcommand{\hmwkTitle}{" . $_POST['title'] . "} % Assignment title

\begin{document}
";

	$textqs = array();
	$textans = array();
	for ($i = 0; $i < count($textQuestions); ++$i)
	{
		$textqs[$i] = "
		\begin{problem}
		" . $textQuestions[$i] . "
		\end{problem}
		";
		$textans[$i] = "
		\begin{problem}
		" . $textAnswers[$i] . "
		\end{problem}
		";
	}
	$multipleqs = array();
	$multipleans = array();
	for ($i = 0; $i < count($multQuestions); ++$i)
	{
		$multipleqs[$i] = "
		\begin{problem}
		" . $multQuestions[$i]; 
		foreach ($multOptions[$i] as $option)
		{
			if ($option != "") 
			{
				$multipleqs[$i] .= "
				\\* \square " . $option;
			}
		}
		$multipleqs[$] .= "
		\end{problem}
		";
		$multipleans[$i] = "
		\begin{problem}
		" . $multAnswers[$i] . "
		\end{problem}
		";
	}
	for ($num = 0; $num < $_POST['tests']; ++$num)
	{
		$output .= "
		\setcounter{problemCounter}{1}
\textmd{\textbf{\hmwkTitle Questions" . $j . "}}\\
";
		$availableText = array();
		for ($i = 0; $i < count($textqs); ++$i)
		{
			$availableText[$i] = $i;
		}
		$availableMult = array();
		for ($i = 0; $i < count($multqs); ++$i)
		{
			$availableMult[$i] = $i;
		}
		$usedText = array_rand($availableText,$text);
		$usedMult = array_rand($availableMult,$mult);
		shuffle($usedText);
		shuffle($usedMult);
		foreach ($usedMult as $i)
		{
			$output .= $multipleqs[$i];
		}
		foreach ($usedText as $i)
		{
			$output .= $textqs[$i];
		}
		$output .= "
		\clearpage\setcounter{problemCounter}{1};
$textmd{\textbf{\hmwkTitle Answers " . $num . "}}\\
";
		foreach ($usedMult as $i)
		{
			$output .= $multipleans[$i];
		}
		foreach ($usedText as $i)
		{
			$output .= $textans[$i];
		}
		if ($num < $_POST['tests'] - 1)
			$output .= "
		\clearpage
		";
	}
	$output .= "
	\end{document}";
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
					Your LaTeX code, for your preferred parser (NOTE: no packages have been included. If you want to use any packages, add \usepackage{packagename} after the \documentclass{article} line):
					<textarea rows="10" cols="50">
						<?php echo $output; ?>
					</textarea>
				</td>
				<td class="right" width="15%">
			</tr>
		</table>
	</body>
</html>