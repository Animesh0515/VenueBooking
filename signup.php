<html>
    <head>
        <title>Signup Page</title>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<!-- Bootstrap css -->
<link href="bootstrap\css\bootstrap.min.css" rel="stylesheet">

<!-- Addtional stylesheet -->
<script src="https://kit.fontawesome.com/33593f5208.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="assets/css/style.css">

  <style>
	  .container {
    width: 100%;
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
}

.response{
	padding-top: 4.6rem;
}

@media (max-width: 991.98px){
	.response{
	padding-top: 0rem;
}
}
  </style>
  <script>
	  function successredirect()
	  {
		  
	  }
	</script>
</head>
<body>
<?php include 'navbar.php'; ?>

<?php if(isset($_GET['success']) && $_GET['success']){?>
	<div class="response" >
<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Successfull!Redirecting please wait.</strong> </div>
</div>
<?php echo'<script type="text/javascript">',
		'setTimeout(function () {',
   'window.location.href= "index.php";', 
	'},5000);',
	'</script>'; ?>
<?php } else if(isset($_GET['success']) && ! $_GET['success']) { ?>
	<div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert">&times;</a>
 <strong>Something went wrong!</strong> Please check your internet connection and try again .
</div>
<?php } ?>
<div class="container d-flex justify-content-center align-items-center"
      style="padding-top:6rem;">
      	<form class="border shadow p-3 rounded"
      	      action="functions/signupverify.php" 
      	      method="post" 
      	      style="width: 450px;">
      	      <h1 class="text-center p-3">SIGN UP</h1>
      	      <?php if (isset($_GET['error'])) { ?>
      	      <div class="alert alert-danger" role="alert">
				  <?=$_GET['error']?>
			  </div>
			  <?php } ?>
              <div class="mb-3">
		    <label for="firstname" 
		           class="form-label">First name</label>
		    <input type="text" 
		           class="form-control" 
		           name="firstname" 
		           id="firstname">				   
		  </div>
          <div class="mb-3">
		    <label for="lastname" 
		           class="form-label">Last name</label>
		    <input type="text" 
		           class="form-control" 
		           name="lastname" 
		           id="lastname">				   
		  </div>
          <div class="mb-3">
		    <label for="address" 
		           class="form-label">Address</label>
		    <input type="text" 
		           class="form-control" 
		           name="address" 
		           id="address">				   
		  </div>
          <div class="mb-3">
		    <label for="phoneno" 
		           class="form-label">Phone Number</label>
		    <input type="text" 
		           class="form-control" 
		           name="phoneno" 
		           id="phoneno">			   
		  </div>
		  <div class="mb-3">
		    <label for="username" 
		           class="form-label">User name</label>
		    <input type="text" 
		           class="form-control" 
		           name="username" 
		           id="username">
				   
		  </div>
		  <div class="mb-3">
		    <label for="password" 
		           class="form-label">Password </label>
		    <input type="password" 
		           name="password" 
		           class="form-control" 
		           id="password">
				  

		  </div>
		  
		 
		  <button type="submit" 
		          class="btn btn-success">Signup</button>
				  
				  
		</form>
</body>
    </html>