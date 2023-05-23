<?php   
//Require connection to the database
require 'db.php';
$submit=1;

if($_SERVER['REQUEST_METHOD']=='POST'){




//Get the message submited Sanitize and validated it
$messages = htmlspecialchars(trim($_POST['mess']));
$names = htmlspecialchars($_POST['name']);
$subjects = htmlspecialchars($_POST['subject']);
$email =htmlspecialchars(trim(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)));


  $sql="INSERT INTO messages (`message`,`name`, `email`, `subject`) values('$messages', '$names', '$email', '$subjects')";
  $check=$conn->query($sql);
  if($check==TRUE){
    
    echo "<script type='text/javascript'>alert('We have recorded your message, we will get in touch with you via your email, thank you.');
    window.location='index.php';
    </script>";
      
  }
  else{
      echo 'error occured '.$conn->error;
  
}
 
}

?>