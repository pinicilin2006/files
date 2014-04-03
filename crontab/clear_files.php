ls <?php
include("../config.php");
include("../function.php");
connect_to_base();
$date_now=date("Y-m-d");
$query=mysql_query("SELECT * FROM main");
while($row = mysql_fetch_array($query)){
	// echo "Дата добавление ".$row["date_insert"];
	// echo "<br>";
	// echo "Срок хранения".$row["srok"];
	// echo "<br>";
	// echo (strtotime($date_now) - strtotime($row["date_insert"])) / 86400;
	// echo "<br>";
$srok_now = (strtotime($date_now) - strtotime($row["date_insert"])) / 86400;
	if($srok_now > $row["srok"]){
		if(file_exists("../files/$row[new_name]")){
			if(unlink("../files/$row[new_name]") && mysql_query("DELETE FROM `main` where `new_name`='$row[new_name]'")){
			//echo "Файл $row[new_name] успешно удалён";
			}
		}else{
			if(mysql_query("DELETE FROM `main` where `new_name`='$row[new_name]'")){
			//echo "Файл $row[new_name] успешно удалён";
			}
		}	
	}
}
?>