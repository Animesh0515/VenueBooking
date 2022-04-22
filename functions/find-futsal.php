<?php
include "connection.php";
session_start();
if(isset($_POST['name']))
      {
        $sql="";
        $futsalname=$_POST['name'];
        if(isset($_POST['flag']))
        {
          $flag=$_POST['flag'];
          if(! empty($flag) && ! empty($futsalname))
          {
            $sql="Select * from futsals where lower(name) like '%$futsalname%' and approvedflag='$flag' and   deletedflag='N'";
          }
          elseif(! empty($flag) &&  empty($futsalname))
          {
            $sql="Select * from futsals where  approvedflag='$flag' and   deletedflag='N'";
          }
          elseif( empty($flag) &&  ! empty($futsalname))
          {
            $sql="Select * from futsals where lower(name) like '%$futsalname%' and   deletedflag='N'";
          }
        }
        else{
          $sql="SELECT * FROM futsals where lower(Name) like '%".$futsalname."%' and deletedflag='N' and approvedflag='Y'";
        }
         

        $futsals = $conn->query($sql);
        if ($futsals) {
            $futsals = mysqli_fetch_all($futsals);
            $_SESSION["searchedItems"]=$futsals;
            $_SESSION["searchedText"]=$futsalname;
            echo "success";
        }
        
      }
?>