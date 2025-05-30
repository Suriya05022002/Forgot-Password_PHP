<html>  
<head>  
    <title>Forgot Password</title>  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
</head>
<style>
 .box
 {
  width:100%;
  max-width:600px;
  background-color:#f9f9f9;
  border:1px solid #ccc;
  border-radius:5px;
  padding:16px;
  margin:0 auto;
 }
 input.parsley-success,
 select.parsley-success,
 textarea.parsley-success {
   color: #468847;
   background-color: #DFF0D8;
   border: 1px solid #D6E9C6;
 }

 input.parsley-error,
 select.parsley-error,
 textarea.parsley-error {
   color: #B94A48;
   background-color: #F2DEDE;
   border: 1px solid #EED3D7;
 }

 .parsley-errors-list {
   margin: 2px 0 3px;
   padding: 0;
   list-style-type: none;
   font-size: 0.9em;
   line-height: 0.9em;
   opacity: 0;

   transition: all .3s ease-in;
   -o-transition: all .3s ease-in;
   -moz-transition: all .3s ease-in;
   -webkit-transition: all .3s ease-in;
 }

 .parsley-errors-list.filled {
   opacity: 1;
 }
 
 .parsley-type, .parsley-required, .parsley-equalto{
  color:#ff0000;
 }
.error
{
  color: red;
  font-weight: 700;
} 
</style>
<?php
include_once('dbConnection.php');
if(isset($_REQUEST['pwdrst']))
{
  $email = $_REQUEST['email'];
  $check_email = mysqli_query($connection,"select email from tbl_student where email='$email'");
  $res = mysqli_num_rows($check_email);
  if($res>0)
  {
    // $message = '<div>
    //  <p><b>Hello!</b></p>
    //  <p>You are recieving this email because we recieved a password reset request for your account.</p>
    //  <br>
    //  <p><button class="btn btn-primary"><a href="passwordreset.php?secret='.base64_encode($email).'">Reset Password</a></button></p>
    //  <br>
    //  <p>If you did not request a password reset, no further action is required.</p>
    // </div>';
   


    $current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $directory = dirname($_SERVER['PHP_SELF']);
    $directory = ($directory == '/' ? '' : $directory);
    $reset_url = $current_url . $directory . "/passwordreset.php?secret=" . base64_encode($email);
    
    $message = "<div style='max-width: 500px; margin: auto; padding: 20px; font-family: Arial, sans-serif; border: 1px solid #ddd; border-radius: 10px; text-align: center; background-image: url(img/mail-sender-bg.jpg); background-position: center; background-size: cover; background-repeat: no-repeat;'>
    <h2 style='margin: 0; color: red;'>Gowthamraj Network</h2>
    <p>You are receiving this email because we received a password reset request for your account.</p>
    <br>
    <p><a href='" . $reset_url . "' style='display: inline-block; padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 5px;'>Reset Password</a></p>
    <br>
    <p style='font-size: 14px; color: #777;'>Thanks for helping us keep your account secure.</p>
    <p style='font-size: 14px; color: #555;'><strong>The Gowthamraj Network Team</strong></p>
    </div>";





include_once("SMTP/class.phpmailer.php");
include_once("SMTP/class.smtp.php");
$email = $email; 
$mail = new PHPMailer;
$mail->IsSMTP();
$mail->SMTPAuth = true;                 
$mail->SMTPSecure = "tls";      
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587; 
$mail->Username = "suryagrnetwork@gmail.com";
$mail->Password = "mgjy bxle zugf wfbd";
$mail->FromName = "Support Team";
$mail->AddAddress($email);
$mail->Subject = "Reset Password";
$mail->isHTML( TRUE );
$mail->Body =$message;
if($mail->send())
{
  $msg = "We have e-mailed your password reset link!";
}
}
else
{
  $msg = "We can't find a user with that email address";
}
}

?>
<body>
<div class="container">  
    <div class="table-responsive">  
    <h3 align="center">Forgot Password</h3><br/>
    <div class="box">
     <form id="validate_form" method="post" >  
       <div class="form-group">
       <label for="email">Email Address</label>
       <input type="text" name="email" id="email" placeholder="Enter Email" required 
       data-parsley-type="email" data-parsley-trigg
       er="keyup" class="form-control" />
      </div>
      <div class="form-group">
       <input type="submit" id="login" name="pwdrst" value="Send Password Reset Link" class="btn btn-success" />
       </div>
       
       <p class="error"><?php if(!empty($msg)){ echo $msg; } ?></p>
     </form>
     </div>
   </div>  
  </div>
</body>
</html>
