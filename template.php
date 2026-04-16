<?php

$challengeName="Sample";
$theFLAG="cybershield{TEMPLATE}";
$questions=
[	"q1" => [
		"q" => "question 1",
		"a" => ["POSSIBLE ANSWER 1", "POSSIBLE ANSWER 2", "POSSIBLE ANSWER 3"]
	],
	"q2" => [
		"q" => "question 2",
		"a" => ["POSSIBLE ANSWER 1", "POSSIBLE ANSWER 2", "POSSIBLE ANSWER 3"]
	],
	"q3" => [
		"q" => "question 3",
		"a" => ["POSSIBLE ANSWER 1", "POSSIBLE ANSWER 2", "POSSIBLE ANSWER 3"]
	],
];

$minQuestionsNeeded=count($questions);


?>

<?php 
include 'quizframework.php';
?>