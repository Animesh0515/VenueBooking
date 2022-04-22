
<?php
include "controls/connection.php";
include "controls/functions.php";
if(isset($_POST['remove']) && ! empty($_POST['remove']))
{
  $id=$_POST['remove'];
  $result = mysqli_query($conn, "update users set ImageUrl=null where userid='$id'");
  if($result)
  {
    header("Location: Profile.php?success=Image removed successfully.");
  }
  else
  {
    header("Location: Profile.php?error=Error while removing image.");

  }

}

if(isset($_POST['upload']))
{
  $id=$_POST['upload'];
  if(isset($_FILES['files']) && ! empty($_FILES['files']))
  {
    $fileNames = array_filter($_FILES['files']['name']);
    if(empty($fileNames)){ 
      header("Location: Profile.php?error=Select some image file first.");
    }
    else
    {
      $uploaded=uploadImage($_FILES['files'],"", $conn, "assets/images/Profile/", $_POST['upload']);
        if($uploaded=="true")
      {
        header("Location: Profile.php?success=Image uploaded succesfully.");
      }
      else
      {
        header("Location: Profile.php?error=something went wrong!");
      }
    }
  
  }
  else
  {
    header("Location: Profile.php?error=Select some image file first.");
  }

}

if(isset($_POST['save']))
{

  if(! empty($_POST['save'] && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['address']) && isset($_POST['phoneno']) && isset($_POST['username']) && ! empty($_POST['firstname']) && ! empty($_POST['lastname']) && ! empty($_POST['address']) && ! empty($_POST['phoneno']) && ! empty($_POST['username'])))
  {
   $userid=$_POST["save"];
   $firstname=$_POST['firstname'];
   $lastname=$_POST['lastname'];
   $address=$_POST['address'];
   $phoneno=$_POST['phoneno'];
   $username=$_POST['username'];
   if(! empty($_POST['password']))
   {
    $password = $_POST['password'];
    if(strlen($password) <= 6)
    {
      header("Location: ../Signup.php?error=Password must have greater than 6 character");
    }
    else{
      $password = md5($_POST['password']);
     $sql="update users set Firstname='$firstname', Lastname='$lastname', Address='$address', PhoneNumber='$phoneno', Username='$username',Password='$password' where userid='$userid'";
    }
    }
    else
    {
      $sql="update users set Firstname='$firstname', Lastname='$lastname', Address='$address', PhoneNumber='$phoneno', Username='$username' where userid='$userid'";
    }
  $result = mysqli_query($conn, $sql);
  if($result)
  {
    header("Location: Profile.php?success=Updated Successfully.");
  }
  else
  {
    header("Location: Profile.php?error=Error while updating.");
  }
}
else
{
  header("Location: Profile.php?error=Field Empty!");
}
}

session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
    
        <link href="bootstrap\css\bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/style.css">
        <style>
           @media (max-width: 991.98px){
      .row {
          padding-left: 0rem !important;
          width: 100% !important;
          justify-content: space-evenly !important;
          margin-left:0rem !important
            }
          }
        </style>      
        <script>
          function closeMessage()
          {
            document.getElementById("message").style.display="none";

          }
          function edit()
          {
            debugger;
            document.getElementById("firstname").disabled = false;
            document.getElementById("lastname").disabled = false;
            document.getElementById("address").disabled = false;
            document.getElementById("phoneno").disabled = false;
            document.getElementById("username").disabled = false;
            document.getElementById("password").disabled = false;           
            document.getElementById("btnedit").hidden = true;
            document.getElementById("btnsave").hidden = false;
            document.getElementById("btncancel").hidden = false;
           
            
            
          }

          function cancel()
          {
            document.getElementById("firstname").disabled = true;
            document.getElementById("lastname").disabled = true;
            document.getElementById("address").disabled = true;
            document.getElementById("phoneno").disabled = true;
            document.getElementById("username").disabled = true;
            document.getElementById("password").disabled = true;           
            document.getElementById("btnedit").hidden = false;
            document.getElementById("btnsave").hidden = true;
            document.getElementById("btncancel").hidden = true;
          }
        </script>  
</head>
<body>
</body>
<?php include 'navbar.php';
$userid=$_SESSION['id'];
$style="";
$sql="select * from users where userid='$userid'";
$user=$conn->query($sql);
if($user)
{
  $user=mysqli_fetch_all($user);
}

?> 
<div style="padding-top: 4.6rem;">
<?php if(isset($_GET['success']) && $_GET['success']){
  $response=$_GET['success'];
  if($_GET['success']=='true'){?>
  
	<div class="response" id="message">
<div class="alert alert-success" ><strong> Updated Successfull!</strong><img src="assets/icons/cancel.svg" alt="" style="height: 1rem;float: right;" onclick="closeMessage()"> </div>
</div>
<?php echo'<script type="text/javascript">',
		'setTimeout(function () {',
   'document.getElementById("response").hidden = true;', 
	'},5000);',
	'</script>'; ?>
<?php }
else
{?>
<div class="response" id="message">
<div class="alert alert-success" ><strong> <?=$_GET['success']?></strong><img src="assets/icons/cancel.svg" alt="" style="height: 1rem;float: right;" onclick="closeMessage()"> </div>
</div>
<?php echo'<script type="text/javascript">',
		'setTimeout(function () {',
   'document.getElementById("response").hidden = true;', 
	'},5000);',
	'</script>'; ?>
<?php }
}
elseif(isset($_GET['error']) && $_GET['error']){
  ?>
  <div class="response" id="message">
  <div class="alert alert-danger" ><strong><?=$_GET['error']?></strong><img src="assets/icons/cancel.svg" alt="" style="height: 1rem;float: right;" onclick="closeMessage()"> </div>
  </div>
<?php }?>
<div class="row" style="width:100%; margin-left: 10rem ;margin-top: 2rem;">
<form action="" method="post" enctype="multipart/form-data">
<div class="card text-center" style="width: 30rem; height:30rem;"> 
  <h5 class="card-header">Profile Picture</h5> 
  
  <div class="card-body">
    <?php 
    if(empty($user[0][9]))
    {
    $style="disabled";
    ?>
  <img src="assets/images/Profile/profile.svg" class="img-fluid" alt="Profile Picture" style=" height: 10rem;border: 2px solid black;width: 10rem;"><br/><br/>
  <?php
    }
    else
    {?>
    <img src="<?=$user[0][9]?>" class="img-fluid" alt="Profile Picture" style=" height: 10rem;border: 2px solid black;width: 10rem;"><br/><br/>
  <?php }?>
  <input type="file" name="files[]" id="fileToUpload"><br/><br/>
  <div class="row" style="width: 100%; justify-content: space-evenly;">
  <button name="upload"  class="btn btn-primary" type="submit" value="<?=$userid?>" >Upload Image</button>
  <button name="remove"  class="btn btn-danger" type="submit" value="<?=$userid?>" <?=$style?>>Remove Image</button>
    
</div>
  </div>
 
</div>
</form>
<div class="card" style="width: 62rem; margin-left: 2rem;">
  <h5 class="card-header">My Profile</h5>
  <form action="" method="post">
  <div class="card-body">
    <div class="row" style="width: 100%; ">
       <p class="card-text" style="padding: 0.5rem;">FirstName:</p><input type="text" 
		           class="form-control" 
		           name="firstname" 
		           id="firstname"
               value="<?=$user[0][1]?>"
               disabled style="width: 30rem;margin-left: 3.5rem;">
    </div>    
  
  <div class="row" style="width: 100%; ">
       <p class="card-text" style="padding: 0.5rem;">LastName:</p><input type="text" 
		           class="form-control" 
		           name="lastname" 
		           id="lastname"
               value="<?=$user[0][2]?>"
               disabled style="width: 30rem;margin-left: 3.5rem;">
    </div>
    <div class="row" style="width: 100%; ">
       <p class="card-text" style="padding: 0.5rem;">Address:</p><input type="text" 
		           class="form-control" 
		           name="address" 
		           id="address"
               value="<?=$user[0][3]?>"
               disabled style="width: 30rem;margin-left: 4.3rem;">
    </div>
    <div class="row" style="width: 100%; ">
       <p class="card-text" style="padding: 0.5rem;">Phone Number:</p><input type="text" 
		           class="form-control" 
		           name="phoneno" 
		           id="phoneno"
               value="<?=$user[0][4]?>"
               disabled style="width: 30rem;margin-left: 1.2rem;">
    </div>   
    <div class="row" style="width: 100%; ">
       <p class="card-text" style="padding: 0.5rem;">Username:</p><input type="text" 
		           class="form-control" 
		           name="username" 
		           id="username"
               value="<?=$user[0][5]?>"
               disabled style="width: 30rem;margin-left: 3.5rem;">
    </div>
    <div class="row" style="width: 100%; ">
       <p class="card-text" style="padding: 0.5rem;">Password:</p><input type="password" 
		           class="form-control" 
		           name="password" 
		           id="password"
                disabled style="width: 30rem;margin-left: 3.5rem;">
        <em style="font-size: 0.7rem; color: red;">**leave this field empty if you don't want to change password**</em>
    </div>
    <a href="#" class="btn btn-primary" id="btnedit" onclick="edit()" style="width: 6rem;">Edit</a>    
    <button  id="btnsave" type="submit" name="save" class="btn btn-success" style="width: 6rem;" value="<?=$user[0][0]?>"  hidden>Save</button>
    <a href="#" class="btn btn-primary" id="btncancel" onclick="cancel()" style="width: 6rem;" hidden>Cancel</a> 
  </div>
    </from>
</div>
</div>
</div>
</html>