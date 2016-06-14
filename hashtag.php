<?php

require 'twitter.php';


$k = new Twitter();
$htag = "entrepeneur";
$hashtags = $k->hashtag($htag);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Hashtag</title>
</head>
<body>
<h1>Tweets with Hashtag: <u><?php echo $htag;?></u></h1>
<?php foreach ($hashtags as $h): ?>
<p><?php echo $h;?></p><br>
<?php endforeach ?>
</body>
</html>