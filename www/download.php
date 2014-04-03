<?php
session_start();
if(empty($_GET["id"])){
	header("Location: http://$_SERVER[HTTP_HOST]");
  exit;
}
$id_file = $_GET["id"];
include("config.php");
include("function.php");
connect_to_base();
$query="SELECT * FROM main WHERE new_name='$id_file'";
$file_data=mysql_fetch_assoc(mysql_query($query));
if(empty($file_data)){
  echo "no";
  exit;
}
// echo "<pre>";
// print_r($file_data);
// echo "</pre>";
// exit;
$old_name = str_replace(" ", "_", $file_data["old_name"]);
file_force_download($id_file, $old_name);
exit;
?>
