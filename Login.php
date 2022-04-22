<html>
    <head>
<title>Login Page</title>
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
  </style>
    </head>
    <body>
        <?php include 'navbar.php'?>
        <div class="container d-flex justify-content-center align-items-center"
      style="min-height: 35rem; padding-top: 12rem;">
      	<form class="border shadow p-3 rounded"
      	      action="functions/loginverify.php" 
      	      method="post" 
      	      style="width: 288px;">
      	      <h1 class="text-center p-3">LOGIN</h1>
      	      <?php if (isset($_GET['error'])) { ?>
      	      <div class="alert alert-danger" role="alert">
				  <?=$_GET['error']?>
			  </div>
			  <?php } ?>
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
		          class="btn btn-primary">LOGIN</button>
				  <span>OR</span>
				  <a  href="signup.php"  class="btn btn-success">Signup</a>
				  
		</form>
      </div>

    </body>
</html>