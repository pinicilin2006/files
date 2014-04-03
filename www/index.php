<?php
session_start();
// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";
include("config.php");
$name_progress = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
?>
<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $resource_name?></title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-responsive.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" type="text/css" href="css/ui-lightness/jquery-ui.css">
    <script src="js/jquery.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/bootstrap-filestyle.js"> </script>
  </head>
<body>

<div class="navbar">
  	<div class="navbar-inner">
		<a class="brand"><div class="text-error"><?php echo $resource_name?></div><smallsmall><em><?php echo $company_name?></em></smallsmall></a>
    	<ul class="nav">
      		<li><a ></a></li>
    	</ul>
  	</div>
</div>

<div class="container-fluid">
	<div class="row-fluid">
		<div class="pagination pagination-centered">
		<form id="form" enctype="multipart/form-data">
		    <input type="hidden" id="progress" name="<?=ini_get("session.upload_progress.name")?>" value="<?=$name_progress?>" />
			<input type="file" id="file" name="file" class="filestyle" data-input="false" data-buttonText="Выберите файл для закачки">
			<div class="input-prepend">
				<span class="add-on">Срок хранения файла (дней):</span><select id="srok" name="srok" class="input-mini">
				<?
				for($i=1;$i<15;$i++){
					echo "<option value=$i>$i</option>";
				}
				?>
				</select>
			</div>
			<br>
			<div class="input-prepend">
			<span class="add-on">Отправить ссылку на email (не обязательно):</span><input type="text" name="send_email" placeholder="Введите email">
			</div>
			<button type="btn submit" id="btn_submit" class="btn btn-success" style="display:none">Закачать</button>
		</form>
		<div id="message"></div>
		<div id="message_procent"></div>
		</div>
	</div>
</div>
</body>
<script type="text/javascript">

//mapping the start button when selecting Upload file
	$("#file").change(function(){
		if($("#file").val()!=''){
			$("#btn_submit").show(400);
		} else {
			$("#btn_submit").hide(400);
		}
	});

//load_percentage
	function progress_procent(){
			$.ajax({
			  type: "POST",
			  url: 'ajax/progress.php',
			  data: "id="+$("#progress").val(),
			  success: function(data) {
			    $('#message_procent').html(data);
			  }
			});
	}

//file upload
	    $('#form').submit(function(e) {
	    	$("#btn_submit").prop("disabled","disabled");//disabled button upload
	    	$('#message').html('Ожидайте. Производится загрузка файла.. <br> <img src=\"/img/download.gif\">');	        
	        var intervalID = setInterval(progress_procent, 1000);
	        e.preventDefault();
	        data = new FormData($('#form')[0]);	        
	        $.ajax({
	            type: 'POST',
	            url: 'ajax/add.php',
	            data: data,
	            cache: false,
	            contentType: false,
	            processData: false
	        }).done(function(data) {
	        	$("#btn_submit").prop("disabled","");//enabled button upload
	        	$('#form')[0].reset();
	        	$("#btn_submit").hide();
	        	$('#message').html(data);
                clearInterval(intervalID);
    		    $('#message_procent').html('');
	        });
	    });

$(document).ready(function(){
	$(":file").filestyle({input: true,
				buttonText: "Выберите файл для закачки",
				classButton: "btn btn-primary"
	});
});

</script>