<html>
<head>
    <title>RedditGamJam05 game that is somehow related to love!</title>
</head>
<body>
<?php
$status = $napalmauth->user_auth_status();
$username = $napalmauth->user_name();
?>
<h1>RedditGamJam05 game that is somehow related to love!</h1>

<?php
echo("<p>Hi $username!<p/>");
$napalmauth->show_logout();
?>

<?php
//maybe if user changes password, check if in correct place in future
switch($napalmauth->auth_status()){
    case 5:
        echo("Password changed!");
        break;
    case 6:
        echo("Password not changed! Check for incorrect passwords");
        break;
}
?>
</body>
</html>
