<?php
$result = query("SELECT * FROM users WHERE username = '$username';"); 
$count  = mysql_num_rows($result);

$editor = $napalmdata->getdata("$username","editor");

if($count == 1){
    $user_x     = mysql_result($result,0,"posx");
    $user_y     = mysql_result($result,0,"posy");
    $user_world = mysql_result($result,0,"world");
}else{
    die("Userprofile duplicate id error! Contact admin");
}

$subaction = $_GET['subaction'];
if($subaction == "dc"){
    query("UPDATE users SET world = '' WHERE username = '$username'");
    query("INSERT INTO feed(target,owner,message,unixtime) VALUES('\{$user_world\}','system','$username left the game!','$time')");
    $user_world = "";
}

if($subaction == "join"){
    $time = time();

    $result = query("UPDATE users SET lasthit = '$time' WHERE username = '$username'");//update activity to fix join/pingout bug
    $name = secure($_GET['name']);

    $result = query("SELECT * FROM worlds WHERE name = '$name'");

    if(mysql_num_rows($result) == 1){
        query("UPDATE users SET world = '$name' WHERE username = '$username'");
        $user_world = $name;
        query("INSERT INTO feed(target,owner,message,unixtime) VALUES('\{$user_world\}','system','$username joined the game!','$time')");
    }else{
        echo("Invalid world!");
    }
}

if($user_world == ""){
    include("priv/serverbrowser.php");
    die();
}
?>


<div class="controls">
<table border="1">
    <tr>
        <td>
        </td>
        <td>
            <a id="moven">N</a>
        </td>
        <td>
        </td>
    </tr>
    <tr>
        <td>
            <a id="movew">w</a>
        </td>
        <td>
        </td>
        <td>
            <a id="movee">e</a>
        </td>
    </tr>
    <tr>
        <td>
        </td>
        <td>
            <a id="moves">s</a>
        </td>
        <td>
        </td>
    </tr>
</table>
</div>

<?php
if($editor == 1){
?>
<div class="editor">
    <p><a id="editorclipon">Clip on<a/></p>
    <p><a id="editorclipoff">Clip off<a/></p>
    <?php
        for($i = 0;$i < $tile_count;$i++){
            echo("<p a id='editortile$i'><img src='img/tile/tile$i.bmp'/></p>");
        }
    ?>
</div>
<?php
}
?>

<div id="worldview">
</div>
