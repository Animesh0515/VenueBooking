<?php 
include "controls/connection.php";
if(isset($_POST['bookingid']))
{
  $id=$_POST['bookingid'];
  $sql="update  futsalbooking set CancelledFlag='Y' where bookingid='$id'";
  $result1=mysqli_query($conn, $sql);
  if($result1)
  {
    echo "success";
    exit;
    // header("Location: MyBookings.php?success=true");
  }
  
}
session_start();

?>
<!DOCTYPE html>
<html>
<head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
        <link href="bootstrap\css\bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/style.css">
        <style>
          .col-md-3
          {
              max-width: 17rem !important;
          }
          img:hover{
            background-color:#caf7e3;
            
          }
          @media (max-width: 991.98px){
            #search
            {
              margin-left: 8.3rem !important;
            }
          }
        </style>
        <script>
          function cancelBooking(id)
          {
            var confirmAction = confirm("Are you sure to cancel this booking?");
            if (confirmAction) {
            $.ajax({
                url: "MyBookings.php",
                type: "post",
                data: {bookingid:id} , 
                success: function (response) {
              debugger;
              if(response=="success")
              {
                document.getElementById("success").hidden = false;
                setTimeout(function () {
                  window.location.reload();
                  },5000);      
                

              }
              
              else
              {
                document.getElementById("error").hidden = false;
                setTimeout(function () {
                  document.getElementById("error").hidden = true;
                  },10000); 
              }
            },                      
                error: function(jqXHR, textStatus, errorThrown) {
                  console.log(textStatus, errorThrown);
                }
            });
          }
          }


          function filterRows() {
            debugger;
        var from = $('#datefilterfrom').val();
        var to = $('#datefilterto').val();

        if (!from && !to) { // no value for from and to
          return;
        }

        from = from || '1970-01-01'; // default from to a old date if it is not set
        to = to || '2999-12-31';

        var dateFrom = moment(from);
        var dateTo = moment(to);

        $('#bookingTable tr').each(function(i, tr) {
          debugger;
          var val = $(tr).find("td:nth-child(6)").text();
          var dateVal = moment(val, "MM/DD/YYYY");
          var visible = (dateVal.isBetween(dateFrom, dateTo, null, [])) ? "" : "none"; // [] for inclusive
          $(tr).css('display', visible);
        });
        }

     function search(val) {
        debugger;
    var value = val.toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  };

    function reload()
    {
      window.location.reload();
    }

    function closeMessage(id)
    {
            debugger;
            document.getElementById(id).hidden=true;

    }

        </script>
</head>
<body>
    <!-- Navbar -->
    <?php include 'navbar.php' ?>  
	<div class="response" id="success" style="padding-top:4.6rem;" hidden>
<div class="alert alert-success" ><strong> Booking Cancelled Successfully.</strong><img src="assets/icons/cancel.svg" alt="" style="height: 1rem;float: right;" onclick="closeMessage('success')"> </div>
</div>
  <div class="response" id="error" style="padding-top:4.6rem;" hidden>
  <div class="alert alert-danger" ><strong>Something went wrong!</strong><img src="assets/icons/cancel.svg" alt="" style="height: 1rem;float: right;" onclick="closeMessage('error')"> </div>
  </div>


    <!-- <div class="response" id="message" style="padding-top:4.6rem;" hidden>
<div class="alert alert-success" ><strong> Booking Cancelled</strong><img src="assets/icons/cancel.svg" alt="" style="height: 1rem;float: right;" onclick="closeMessage(message)"> </div>
</div>  
<div class="response" id="error"  style="padding-top:4.6rem;" hidden>
<div class="alert alert-danger" ><strong> Something went wrong!</strong><img src="assets/icons/cancel.svg" alt="" style="height: 1rem;float: right;" onclick="closeMessage(error)"> </div>
</div> -->
    <div style="padding:8rem;"> 
     
    <h3>My Bookings<img src="assets/icons/reload.svg" alt="Reload" title="Reload" style="height: 1.8rem;margin-left: 1rem;border-radius: 35px;" onclick="reload()"></h3>
    <div class="row" style="width:101%">
  <div class="col-md-3" >
    <h5>Date from</h5>
    <input type="date" class="form-control" id="datefilterfrom" data-date-split-input="true" onchange="filterRows()" style="width: 15rem;">
  </div>
  <div class="col-md-3">
    <h5>Date to</h5>
    <input type="date" class="form-control" id="datefilterto" data-date-split-input="true" onchange="filterRows()" style="width: 15rem;">
  </div>
  <div class="col-md-3" style="text-align: right;margin-left: 39.3rem; padding-right: 0rem !important;" id="search"> 
    <input class="form-control me-2" name="search" type="text" placeholder="Search.." aria-label="Search"onkeyup="search(this.value)" style="    margin-top: 2rem;">
  </div>
  
</div>
<div style="height:30rem;overflow:auto;margin-top: 2rem;">
    <table id="bookingTable" class="table" >
  <thead>
    <tr>
      <th scope="col">S.NO.</th>
      <th scope="col">Futsal</th>
      <th scope="col">Location</th>
      <th scope="col">Contact</th>
      <th scope="col">Booked On</th>
      <th scope="col">Booked For</th>
      <th scope="col">Time</th>
      <th scope="col">Paid</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody id="myTable">
      <?php
      $sql="select fb.BookingID, f.Name, f.location, f.contactNo, fb.BookedDate, fb.BookedFor, t.Time,fb.AdvanceAmount from futsalbooking fb join users u on fb.UserID=u.UserID join futsaltime ft on fb.FutsalTimeID=ft.FutsaltimeID join time t on ft.TimeID=t.TimeID join futsals f on ft.FutsalID=f.FutsalID where CancelledFlag='N' order by fb.BookedFor desc";
      $bookings=$conn->query($sql);
      if($bookings)
      {
          $bookings=mysqli_fetch_all($bookings);
      }
      if(count($bookings)==0)
      {?>
            <tr>
      <th colspan=9 style="text-align: center; color: grey;">No bookings done yet</th>      
    </tr>
      <?php
      }
      else
      {
          foreach($bookings as $key=>$value)
          {
              $key=$key+1;
      ?>    
    <tr>
      <th scope="row"><?=$key?></th>
      <td><?=$value[1]?></td>
      <td><?=$value[2]?></td>
      <td><?=$value[3]?></td>
      <td><?=$value[4]?></td>
      <td><?=$value[5]?></td>
      <td><?=$value[6]?></td>
      <td><?=$value[7]?></td>
      <?php
      $today = date("Y-m-d");
      $booked=$value[5];
      $today_time = strtotime($today);
      $booked_time = strtotime($booked);
      if($today_time<= $booked_time)
      {
      ?>
      <td><button class="btn btn-danger" onclick="cancelBooking(<?=$value[0]?>)">Cancel</button></td>
      <?php }
      else{?>
      <td><button class="btn btn-danger" disabled>Cancel</button></td>
      <?php }?>
    </tr>   
    <?php }}?>
     
  </tbody>
</table>
          </div>
<!-- <table id="bookingTable" class="table" border="1">
  <tr>
    <td>nothing</td>
    <td>nothing</td>
    <td>18/07/2018</td>
    <td>nothing</td>
  </tr>
  <tr>
    <td>nothing</td>
    <td>nothing</td>
    <td>19/07/2018</td>
    <td>nothing</td>
  </tr>
  <tr>
    <td>nothing</td>
    <td>nothing</td>
    <td>20/07/2018</td>
    <td>nothing</td>
  </tr>
</table> -->

</div>
<?php include 'footer.html' ?> 
</body>
</html>