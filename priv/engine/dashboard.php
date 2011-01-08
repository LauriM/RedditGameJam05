<?php
echo("<h1>Hi $username!</h1>");
?>

<div id="livefeed"></div>

<div class="input">
    <form action="index.php?action=cmd&subaction=submit" method="POST">
        <input type="text" name="input"/>
        <input type="submit" value="Send"/>
    </form>
</div>
