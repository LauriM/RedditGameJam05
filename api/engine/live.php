<?php
$result = query("SELECT * FROM feed");
$count  = mysql_num_rows($result);

for($i = 0;$i < $count;$i++){
    $owner   = mysql_result($result,$i,"owner");
    $message = mysql_result($result,$i,"message");
    echo("<p><b>$owner</b>: $message</p>");
}
?>
