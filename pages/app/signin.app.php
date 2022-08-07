<?php
$password = $_POST['password'];
$email = $_POST['email'];

//validate password strength
$uppercase = preg_match('@[A-Z]@', $password);
$lowercase = preg_match('@[a-z]@', $password);
$number = preg_match('@[0-9]@', $password);
$specialChar = preg_match('@[^/w]@', $password);

if (!$uppercase || !$lowercase || !$number || !$specialChar ||  strlen($password) < 8 ) {
    echo  'Password must be atleast 8 charcters in length and should include atleast one uppercase letter , one number, and one special charcters '; 
}else {
  echo 'Strong Password' ;
}