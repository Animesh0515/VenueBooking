<?php
include "controls/connection.php";
session_start();
?>

<html lang="en">
<head>
<title>Fustal Booking</title>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
    <!-- Bootstrap css -->
    <link href="bootstrap\css\bootstrap.min.css" rel="stylesheet">

    <!-- Addtional stylesheet -->
      <link rel="stylesheet" href="assets/css/style.css">
    <style>
      .row {
      
      margin-right: -0.9375rem !important;
      margin-left: -0.9375rem !important;
      }


      .footer_overlay {   
    margin-top: 17rem;
}
      @media (max-width: 991.98px){
      .row {
          padding-left: 3rem !important;
          width: 100% !important;
          padding-right: 0rem !important;
          justify-content: space-evenly !important;
      }
    }
    </style>
<script>
  function searchFutsal(futsalname)
  {   
    debugger;
    if(futsalname=="")
    {
        alert("Enter the name of the futsal to search");
    }
    else
    {
    $.ajax({
        url: "controls/find-futsal.php",
        type: "post",
        data: {name:futsalname}  ,
        success: function (response) {
          debugger;
          if( response !="success")
          {
            alert("something went wrong !")

          }      
          else
          {
            window.location.reload();
          }     
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });
  }
  }
</script>
</head>
<body>
    <!-- Navbar -->
    <?php include 'navbar.php' ?> 
    <?php
    if(isset( $_SESSION["searchedItems"]))
    {
        $futsals=$_SESSION["searchedItems"];
    }
    else{
       $futsals = $conn->query("SELECT * FROM futsals where deletedflag='N' and approvedflag='Y'");
       if ($futsals) {
           $futsals = mysqli_fetch_all($futsals);
       }
      }
    ?>   
    <div class="main-content">    
    <div class="futsal-content" style="padding-top:3rem; padding-left: 33rem">    
    <form  class="d-flex" style="width:40rem;">
                <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search" style="margin-right: 0.5rem" value=<?php if(isset( $_SESSION["searchedText"])){ echo $_SESSION["searchedText"]; }?>>
                <button class="btn" type="button" onclick="searchFutsal(search.value)">Search</button>
              </form>
    </div>
    <?php
    if( empty($futsals))
    {?>
      <div style="text-align: center; font-size: 4rem;color: grey;">No registrations yet</div>
    <?php }
    else
    {
    ?>
    <div class="row" style=" justify-content: space-between;padding-right: 4rem;padding-left: 4rem;">
    <?php 
    if(! empty ($futsals ))
    {
    foreach($futsals as $futsal){?>
    <div class="card border-dark mb-3" style="max-width: 45rem;">
  <div class="row g-0" style="width: 55rem;">
    <div class="col-md-4">
      <?php
       $image = $conn->query("SELECT ImageUrl FROM futsalimages where FutsalID=$futsal[0] limit 1");
       $image = mysqli_fetch_all($image);
      ?>
      <img src=<?=(string)$image[0][0]?> class="img-fluid rounded-start" alt="..." style="padding: 0.2rem; height: 14.5rem;">
    </div>
    <div class="col-md-8" style="max-width: 23rem;">
      <div class="card-body">
        <h5 class="card-title"><?=$futsal[1]?></h5>
        <p class="card-text">Location: <?=$futsal[2]?><br/>Contact No: <?=$futsal[3]?><br/>Price:<?=$futsal[5]?> per hour</p> 
        <a href="http://maps.google.com/?q=<?=$futsal[6]?>, <?=$futsal[7]?>" target="_blank">            
        <button type="button" ><img src="assets/icons/location.svg" alt="" style="height: 2rem;"></button>
        <button type="button" class="btn btn-info" onClick="RedirectTo(<?=$futsal[0]?>)">Details</button>
        <button type="button" class="btn btn-dark" onClick="RedirectTo(<?=$futsal[0]?>)">Book</button>

        <!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div id="map"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a href="http://maps.google.com/?q=27.700738470566627, 85.28586991255817" target="_blank">
  <button  class="btn btn-primary"> Click Me</button>
</a>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>

      </div>
    </div>
  </div>
</div>
<?php } }?>

</div>
    <!-- <div class="row row-cols-1 row-cols-md-3 g-4">
  <div class="col">
    <div class="card" style="width: 25rem;">
      <img src="..." class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card" style="width: 25rem;">
      <img src="..." class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card" style="width: 25rem;">
      <img src="..." class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card" style="width: 25rem;">
      <img src="..." class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      </div>
    </div>
  </div>
</div> -->
<?php }?>
</div>
<?php include 'footer.html' ;

unset($_SESSION["searchedItems"]);
unset($_SESSION["searchedText"]);
?> 
</body>

<script>
 function RedirectTo(id) {
   debugger;
    window.location.href="BookingDetails.php?id="+id;
  }

  </script>
</html>