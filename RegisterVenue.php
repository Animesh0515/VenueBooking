<?php
include "functions/connection.php";
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
          .container {
        width: 100%;
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
        }

        .row{
          width: 103%; 
          padding: 1rem; 
          justify-content: space-between;
        }
        
        .filter {
   width:100%;
   padding:25px;
   border:1px solid black;
   /* margin:25px; */
   float:left;
   margin-bottom: 1rem;
}

.col {
   width:100%;
   display:block;
   /* margin-right:10px; */
}

label {
   vertical-align:top;
   float:left;
   width:11.5rem;;
}
.response{
	padding-top: 4.6rem;
}

@media (max-width: 991.98px){
	.response{
	padding-top: 0rem;
}
label {

width: 8.5rem;
}
}
          </style>
    </head>
    <body>
       <!-- Navbar -->
    <?php include 'navbar.php' ?> 
    <?php if(isset($_GET['success']) && $_GET['success']){?>
	<div class="response" >
<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a><strong> Registered Successfull!</strong> </div>
</div>
<?php echo'<script type="text/javascript">',
		'setTimeout(function () {',
   'window.location.href= "index.php";', 
	'},5000);',
	'</script>'; ?>
<?php }?>
    
    <div class="container d-flex justify-content-center align-items-center"
      style="padding-top:6rem;">
      	<form class="border shadow p-3 rounded"
      	      action="functions/ConfirmVenueRegistration.php" 
      	      method="post" 
             enctype="multipart/form-data"
      	      style="width: 100%;">
      	      <h1 class="text-center p-3">REGISTER  </h1>
      	      <?php if (isset($_GET['error'])) { ?>
      	      <div class="alert alert-danger" role="alert">
				  <?=$_GET['error']?>
			  </div>
			  <?php } ?>
        <div class="row" >
              <div class="mb-3">
		    <label for="name" 
		           class="form-label">Name</label>
		    <input type="text" 
		           class="form-control" 
		           name="name" 
		           id="name">				   
		  </div>
          <div class="mb-3">
		    <label for="location" 
		           class="form-label">Location</label>
		    <input type="text" 
		           class="form-control" 
		           name="location" 
		           id="location">				   
		  </div>
              
          <div class="mb-3">
		    <label for="contact" 
		           class="form-label">Contact No</label>
		    <input type="text" 
		           class="form-control" 
		           name="contact" 
		           id="contact">				   
		  </div>
      </div>
          <div class="mb-3">
		    <label for="description" 
		           class="form-label" style="width: 20rem;">Description<em>(Must be less than 1000 words)</em></label><br/>
               <textarea rows = "3"  name = "description" style=" width: 100%;">
              </textarea>			   
		  </div>
      <div class="row">			   
      <div class="mb-3">
		    <label for="longitude" 
		           class="form-label">Email </label>
		    <input type="text" 
		           name="gmail" 
		           class="form-control" 
		           id="gmail">
		  </div>
		  <div class="mb-3">
		    <label for="longitude" 
		           class="form-label">Longitude </label>
		    <input type="text" 
		           name="longitude" 
		           class="form-control" 
		           id="longitude">
		  </div>

      <div class="mb-3">
		    <label for="latitude" 
		           class="form-label">Latitude</label>
		    <input type="text" 
		           name="latitude" 
		           class="form-control" 
		           id="latitude">
		  </div>
      </div>
      <?php
      $time = $conn->query("SELECT * from time");
      if($time)
      {
      $time = mysqli_fetch_all($time);
      }
      ?>
       <div class="mb-1">
	<label class="form-label">Select Available Time:</label></br>
        <div class="filter"> 
      <div class="tags"> 
   <div class="col"> 
      <?php
      foreach($time as $t) 
      {
      ?>
  
    <label> <input type="checkbox" rel="time" name="time[]" value="<?=$t[0]?>"><?=$t[1]?></label>     
   
        <!-- <input type="checkbox" name="time" value="<?=$t[0]?>">
        <label for="timelbl" style="margin-right: 5rem;"> <?=$t[1]?></label>         -->
        <?php }?>
		  </div>
      </div>
      
 </div>  
</div>
<label for="latitude"  class="form-label" style=" float: none;width: 20rem;">Upload Images<em>(Multiple file can be choosen)</em>:</label><br/>
<!-- <input type="file" name="files[]" id="fileToUpload">  -->
<input type="file" name="files[]" id="fileToUpload" multiple><br/><br/>
<em style="color:red;">**Admin will contact you soon after registration**</em><br/>
		  <button type="submit" 
		          class="btn btn-primary">Register</button>
				  
				  
		</form>
      </div>

    </body>
</html>