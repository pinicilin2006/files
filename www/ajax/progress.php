<?php
session_start();
//print_r($_SESSION);
$name_progress = $_POST["id"];
if (isset($_SESSION["upload_progress_$name_progress"])) {
    $progress = $_SESSION["upload_progress_$name_progress"];
    $percent = round(100 * $progress['bytes_processed'] / $progress['content_length']);
    echo "Процент загрузки: $percent%<br />";
} else {
    //echo 'no uploading';
}
?>
