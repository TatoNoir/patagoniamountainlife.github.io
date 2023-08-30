<?php

if(isset($_POST['email'])) {
 
    // 
 
    $email_to = "info@patagoniamountainlife.com";
 
    $email_subject = "Contacto desde Web";
 
    // Se valida que los campos del formulairo estén llenos
 
    if(!isset($_POST['nombre']) ||

        !isset($_POST['email']) ||
 
        !isset($_POST['fecha']) ||
 
        !isset($_POST['cant']) ||
 
        !isset($_POST['message'])) {
 
        echo('Lo sentimos pero parece haber un problema con los datos enviados. Por favor regrese y vuelva a intentarlo');
        die;
 
    }
 //En esta parte el valor "name"  sirve para crear las variables que recolectaran la información de cada campo
 
    $name_from = $_POST['nombre']; // requerido
  
    $email_from = $_POST['email']; // requerido

    $date_from = $_POST['fecha']; // requerido
 
    $cant = $_POST['cant']; // no requerido 
 
    $message = $_POST['message']; // requerido
 
    $error_message = "";//Linea numero 52;
 
//En esta parte se verifica que la dirección de correo sea válida 
 
   $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
 
    $error_message .= 'La dirección de correo proporcionada no es válida. Por favor regrese y vuelva a intentarlo<br />';
 
  }
 
//En esta parte se validan las cadenas de texto
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$name_from)) {
 
    $error_message .= 'El formato del nombre no es válido. Por favor regrese y vuelva a intentarlo<br />';
 
  }
 
 
  if(strlen($error_message) > 0) {

    echo($error_message);
    die;

  }
 
//Este es el cuerpo del mensaje tal y como llegará al correo
 
    $email_message = "<html>
                      <head>
                        <h2>Contenido del mensaje</h2>
                      </head>
                      <body>";

    $email_message .= "<b>Fecha:</b> ".date('d-m-Y H:i')."<br>";

    $email_message .= "<b>Nombre:</b> ".$name_from."<br>";
 
    $email_message .= "<b>Email:</b> ".$email_from."<br>";

    $email_message .= "<b>Fecha de estadia:</b> ".$date_from."<br>";
 
    $email_message .= "<b>Cantidad de participantes:</b>".$cant."<br>";
 
    $email_message .= "<b>Actividades:</b><ul>"."<br>";

    if (isset($_POST['check_list']))
      foreach ($_POST['check_list'] as $checkbox) {
        $email_message .="<li>".$checkbox."</li>";
      }
    $email_message .= "</ul>";

    if (isset($_POST['travel']))
      $email_message .= "<i>La persona desea recibir asesoramiento.</i><br>";
    else
      $email_message .= "<i>La persona NO desea recibir asesoramiento.</i><br>";

    $email_message .= "<b>Mensaje:</b> ".$message;

    $email_message .= "</body>
                      </html>";

//Se crean los encabezados del correo
 
$headers =  'From: '.$email_from."\r\n".
            'Reply-To: '.$email_from."\r\n" .
            'MIME-Version: 1.0' . "\r\n".
            'Content-type: text/html; charset=utf-8' . "\r\n";
 
$envio=@mail($email_to, $email_subject, $email_message, $headers);

if($envio)
  $miresultado = '<h4>El correo ha sido enviado! Gracias por ponerse en contacto con nosotros.</h4>';
else
  $miresultado = '<h4>No se envío el correo.</h4>';

echo $miresultado;
 
 
}
 
?>