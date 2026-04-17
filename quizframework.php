<?php
// Set unset values
if(!isset($challengeName))		$challengeName="Default Name";
if(!isset($theFLAG))			$theFLAG="slug{flag}";
if(!isset($questions))
{	echo("No questions defined.");
	die();
}
if(!isset($minQuestionsNeeded))	$minQuestionsNeeded=count($questions);
?>
<?php
$giveFlag=false;
$answersPassed=($_SERVER['REQUEST_METHOD']==='POST');
$results=[];

if($answersPassed)
{	$giveFlag=false;
	$numCorrect=0;
	foreach($questions as $i=>$qa)
	{	$user_answer=strtoupper(preg_replace('/\s+/',' ',trim($_POST[$i]??'')));
		$is_correct=in_array($user_answer,$qa['a'],true);
		$results[$i]=$is_correct;
		if($is_correct) $numCorrect++;
		//if(!$is_correct) $giveFlag=false;
    }
	if($numCorrect>=$minQuestionsNeeded) $giveFlag=true;
}
?>
<html>
<head>
	<title><?=htmlspecialchars($challengeName??'',ENT_QUOTES,'UTF-8')?></title>
	<link rel="stylesheet" href="style.css">
</head>
<body>




<?php if($giveFlag): ?>
	<script>localStorage.setItem('scrollY',null);</script>
	<div class="flagContainer">
		<p id="FLAG" onclick="navigator.clipboard.writeText(this.innerHTML)">
			<?= htmlspecialchars($theFLAG,ENT_QUOTES,'UTF-8'); ?>
		</p>
	</div>
<?php endif; ?>


	<div>
		<div><p>&nbsp;</p></div>
	</div>
<div class="formcontainer">
	<form method="POST" action="">
		<h1><?=htmlspecialchars($challengeName??'',ENT_QUOTES,'UTF-8')?></h1>
		<hr>
		<?php foreach ($questions as $i => $qa): ?>
			<?php
			// Determine if answer was correct on previous submission:
				$userScore='';
				if($answersPassed) $userScore=!empty($results[$i])?'correct':'incorrect';
			?>
			
			<label for="<?= $i ?>">
				<?= $qa['q'];  "\\ <--- Line not escaped, subject to injection attacks, I am assuming my questions are secure; I am doing this " ?>
			</label>
			
			<br>
			
			<input
				type="text"
				id="<?=$i?>"
				name="<?=$i?>"
				class="<?=$userScore?>"
				value="<?=htmlspecialchars($_POST[$i]??'',ENT_QUOTES,'UTF-8')?>"
			>
			<hr>
		<?php endforeach; ?>
	
		<button type="submit">Check Answers</button>
	</form>
</div>

</body>
</html>

<script>
// https://medium.com/@a1guy/save-and-restore-scroll-position-in-javascript-no-libraries-needed-c38688b977fa
//	let timeout;
//	window.addEventListener("scroll", () => {
//	  clearTimeout(timeout);
//	  timeout = setTimeout(() => {
//	    localStorage.setItem("scrollY", window.scrollY);
//	  }, 200); // Debounce to avoid saving too frequently
//	});
document.querySelector('form').addEventListener('submit',
	function()
	{	localStorage.setItem('scrollY',window.scrollY);
	}
);

window.addEventListener("load", () => {
  const savedY = localStorage.getItem("scrollY");
  if (savedY !== null) {
    window.scrollTo(0, parseInt(savedY));
  }
});
</script>