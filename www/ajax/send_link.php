<?php
// несколько получателей
$to  = 'pinicilin2006@ya.ru'; // обратите внимание на запятую

// тема письма
$subject = 'Ссылка на скачивание файла';

// текст письма
$message = '
<html>
<head>
  <title>Ссылка для скачивания файла</title>
</head>
<body>
<a href="http://files.sngi.ru/download.php?id=XUNmJqRsE4CaByoPT7F2">http://files.sngi.ru/download.php?id=XUNmJqRsE4CaBderdfgdfgyoPT7F2</a>
</body>
</html>
';

// Для отправки HTML-письма должен быть установлен заголовок Content-type
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Дополнительные заголовки
$headers .= 'To: pinicilin2006@ya.ru' . "\r\n";
$headers .= 'From: <files@files.sngi.ru>' . "\r\n";
// Отправляем
mail($to, $subject, $message, $headers);
?>