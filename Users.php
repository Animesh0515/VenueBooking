<?php 
include "controls/connection.php";
if(isset($_POST['userid']))
{
  $id=$_POST['userid'];
  $sql="update  users set DeletedFlag='Y' where userid='$id'";
  $result1=mysqli_query($conn, $sql);
  if($result1)
  {
    echo "success";
    exit;
    // header("Location: MyBookings.php?success=true");
  }
  
}

if(isset($_POST['userdetails']))
{
  $userid=$_POST['userdetails']['Id'];
  $firstname=$_POST['userdetails']['firstname'];
  $lastname=$_POST['userdetails']['lastname'];
  $address=$_POST['userdetails']['address'];
  $phoneno=$_POST['userdetails']['phone'];
  $username=$_POST['userdetails']['username'];
  $role=$_POST['userdetails']['role'];
  $sql="update users set Firstname='$firstname', Lastname='$lastname', Address='$address', PhoneNumber='$phoneno', Username='$username', Role='$role' where userid='$userid'";
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
          select{
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            display: block;            
            height: calc(2.25rem + 2px);
            
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
                url: "Users.php",
                type: "post",
                data: {userid:id} , 
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
          var exist=document.getElementById("date"+i);          
            if(exist !== null)
            {
          var val=document.getElementById("date"+i).value;          
          var dateVal = moment(val, "MM/DD/YYYY");
          var visible = (dateVal.isBetween(dateFrom, dateTo, null, [])) ? "" : "none"; // [] for inclusive
          $(tr).css('display', visible);
            }
          
        });
        }

     function search(val) {
        debugger;
    var value = val.toLowerCase();
    $("#myTable tr").filter(function() {
      debugger;
      var show;
      $(this).closest('tr').find("input").each(function() {
        debugger;
        show=$(this).val().toLowerCase().indexOf(value) > -1
        if(show) { return false; }
        // alert(this.value)  
    });
      // var row = $(this).parent().prev().prev().children().val();
      $(this).toggle(show)
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

    function edit(id)
    {
      debugger;
      document.getElementById("firstname"+id).disabled = false;
      document.getElementById("lastname"+id).disabled = false;
      document.getElementById("address"+id).disabled = false;
      document.getElementById("phoneno"+id).disabled = false;
      document.getElementById("username"+id).disabled = false;
      document.getElementById("role"+id).disabled = false;
      document.getElementById("btnsave"+id).hidden = false;
      document.getElementById("btncancel"+id).hidden = false;
      document.getElementById("btnedit"+id).hidden = true;
      document.getElementById("btndelete"+id).hidden = true;
      
    }

    function cancel(id)
    {
      debugger;
      document.getElementById("firstname"+id).disabled = true;
      document.getElementById("lastname"+id).disabled = true;
      document.getElementById("address"+id).disabled = true;
      document.getElementById("phoneno"+id).disabled = true;
      document.getElementById("username"+id).disabled = true;
      document.getElementById("role"+id).disabled = true;
      document.getElementById("btnsave"+id).hidden = true;
      document.getElementById("btncancel"+id).hidden = true;
      document.getElementById("btnedit"+id).hidden = false;
      document.getElementById("btndelete"+id).hidden = false;
    }

    function save(id)
    {
      debugger;
      var userid=document.getElementById("ID"+id).value;
      var firtsname=document.getElementById("firstname"+id).value;
      var lastname=document.getElementById("lastname"+id).value;
      var address=document.getElementById("address"+id).value;
      var phone=document.getElementById("phoneno"+id).value;
      var username=document.getElementById("username"+id).value;
      var role=document.getElementById("role"+id).value;

      var user={
        Id:userid,
        firstname:firtsname,
        lastname:lastname,
        address:address,
        phone:phone,
        username:username,
        role:role
      };

      $.ajax({
                url: "Users.php",
                type: "post",
                data: {userdetails:user} , 
                success: function (response) {
              debugger;
              if(response=="success")
              {

                document.getElementById("message").innerHTML = "Updated Successfully. Reloading please wait.....";
                document.getElementById("firstname"+id).disabled = true;
                document.getElementById("lastname"+id).disabled = true;
                document.getElementById("address"+id).disabled = true;
                document.getElementById("phoneno"+id).disabled = true;
                document.getElementById("username"+id).disabled = true;
                document.getElementById("role"+id).disabled = true;
                document.getElementById("btnsave"+id).hidden = true;
                document.getElementById("btncancel"+id).hidden = true;
                document.getElementById("btnedit"+id).hidden = false;
                document.getElementById("btndelete"+id).hidden = false;
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
    
        </script>
</head>
<body>
    <!-- Navbar -->
    <?php include 'navbar.php' ?>  
	<div class="response" id="success" style="padding-top:4.6rem;" hidden>
<div class="alert alert-success" ><strong id="message"> Booking Cancelled Successfully.</strong><img src="assets/icons/cancel.svg" alt="" style="height: 1rem;float: right;" onclick="closeMessage('success')"> </div>
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
      <th scope="col">First Name</th>
      <th scope="col">LastName</th>
      <th scope="col">Address</th>
      <th scope="col">Phone No</th>
      <th scope="col">Username</th>
      <th scope="col">Role</th>
      <th scope="col">Created Date</th>
      <th scope="col" style="width:12rem;text-align: center;">Action</th>
    </tr>
  </thead>
  
  <tbody id="myTable">
      <?php
      $userid=$_SESSION['id'];
      $sql="select * from users where deletedflag='N' order by createdDate desc";
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
      <td hidden><input type="text" class="form-control" id="ID<?=$key?>"  value="<?=$value[0]?>" ></td>
      <td> <input type="text" class="form-control" name="firstname"  id="firstname<?=$key?>" value="<?=$value[1]?>" disabled></td>
      <td><input type="text" class="form-control" name="lastname"  id="lastname<?=$key?>" value="<?=$value[2]?>" disabled></td>
      <td><input type="text" class="form-control" name="address"  id="address<?=$key?>" value="<?=$value[3]?>" disabled></td>
      <td><input type="text" class="form-control" name="phoneno"  id="phoneno<?=$key?>" value="<?=$value[4]?>" disabled></td>
      <td><input type="text" class="form-control" name="username"  id="username<?=$key?>" value="<?=$value[5]?>" disabled></td>
      <td>
      <select class="form-select mb-3"
		          name="role" 
              id="role<?=$key?>"
		          aria-label="Default select example"  disabled>
			  <option <?php if($value[7]=="user") echo"selected"?> value="user">User</option>
			  <option <?php if($value[7]=="owner") echo"selected"?> value="owner">Owner</option>
        <option <?php if($value[7]=="admin") echo"selected"?> value="admin">Admin</option>
		  </select>
      </td>
      <td><input type="text" class="form-control" name="date<?=$key?>"  id="date<?=$key?>" value="<?=$value[8]?>" disabled></td>   
      
      <td>
        <a  class="btn btn-primary"  id="btnedit<?=$key?>" onclick="edit(<?=$key?>)" style="width: 4.5rem;margin-right: 0.5rem; color:white;">Edit</a>
        <button type="submit"  name="save" class="btn btn-success" id="btnsave<?=$key?>"  onclick="save(<?=$key?>)" style="width: 4.5rem;margin-right: 0.5rem;" hidden>Save</button>
        <a  class="btn btn-danger" id="btncancel<?=$key?>" onclick="cancel(<?=$key?>)" style="width: 4.5rem;margin-right: 0.5rem; color:white;" hidden>Cancel</a>
        <a class="btn btn-danger" id="btndelete<?=$key?>" onclick="cancelBooking(<?=$value[0]?>)" style="color:white;">Delete</a>
      </td>
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