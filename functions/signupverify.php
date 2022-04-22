<?php

include "../functions/connection.php";
$success=null;

if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['address']) && isset($_POST['phoneno']) && isset($_POST['username']) && isset($_POST['password']) && 
! empty($_POST['firstname']) && ! empty($_POST['lastname']) && ! empty($_POST['address']) && ! empty($_POST['phoneno']) && ! empty($_POST['username']) && ! empty($_POST['password']))
{
    

      $username = $_POST['username'];     
      $sql = "Select * from users where username='$username'";
    
      $result = mysqli_query($conn, $sql);
      
      $num = mysqli_num_rows($result);

      if($num ==0)
      {
      $password = $_POST['password'];
      if(strlen($password) <= 6)
      {
        header("Location: ../Signup.php?error=Password must have greater than 6 character");
      }
      else
      {
        // Hashing the password
        $firstname=$_POST['firstname'];
        $lastname=$_POST['lastname'];
        $address=$_POST['address'];
        $phoneno=$_POST['phoneno'];
        $password = md5($_POST['password']);
        $todaydate=date("Y-m-d H:i:s");
        $sql = "Insert into users(FirstName, LastName, Address, PhoneNumber, UserName, Password, UserType, CreatedDate, Flag) values('$firstname', '$lastname','$address','$phoneno','$username','$password','U', ' $todaydate','N')";
    
            $result = mysqli_query($conn, $sql);
    
            if ($result) {
              $success=true;
              header("Location: ../Signup.php?success=true");              
            }
            else{
              $success=false;
              header("Location: ../Signup.php?success=true");
            }


      }
      }
      else
      {
        
        header("Location: ../Signup.php?error=Username already exists");
      }
}
else
{
    header("Location: ../Signup.php?error=Please fill out all fields");
}
?>