<?php 
// EDIT THE 2 LINES BELOW AS REQUIRED
$send_email_to = "info@diftinto.com";
$email_subject = "Mensaje desde Formulario";
function send_email($name,$email,$telefono,$message)
{
  global $send_email_to;
  global $email_subject;
  $headers = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
  $headers .= "From: ".$email. "\r\n";
  $message = "<strong>Email = </strong>".$email."<br>";
  $message .= "<strong>Name = </strong>".$name."<br>"; 
  $message .= "<strong>Telefono = </strong>".$telefono."<br>"; 
  $message .= "<strong>Message = </strong>".$message."<br>";
  @mail($send_email_to, $email_subject, $message,$headers);
  return true;
}

function validate($name,$email,telefono,$message)
{
  $return_array = array();
  $return_array['success'] = '1';
  $return_array['name'] = '';
  $return_array['email'] = '';
  $return_array['telefono'] = '';
  $return_array['message'] = '';
  if($email == '')
  {
    $return_array['success'] = '0';
    $return_array['email'] = 'email is required';
  }
  else
  {
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
    if(!preg_match($email_exp,$email)) {
      $return_array['success'] = '0';
      $return_array['email'] = 'enter valid email.';  
    }
  }
  if($name == '')
  {
    $return_array['success'] = '0';
    $return_array['name'] = 'name is required';
  }
  else
  {
    $string_exp = "/^[A-Za-z .'-]+$/";
    if (!preg_match($string_exp, $name)) {
      $return_array['success'] = '0';
      $return_array['name'] = 'enter valid name.';
    }
  }
		
  if($message == '')
  {
    $return_array['success'] = '0';
    $return_array['message'] = 'message is required';
  }
  else
  {
    if (strlen($message) < 2) {
      $return_array['success'] = '0';
      $return_array['message'] = 'enter valid message.';
    }
  }
  return $return_array;
}

$name = $_POST['name'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$message = $_POST['message'];


$return_array = validate($name,$email,$telefono,$message);

if($return_array['success'] == '1')
{
  send_email($name,$email,$telefono,$message); 
}
// <script languaje='javascript' type='text/javascript'>

// document.querySelector(.nombre).innerHTML = "";
// document.querySelector(.email).innerHTML = "";
// document.querySelector(.telefono).innerHTML = "";
// document.querySelector(.comentario).innerHTML = "";

// document.querySelector(.confirmacion).style.display = 'block';
// </script>
header('Content-type: text/json');
echo json_encode($return_array);
die();
?>
