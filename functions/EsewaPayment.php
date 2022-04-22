<html lang="en">
<head>
    <title>Details Page</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Bootstrap css -->
    <link href="..\bootstrap\css\bootstrap.min.css" rel="stylesheet">

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


function closeForm(id){
  debugger;
  location.href = '../BookingDetails.php?id='+id;
  
}

function openloginModal(){
  document.getElementById("loginModal").style.display = "block";
}

function closeloginform(id){
  location.href = '../BookingDetails.php?id='+id;
}
function redirect() {
    window.location.href="../login.php";
  }


</script>
</head>
</html>
<?php
session_start();
       if(isset($_POST['submit'])){
        $id=$_POST['submit'];
        $amount=$_POST['Price'];
        if(!empty($_POST['Day']) && !empty($_POST['Time'])) {
         if(!empty($_SESSION['id']))
         {
           
           $advance=(string)(($amount)*10/100);
           $esewaid=uniqid();//created a uniqu id for every transaction
           $bookingArray=array(
             array("futsalID"=>$id,"day"=>$_POST['Day'],"time"=>$_POST['Time']),
               );
          $_SESSION['bookedDetails']=$bookingArray;
          //getting the current host and port
          $url= $_SERVER['HTTP_HOST']; 


          $a='<div id="myModal" class="modal">
          <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close"  aria-label="Close" onclick="closeForm('.$id.')"></button>
      </div>
      <div class="modal-body">
        <h1>Continue to Checkout</h1>
        <span>10% should be paid for booking</span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="closeForm('.$id.')">Close</button>
        <form action="https://uat.esewa.com.np/epay/main" method="POST" style="height: 1.5rem;">
          <input value="'.$advance.'" name="tAmt" type="hidden">
          <input value="'.$advance.'" name="amt" type="hidden">
          <input value="0" name="txAmt" type="hidden">
          <input value="0" name="psc" type="hidden">
          <input value="0" name="pdc" type="hidden">
          <input value="EPAYTEST" name="scd" type="hidden">
          <input value="'.$esewaid.'" name="pid" type="hidden">
          <input value="http://'.$url.'/BookingDetails.php?q=su" type="hidden" name="su">
          <input value="http://'.$url.'/BookingDetails.php?q=fu" type="hidden" name="fu">
          <input value="Yes" class="btn btn-primary" type="submit">
          </form> 
          
      
        
      </div>
    </div>
  </div>
          </div>';          
        echo $a;
        echo '<script type="text/javascript">',
        'openForm();',
        '</script>'
   ;
        }
        else{
          echo'<div id="loginModal" class="modal">
          <div class="modal-dialog">
    <div class="modal-content">
     
      <div class="modal-body">
        <h1>Please Login First</h1>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="closeloginform('.$id.')">Close</button>
        <button type="button" class="btn btn-primary" onclick="redirect()">Continue to login</button>
      </div>
    </div>
  </div>
          </div>';          
        
        echo '<script type="text/javascript">',
        'openloginModal();',
        '</script>';

        }
        } else {
          echo "<script type='text/javascript'>alert('Please select the Day and Time.');location.href = '../BookingDetails.php?id=$id';</script>";
          
         
        }
      }
    
    ?> 
