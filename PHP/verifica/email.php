<?php
set_time_limit(0);


// Inclui o arquivo de configuração
include('config.php');


$result = 0.1;
$resultsta = 'OK';
$Vai = 'KK';

while ($result < 37.5 AND $resultsta != "QUEDA"){
sleep(2);
$pdo_verificadata = $conexao_pdo->prepare('select data_sensor from temperatura where data_sensor = (select max(data_sensor) from temperatura)'); 
$pdo_verificadata->execute(); 						
$resultdata = $pdo_verificadata->fetch()['data_sensor'];

$pdo_verificadata = $conexao_pdo->prepare('select localiza from temperatura where data_sensor = (select max(data_sensor) from temperatura)'); 
$pdo_verificadata->execute(); 						
$resultloca = $pdo_verificadata->fetch()['localiza'];

$pdo_verificadata = $conexao_pdo->prepare('select state from temperatura where data_sensor = (select max(data_sensor) from temperatura)'); 
$pdo_verificadata->execute(); 						
$resultsta = $pdo_verificadata->fetch()['state'];

$pdo_verifica = $conexao_pdo->prepare('select temperatura from temperatura where data_sensor = (select max(data_sensor) from temperatura)'); 
$pdo_verifica->execute(); 		
$result = (($pdo_verifica->fetch()['temperatura'])/10);
}


require_once("phpmailer/class.phpmailer.php");

define('GUSER', 'testeuff2018@gmail.com');	// <-- Insira aqui o seu GMail
define('GPWD', 'enviodeemail');		// <-- Insira aqui a senha do seu GMail

function smtpmailer($para, $de, $de_nome, $assunto, $corpo) { 
	global $error;
	$mail = new PHPMailer();
	$mail->IsSMTP();		// Ativar SMTP
	$mail->SMTPDebug = 0;		// Debugar: 1 = erros e mensagens, 2 = mensagens apenas
	$mail->SMTPAuth = true;		// Autenticação ativada
	$mail->SMTPSecure = 'tls';	// SSL REQUERIDO pelo GMail //TLS REQUERIDO PELO GMAIL 2018
	$mail->Host = 'smtp.gmail.com';	// SMTP utilizado
	$mail->Port = 587;  		// A porta 587 deverá estar aberta em seu servidor
	$mail->Username = GUSER;
	$mail->Password = GPWD;
	$mail->SetFrom($de, $de_nome);
	$mail->Subject = $assunto;
	$mail->Body = $corpo;
	$mail->AddAddress($para);
	if(!$mail->Send()) {
		$error = 'Mail error: '.$mail->ErrorInfo; 
		return false;
	} else {
		$error = 'Mensagem enviada!';
		return true;
	}
}


if ($result > 37.4 and $resultsta == 'QUEDA'){
	
// Variável que junta os valores acima e monta o corpo do email
$Vai 		= "\nO paciente sofreu uma $resultsta  e se encontra com temperatura ALTA: $result\n\nLocalidade: $resultloca\n\n$resultdata\n";
	
// Insira abaixo o email que irá receber a mensagem, o email que irá enviar (o mesmo da variável GUSER), o nome do email que envia a mensagem, o Assunto da mensagem e por último a variável com o corpo do email.
//augustocezar@id.uff.br //mvrocha85@gmail.com
 if (smtpmailer('mvrocha85@gmail.com', 'testeuff2018@gmail.com', 'Centro de Saude', 'Alerta', $Vai)) {
	Header("location:http://localhost/verifica/email.php"); // Redireciona para a pagina de volta.
}
}


if ($result > 37.4 AND $resultsta != "QUEDA") {
	
// Variável que junta os valores acima e monta o corpo do email
$Vai 		= "\nO paciente se encontra com temperatura ALTA: $result\n\nLocalidade: $resultloca\n\nStatus: $resultsta  \n\n$resultdata\n";
	
// Insira abaixo o email que irá receber a mensagem, o email que irá enviar (o mesmo da variável GUSER), o nome do email que envia a mensagem, o Assunto da mensagem e por último a variável com o corpo do email.
//augustocezar@id.uff.br //mvrocha85@gmail.com
 if (smtpmailer('mvrocha85@gmail.com', 'testeuff2018@gmail.com', 'Centro de Saude', 'Alerta', $Vai)) {
	Header("location:http://localhost/verifica/email.php"); // Redireciona para a pagina de volta.
}
}


if ($resultsta == 'QUEDA' AND $result < 37.4){
	
// Variável que junta os valores acima e monta o corpo do email
$Vai 		= "\nO paciente sofreu uma $resultsta \n\nLocalidade: $resultloca\n\n Temperatura: $result \n\n$resultdata\n";
	
// Insira abaixo o email que irá receber a mensagem, o email que irá enviar (o mesmo da variável GUSER), o nome do email que envia a mensagem, o Assunto da mensagem e por último a variável com o corpo do email.
//augustocezar@id.uff.br //mvrocha85@gmail.com 
 if (smtpmailer('mvrocha85@gmail.com', 'testeuff2018@gmail.com', 'Centro de Saude', 'Alerta', $Vai)) {
	Header("location:http://localhost/verifica/email.php"); // Redireciona para a pagina de volta.
}
}


if (!empty($error)) echo $error;
?>