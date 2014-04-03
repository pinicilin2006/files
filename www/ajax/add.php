<?php
session_start();
include("../config.php");
include("../function.php");
connect_to_base();
// echo "<pre>";
// print_r($_FILES);
// echo "</pre>";
// exit;
//phpinfo();
$uploaddir = "../files/";
$max_size = 5000 * 1024 * 1024;
$file_size = $_FILES['file']['size'];
$new_name_file = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 20);
$old_name_file = mysql_real_escape_string($_FILES["file"]["name"]);
$srok = $_POST["srok"];
//echo $old_name_file;
//echo $new_name_file;
//exit;
if($file_size > $max_size || $_FILES["file"]["error"] == 1){
	echo 'Ошибка: превышен максимальный размер архива (5000Mb).';
	exit;	
}
if (move_uploaded_file($_FILES["file"]["tmp_name"], $uploaddir . $_FILES["file"]["name"]) && rename($uploaddir . $_FILES["file"]["name"], $uploaddir . $new_name_file)) {
     if(mysql_query("INSERT INTO main (old_name,new_name,srok) VALUES ('$old_name_file','$new_name_file','$srok')")){
     	echo "<span class=\"text-info\"><h4>Файл успешно закачан.</h4></span><br> Скачать файл возможно по адресу:  <p class=\"text-error\"> http://$_SERVER[HTTP_HOST]/download.php?id=$new_name_file </p>";
        //echo "<form class=\"navbar-form\"><button type=\"submit\" id=\"send_email\" class=\"btn\">Отправить ссылку на электронный адрес:</button><input type=\"text\" name=\"email\" placeholder=\"Введите email\"></form>";
     if(!empty($_POST["send_email"])){
        $send_email = htmlspecialchars($_POST["send_email"]);
        $send_link = "Ссылка для скачивания файла http://$_SERVER[HTTP_HOST]/download.php?id=$new_name_file";
        $header = "From: \"$www_name\" <$email_from>\n";
        $header .= "Content-type: text/plain; charset=\"utf-8\"";
        //echo $send_link;
        if(mail($send_email, 'Ссылка на файл', $send_link, $header)){
            echo "<div class=\"alert alert-success\"> Ссылка на загруженный файл успешно отправленна на электронный адрес $send_email.</div>";
        } else {
            echo "<br>Произошла ошибка при попытке отправить ссылку на файл.";
        }
     }

     } else {
     	echo "Ошибка при закачки файла";
     	exit;
     }
    
} else {
    print "Произошла ошибка при добавление файла";
    exit;
}
?>
