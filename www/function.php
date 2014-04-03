<?php
//функция соеденения с базой данных
function connect_to_base() {
global $dbhost, $dbuser, $dbpass, $dbbase;
mysql_connect($dbhost, $dbuser, $dbpass) OR DIE("Не удалось установить соединение с базой данных");
mysql_select_db($dbbase) OR DIE("Не найдена база $dbbase");
mysql_query("SET NAMES 'utf8'");
}

//функция скачиваня файла
function file_force_download($file, $old_name) {
  if (file_exists("files/$file")) {
    // сбрасываем буфер вывода PHP, чтобы избежать переполнения памяти выделенной под скрипт
    // если этого не сделать файл будет читаться в память полностью!
    if (ob_get_level()) {
      ob_end_clean();
    }
    // заставляем браузер показать окно сохранения файла
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.$old_name);
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize("files/$file"));
    // читаем файл и отправляем его пользователю
    readfile("files/$file");
    exit;
  }
}
?>
