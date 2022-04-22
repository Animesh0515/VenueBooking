<?php

//function to upload image
function uploadImage($files, $venueID=null, $conn, $directory, $userid=null)
{
    $target_dir = $directory;
    $count=0;
    $filenames=[];
        foreach($files['name'] as $key=>$val){
            $filename=uniqid() ."_". basename($files["name"][$key]);//unique id is added so that image with same name can be saved.
            array_push($filenames, $filename);
            $target_file = $target_dir .$filename; 
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $uploadOk = 1;

        // Check if image file is a actual image or fake image 
        $check = getimagesize($files["tmp_name"][$key]);
        if($check == false) {
            return "File is not an image.";                        
        } 

        // Check if file already exists
        if (file_exists($target_file)) {
            return  "Sorry, file already exists.";        
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"     && $imageFileType != "gif" ) {
        return  "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";        
        }
       
            //saving the file            
            if (move_uploaded_file($files["tmp_name"][$key], $target_file)) {                
                $count ++;
            } else {
            return "Sorry, there was an error saving your file.";
            }
        }
        $a=count($files['name']);
        if($count == count($files['name']))
        {
            if($userid==null)
            {
            $result=imageDataInsert($venueID, $filenames,$conn);
            }
            else
            {
                $result=userImageDataInsert($userid, $filenames, $conn);
            }
            if($result=="success")
            {
            return "true";
            }
        }
       

            
}

//function to inser the image data into table
function imageDataInsert($venueid, $filenames,$conn)
{
    $count=0;
    foreach($filenames as $file)
    {
        $url="assets/images/Venues/".$file;
    $sql = "Insert into venueimages(VenueID, ImageURL) values('$futsalid', '$url')";    
    $result = mysqli_query($conn, $sql);
    if($result)
    {
        $count ++;
    }
    }
    if($count== count($filenames))
    {
        return "success";
    }
    
}

function userImageDataInsert($userid, $filenames,$conn)
{
    $url="assets/images/Profile/".$filenames[0];
    $sql = "Update users set ImageUrl='$url' where userid='$userid'";    
    $result = mysqli_query($conn, $sql);
    if($result)
    {
        return "success";
    }
}

?>