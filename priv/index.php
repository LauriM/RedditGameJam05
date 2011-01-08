<html>
<head>
    <title>RedditGamJam05 game that is somehow related to love!</title>
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            dump = setInterval("updatefeed()",1000);
        });

        function updatefeed(){
            $('#livefeed').load('api/index.php?action=live');
            $('#worldview').load('api/index.php?action=worldview');
        }
    </script>
</head>
<body>
<?php
$status = $napalmauth->user_auth_status();
$username = $napalmauth->user_name();
?>
<h1>RedditGamJam05 game that is somehow related to love!</h1>

<?php
echo("<p>Hi $username!<p/>");
echo("<p><a href='index.php'>Dashboard</a> <a href='index.php?action=world'>World</a></p>");
$napalmauth->show_logout();
?>
<hr/>

<?php

//ENGINE, THE SHIT HAPPENS HERE
include("priv/engine.php");

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
