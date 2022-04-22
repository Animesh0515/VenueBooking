
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home Page</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
    <!-- Bootstrap css -->
    <link href="bootstrap\css\bootstrap.min.css" rel="stylesheet">

    <!-- Addtional stylesheet -->
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
    .search-box {
        float: left;
        position: absolute;
        left: 0rem;
        top: 16.5rem;
        z-index: 1000;
        background-color: #343a40;
        padding: 3.3rem;
        color: #FFFFFF;
        width: 100%;
        font-weight: bold;
    }

    th {
        border-right: 1px solid grey;
        padding-left:1rem;
    }

    td{
      border-left: 1px solid grey;
      padding-left:1rem;
    }
    input{
        border:none;
        outline: none;
    }
    </style>
    <script>


    </script>

</head>

<body>
    <!-- Navbar -->
    <?php include 'navbar.php' ?>


    <div class="main-content" style="position: relative;">
        <img src="assets/images/venue.jpg" class="img-fluid" alt="..." style="width: 100%;height: 23rem;" />
        <div class="search-box" >
        <div class="row" style="justify-content: center;
    width: 100%;">
            <table style="background-color: white;color: grey; width: 50%;">
                <thead>
                    <tr>
                        <th>Location</th>
                        <th>No of Guest</th>
                        <th>Event</th>
                        
                    </tr>
                </thead>
                <tbody>
                  <tr>
                    <td style="width:40%"><input type="text" placeholder="Enter Desired Location"> </td>
                    <td><input type="text" placeholder="Enter No of Guest"> </td>
                    <td>Celebration</td>                   
  </tr>
                </tbody>
            </table>
            <button class="btn btn-danger">Search</button>
</div>
        </div>
    </div>
    <?php include 'footer.html' ?>


</body>

</html>