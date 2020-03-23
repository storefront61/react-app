
<?php

session_start();
// connect to the database
include('connection.php');
// <!-- check user inputs -->
//    <!-- define error message -->
$missingUsername   = '<p><strong>Please enter a username!</strong></p>';
$missingEmail      = '<p><strong>Please enter your email!</strong></p>';
$invalidEmail      = '<p><strong>Please enter a valid email!</strong></p>';
$missingPassword   = '<p><strong>Please enter a password!</strong></p>';
$invalidPassword   = '<p><strong>Your password should be at least 6 characters long and include one capital letter and one number!</strong></p>';
$differentPassword = '<p><strong>Passwords don\'t match!</strong></p>';
$missingPassword2  = '<p><strong>Please confirm your password!</strong></p>';
//    <!-- get username, email, password, password2 -->
//get username
if(empty($_POST["username"])){
  $errors .= $missingUsername;
}else{
  $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
}
//get email
if(empty($_POST["email"])){
  $errors .= $missingEmail;
  console.log($missingEmail);
}else{
  $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
          $errors .= $invalidEmail;
        }
}
//get password
if(empty($_POST["password"])){
  $errors .= $missingPassword;
  console.log($missingEmail);
}else if(!(strlen($_POST["password"]) > 6 
     and preg_match('/[A-Z]/',$_POST["password"]) 
     and preg_match('/[0-9]/',$_POST["password"]))){
  $errors .= $invalidPassword;
}else{
  $password = filter_var($_POST["password"],FILTER_SANITIZE_STRING);
      if(empty($_POST["password2"])){
        $errors .= $missingPassword2;
      }else{
        $password2 = filter_var($_POST["password2"], FILTER_SANITIZE_STRING);
                if($password !== $password2){
                  $errors .= $differentPassword;
                }
      }
}
//if any errors print error
if($errors){
  $resultMessage = '<div class="alert alert-danger">' . $errors . '</div>';
  echo $resultMessage;
}
//store errors in errors variable
//    <!-- if there are any errors print error -->

// no errors 
//      <!-- Prepare variables for the quaries -->
$username = mysqli_real_escape_string($link, $username);
$email = mysqli_real_escape_string($link, $email);
$password = mysqli_real_escape_string($link, $password);
//$password = md5($password);
//md5() 128bits -> 32 characters
$password = hash('sha256', $password);
//hash('sha256', $password) -> 256bits -> 64 characters

//      <!-- if username exists in the user table print error -->
$sql = "SELECT * FROM userinfo WHERE username = '$username'";
$result = mysqli_query($link, $sql);

if(!$result){
   echo '<div class="alert alert-danger">Error running the query for username!</div>';
  // echo '<div class="alert alert-danger">' . mysqli_error($link) . '</div>';
  exit;
}
$results = mysqli_num_rows($result);
if($results){
  echo '<div class="alert alert-danger">That username is already registered. To login click cancel and click Login</div>';
  exit;
}
//if email exists in the users table print error 
$sql = "SELECT * FROM userinfo WHERE email = '$email'";
$result = mysqli_query($link, $sql);
if(!$result){
   echo '<div class="alert alert-danger">Error running the query for email !</div>'; 
  // echo '<div class="alert alert-danger">' . mysqli_error($link) . '</div>';
  exit;
}
$results = mysqli_num_rows($result);
if($results){
  echo '<div class="alert alert-danger">That email is already registered. Do you want to log in?</div>';  
  exit;
}
//create a unique activation code
$activationKey = bin2hex(openssl_random_pseudo_bytes(16));
//byte: unit of data = 8 bits;
//bit: 0 or 1
//16 bytes = 16*8 = 128 bits

//insert user details and activation code in the users table
$sql = "INSERT INTO userinfo (username, email, password, activation) VALUES ('$username', '$email', '$password', '$activationKey')";
$result = mysqli_query($link, $sql);
if(!$result){
  echo '<div class="alert alert-danger">There was an error inserting the users details in the database!</div>'; 
  echo '<div class="alert alert-danger">' . mysqli_error($link) . '</div>';
    exit;
}

//send the user an email with a link to activate.php with their email and activatiion code
$message = "Please click on this link to activate your account:\n\n";
// $message .= "http://myDomain.com/activate.php?email=" . urlencoded($email) . "&key=activationKey";
$message .= "http://stevenagreene.offyoucode.co.uk/notesApp/activation.php?email=" . urlencode($email) . "&key=$activationKey";
if(mail($email, 'Confirm your Registration', $message, 'From:' . 'steven654765@gmail.com')){
  echo "<div class='alert alert-success'>Thank you for registering! A confirmation email has been sent to $email. Please click on the activation link to activate your account.</div>"; 
    
}
?>               