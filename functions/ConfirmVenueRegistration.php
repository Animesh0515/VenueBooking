<?php
include "../functions/connection.php";
include "Genericfunc.php";
session_start();

if(isset($_FILES['files']) && isset($_POST['time']) && ! empty($_POST['name']) && ! empty($_POST['location']) && ! empty($_POST['contact']) && ! empty($_POST['description']) && ! empty($_POST['gmail']))
{
    $message;
    if(strlen($_POST['description']) > 1000)
    {
        $message="Description Limit Exceeds";
       
    }

    $fileNames = array_filter($_FILES['files']['name']);     
    if(empty($fileNames)){ 
        $message="Pick some images(At least one)";

    }


    if(empty($message))
    {
        $id;
        $name=$_POST['name'];
        $location=$_POST['location'];
        $contact=$_POST['contact'];
        $description=trim($_POST['description']);   
        $gmail=$_POST['gmail'];   
        $longitude=$_POST['longitude'];
        $latitude=$_POST['latitude'];
        $times=$_POST["time"];        
        $files=$_FILES["files"];
        $userid=$_SESSION['id'];
        $todaysdate=date("m/d/Y");

        $sql = "Insert into venues(Name, Location, ContactNo, Description, Gmail, Longitude, Latitude, CreatedBy, CreatedDate, ApprovedFlag, Flag) values('$name', '$location','$contact','$description', '$gmail','$longitude','$latitude', '$userid', '$todaysdate', 'N', 'N')";
    
        $result = mysqli_query($conn, $sql);
        if($result)
        {
            $sql="Select VenueID from venues where Name='".$name."'";
            $id = $conn->query($sql);
            if($id)
            {
            $id = mysqli_fetch_all($id);
            $id=$id[0][0];
            foreach($times as $time) {
            
                $sql = "Insert into availabletime(VenueID, TimeID) values('$id', '$time')";    
                $result2 = mysqli_query($conn, $sql);
                if(!$result2)
                {
                    header("Location: ../RegisterVenue.php?error=something went wrong!");
                }
            }
            $uploaded=uploadImage($files, $id, $conn, "../assets/images/Venues/");
            if($uploaded=="true")
            {
                header("Location: ../RegisterVenue.php?success=true");   
            } 
            else
            {
                header("Location: ../RegisterVenue.php?error=".$uploaded."");
            }
            }else
            {
                header("Location: ../RegisterVenue.php?error=something went wrong!");


            }

        }
        else
        {
            header("Location: ../RegisterVenue.php?error=Something went wrong!");
        }
          
    }
    else{
        header("Location: ../RegisterVenue.php?error=".$message."");
    }        
}
else
{
    header("Location: ../RegisterVenue.php?error=Please fill out all fields");
}

?>
