<?php

echo "<h2>Starting AI Camera...</h2>";

exec("start cmd /c python C:/xampp/htdocs/mineguard/ai/live_detection.py");

echo "<p>Camera should open in a new window.</p>";

?>