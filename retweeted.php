<?php

require 'twitter.php';

$k = new Twitter();
$retweets = $k->retweets();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Retweets</title>
</head>
<body>
<h1>Retweets</h1><hr><br>
<?php foreach ($retweets as $t): ?>
<p><?php echo $t;?></p><br>
<?php endforeach ?>
</body>
</html>