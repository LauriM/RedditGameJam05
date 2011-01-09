<html>
<head>
    <title>Rush for the hearts!</title>
    <link rel="stylesheet" href="style.css" />
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            dump = setInterval("updatefeed()",3000);

            $('#movew').click(function(){
                $.get('api/index.php?action=move', {dir: "w"} )
                $('#worldview').load('api/index.php?action=worldview');
            });

            $('#moves').click(function(){
                $.get('api/index.php?action=move', {dir: "s"} )
                $('#worldview').load('api/index.php?action=worldview');
            });
            $('#movee').click(function(){
                $.get('api/index.php?action=move', {dir: "e"} )
                $('#worldview').load('api/index.php?action=worldview');
            });
            $('#moven').click(function(){
                $.get('api/index.php?action=move', {dir: "n"} )
                $('#worldview').load('api/index.php?action=worldview');
            });


            $('#editorclipon').click(function(){
                $.get('api/index.php?action=editor', {cmd: "clipon"} )
            });

            $('#editorclipoff').click(function(){
                $.get('api/index.php?action=editor', {cmd: "clipoff"} )
            });

            <?php
                $tile_count = 3;
                for($i = 0;$i < $tile_count;$i++){
                    echo("$('#editortile$i').click(function(){");
                        echo("$.get('api/index.php?action=editor', {cmd: 'tile', id: '$i'} )");
                    echo("});");
                }
            ?>
        });

        function updatefeed(){
            $('#livefeed').load('api/index.php?action=live');
            $('#worldview').load('api/index.php?action=worldview');
        }
    </script>
</head>
<body>
<div class="container">
<?php
$status = $napalmauth->user_auth_status();
$username = $napalmauth->user_name();
?>
<p>Rush for the hearts!</p>

<?php
echo("<p>Hi $username!<p/>");
echo("<p><a href='index.php'>HEEELP!</a> <a href='index.php?action=world'>Play now!</a></p>");
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
</div><!-- container -->
</body>
</html>
