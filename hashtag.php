<?php

require 'twitter.php';


$k = new Twitter();
$hashtags = $k->hashtag("custserv");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Hashtag</title>
</head>
<body>
<?php foreach ($hashtags as $h): ?>
<p><?php echo $h;?></p><br>
<?php endforeach ?>
</body>
</html>