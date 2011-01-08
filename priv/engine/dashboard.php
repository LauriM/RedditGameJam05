<?php
echo("<h1>Hi $username!</h1>");
?>

<div id="livefeed"></div>

<div class="input">
    <form id="input" action="index.php?action=msg" method="POST">
        <input id="inputdata" type="text" name="message"/>
        <input type="submit" value="Send"/>
    </form>
</div>
