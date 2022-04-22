<?php
include "controls/connection.php";
$message;
// if(isset($_GET['q']) && $_GET['q']=="fu")
// {
//   header("Location:http://localhost:59392/index.php"); 
//   exit();
// }
session_start();
if(isset($_GET['q']) && $_GET['q']=="su")
{
  if(isset( $_SESSION['bookedDetails']) && ! empty( $_SESSION['bookedDetails']))
  {
    $amount=intval($_GET['amt']);
    $futsalid= $_SESSION['bookedDetails'][0]["futsalID"];
    $bookeddate= strtotime($_SESSION['bookedDetails'][0]["day"]);
    $bookeddate = date('m/d/Y',$bookeddate);
    $bookedtime= $_SESSION['bookedDetails'][0]["time"];
    $userid=$_SESSION['id'];
    $todaysdate=date("m/d/Y");
    $sql = "Insert into futsalbooking(UserID, FutsalTimeID, BookedDate, BookedFor, AdvanceAmount) values('$userid', '$bookedtime','$todaysdate','$bookeddate', '$amount')";
    $result = mysqli_query($conn, $sql);
    if($result)
    {
      $message="success";
     
    }
    else
    {
      $message="error";
    }
  }
  elseif(isset($_GET['q']) && $_GET['q']=="fu")
  {
    $message="Payment failure";
  }

}

?>
<html lang="en">
<head>
    <title>Details Page</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Bootstrap css -->
    <link href="bootstrap\css\bootstrap.min.css" rel="stylesheet">

    <!-- Addtional stylesheet -->
      <link rel="stylesheet" href="assets/css/style.css">

      <style>
          .carousel-control-next-icon {
    background-image: url(assets/icons/next.svg) !important;
        }

        .carousel-control-prev-icon {
    background-image: url(assets/icons/previous.svg) !important;
        }

        .carousel-indicators .active {
    background-color: black !important;
    }
  /* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}   

.carousel-indicators {
  bottom: 24px !important;
}

    @media (max-width: 991.98px){
      .row{
        width:54rem !important;
          }
}
      </style>
  <script>
function openForm() {
  debugger;
  var modal=document.getElementById("myModal");
  modal.style.display = "block";
}


function closeForm(){
  debugger;
  var modal=document.getElementById("myModal");
  modal.style.display = "none";
  
}

function openloginModal(){
  document.getElementById("loginModal").style.display = "block";
}

function closeloginform(){
  document.getElementById("loginModal").style.display = "none";
}

function redirect() {
    window.location.href="login.php";
  }
  function fetchTime(date, id){
    debugger;
    $.ajax({
        url: "controls/fetchTime.php",
        type: "post",
        data: {Time:date, ID:id} ,
        success: function (response) {
          debugger;
          if(response=="success")
          {
            document.getElementById("errortxt").style.display = "none";             
            window.location.reload();

          }
          else if(response=="full")
          {
            document.getElementById("errortxt1").style.display = "contents"; 
          }
          else if(response=="error")
           {
            alert("something went wrong !")
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });
    
    
  }

  function Timeclick(){
    debugger;
    var selectedTime = document.getElementById('time').options;
    if(selectedTime.length==1)
    {
      document.getElementById("errortxt").style.display = "contents"; 
    }
    
  }

  function closeMessage()
  {
    document.getElementById("message").style.display="none";

  }
</script>
</head>
<body>
<?php include 'navbar.php'?> 
<div style="padding-top: 4.6em">
<?php
if(isset($message))
{
  if($message=="success")
  {?>
<div class="alert alert-success" role="alert" id="message">
				  Booking successful. <img src="assets/icons/cancel.svg" alt="" style="height: 1rem;float: right;" onclick="closeMessage()">
			  </div>
        <?php }
  elseif($message="error")
  {?>
<div class="alert alert-danger" role="alert" id="message">
				  Something went wrong! Contact Admin <img src="assets/icons/cancel.svg" alt="" style="height: 1rem;float: right;" onclick="closeMessage()">
			  </div>
<?php
 }
 else
 {?>
  <div class="alert alert-danger" role="alert" id="message">
				  $message <img src="assets/icons/cancel.svg" alt="" style="height: 1rem;float: right;" onclick="closeMessage()">
			  </div>
<?php
 }
}

?>
</div>
<div class="main-content" style="padding-top: 6rem" >

<div class="container">
  <div class="row" style="width: 105rem;">
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" style="width: 54rem; margin-right: 0.5rem;">
  <div class="carousel-indicators" style="width: 39rem;">
  <?php
  if(isset($_GET["id"]))
  {
  $id=$_GET["id"];
  }
  else
  {
    $id=$futsalid;
  }
  $count=0;
   $images = $conn->query("SELECT ImageURL FROM futsalimages where FutsalID={$id}");
   if ($images) {
    $images = mysqli_fetch_all($images);
    foreach($images as $image){
      if($count==0){?>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to=<?=$count?> class="active" aria-current="true" ></button>
     <?php }else{?>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to=<?=$count?> ></button>
      <?php }
    $count=$count + 1;
    }?>
    
  </div>
  <div class="carousel-inner" style="height: 30.4rem;width: 54rem;">
  <?php 
  $count=0;
  foreach($images as $image){
    if($count==0){?>
    <div class="carousel-item active">
      <img src="<?=$image[0]?>" class="d-block w-100" alt="..." style="height: 100%;">
    </div>
    <?php }else{?>
    <div class="carousel-item ">
      <img src="<?=$image[0]?>" class="d-block w-100" alt="..." style="height: 100%;">
    </div>
    <?php }
    $count=$count + 1;
    ?>
  <?php }}?>
  </div>


  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev" style="background-color: transparent;border: none;">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next" style="background-color: transparent;border: none;">
    <span class="carousel-control-next-icon" aria-hidden="true" style="width: 36px;height: 30px"></span>

  </button>
</div>
<?php  

     $futsals = $conn->query("SELECT * FROM futsals where FutsalID={$id}");
     if ($futsals) {
      $futsals = mysqli_fetch_all($futsals);
     }
   ?>
<form action="controls/EsewaPayment.php" method="post" >
<div class="card" style="width: 50rem;height: 30.5rem;">
  <div class="card-header" style="font-size: 2rem;">
    <?=$futsals[0][1]?>
  </div>
  <div class="card-body">
    <h5 class="card-title" ><?=$futsals[0][4]?></h5>
    <p class="card-text"><img src="assets/icons/location2.svg" alt="" style="height: 2rem;"><?=$futsals[0][2]?><br/><img src="assets/icons/contact.svg" alt="" style="height: 2rem;">&nbsp;<?=$futsals[0][3]?><span style="margin-left: 32rem;font-size: 1.5rem;color: red;" ><input type="text" value="<?=$futsals[0][5]?>" name="Price" hidden></input>Price:<?=$futsals[0][5]?></span></p>
    <p class="card-text">Select Date:
      <?php
      if(!empty($_SESSION['selectedDate']))
      {
        $date=strtotime($_SESSION['selectedDate']);
        $date = date('Y-m-d',$date);
      }
      else
      {
        $date="";
      }
      ?>
    <input type="date" id="date" name="Day" min="<?=date("Y-m-d")?>" onchange="fetchTime(this.value,<?=$id?>)" value="<?=$date?>">   
   </p>
    <p class="card-text">Select Time:
   <select name="Time" id="time" onclick="Timeclick()">
   <option value="" >Choose option</option>
   <?php 
   if(!empty($_SESSION['availableTime']))
   {
    $times=$_SESSION['availableTime'];
   foreach($times as $time){
   ?>
    <option value="<?=$time[0]?>"><?=$time[1]?></option>    
    <?php } }?>
  </select>
  <span style="color:red; display:none; font-size: 0.9rem;" id="errortxt" >Select date First </span>
   </p>
   <?php
   if (! isset($_SESSION["availableTime"]) || count($_SESSION["availableTime"])==0) 
   {
     $disabletxt="disabled";
     
   }
   else
   {
    $disabletxt="";
   }
   ?>
   <button type="submit"  name="submit" id="btnBook" class="btn btn-primary" value="<?=$futsals[0][0]?>" <?=$disabletxt?>>Book Now</button>
   <span style="color:red; display:none; font-size: 0.9rem;" id="errortxt1" >Booking Full </span>
    </form> 
    
  </div>
</div>
</div>
</div>
</div>


<
</div>
 <?php include 'footer.html' ?> 
 <?php
 unset($_SESSION['selectedDate']);  
 unset($_SESSION['availableTime']); 
 unset($_SESSION['bookedDetails']);
 $message="";
 ?>
</body>

</html>