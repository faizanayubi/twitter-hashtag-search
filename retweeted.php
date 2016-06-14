<?php

require 'twitter.php';

$k = new Twitter();
$retweets = $k->retweets();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Hashtag</title>
</head>
<body>
<?php foreach ($retweets as $t): ?>
<p><?php echo $t;?></p><br>
<?php endforeach ?>
</body>
</html>