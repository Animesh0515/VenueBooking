<?php
include "connection.php";
session_start();
if(isset($_POST['Time']) || isset($_POST['ID']))
{
    $time= strtotime($_POST['Time']);
    $time = date('m/d/Y',$time);
    $id=$_POST['ID'];

   
    $sql="select ft.FutsalTimeID,t.Time from futsaltime ft join time t on ft.TimeID=t.TimeID join futsalbooking fb on fb.FutsalTimeID=ft.FutsaltimeID where fb.bookedfor='{$time}' and ft.FutsalID={$id} and CancelledFlag='N'";
    $bookedTime = $conn->query($sql);
    if ($bookedTime) {
     $bookedTime = mysqli_fetch_all($bookedTime);
    }

    $sql="select ft.FutsalTimeID, t.Time from time t join futsaltime ft on t.TimeID=ft.TimeID where ft.FutsalID={$id}";
    $allTime=$conn->query("select ft.FutsalTimeID, t.Time from time t join futsaltime ft on t.TimeID=ft.TimeID where ft.FutsalID={$id}");
    if($allTime)
    {
        $allTime=mysqli_fetch_all($allTime);
    }
        //array_diff finds the difference between two arrays and eleminates the matched ones.
        //serializing array because the array is multidimensional and arry_diff doesnot accept multidimensional
        $diff = array_diff(array_map('serialize',$allTime), array_map('serialize',$bookedTime)); 
        //Deserializing the result array into actual array.
        $unserialized = array_map('unserialize',$diff);
        $_SESSION['availableTime']=$unserialized;
        $_SESSION['selectedDate']=$time;
        $count=count($_SESSION['availableTime']);
        if(count($_SESSION['availableTime'])==0)
        {
            echo "full";
        }
        else
        {
        echo "success";
        }
}

else
{
    echo "error";
}



?>