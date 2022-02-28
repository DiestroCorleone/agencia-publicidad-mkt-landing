<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'Exception.php';
	require 'PHPMailer.php';
	require 'SMTP.php';

	if(empty($_POST["name"]) or empty($_POST["date"]) or empty($_POST["horario"]) or empty($_POST["message"])){
			echo "<script>alert('Error, probá otra vez!');window.location.replace('https://lonelycross.com.ar/index.html');</script>";
			//print_r(error_get_last());
			die();
	}

	$name = $_POST["name"];
	$tel = $_POST["tel"];
	$date = $_POST["date"];
	$horario = $_POST["horario"];
	$servicio = $_POST["servicio"];
	$message = $_POST["message"];

	$emailBody = "Nombre: ".$name." | Teléfono: ".$tel." | Fecha para contactar: ".$date." | Horario para contactar: ".$horario." | Servicio por el que consulta: ".$servicio." | Mensaje: ".$message;

	//----------------------------Empieza PHPMailer----------------------------------------------------
	$mail = new PHPMailer(true);
	try{
		$mail->setFrom('example@hotmail.com', $name.' | Lonely Cross Web Formulario de Contacto');
		$mail->addAddress('example@hotmail.com', 'Lonely Cross');
		$mail->Subject = "Contacto Lonely Cross";
		$mail->Body = $emailBody;
		$mail->isSMTP();
   		$mail->Host = //Here goes the server address (example 'smtp.gmail.com').
   		$mail->SMTPAuth = TRUE;
  		$mail->SMTPSecure = 'tls';
   		$mail->Username = 'YOUR E-MAIL';
   		$mail->Password = 'YOUR PASSWORD';
   		$mail->CharSet = 'UTF-8';
   		$mail->Port = 587;if($mail->send()){
			echo "<script>window.location.replace('https://lonelycross.com.ar/gracias.html');</script>";
			die();
		}else{
			echo "<script>alert('Error, probá otra vez!');window.location.replace('https://lonelycross.com.ar/index.html');</script>";
			//print_r(error_get_last());
			die();
		}
	}catch (Exception $e){
		echo $e->errorMessage();
	}catch (\Exception $e){
		echo $e->getMessage();
	}
	//----------------------------Termina PHPMailer----------------------------------------------------
?>