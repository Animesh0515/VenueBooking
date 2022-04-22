<!-- <?php
// session_start();
?> -->
<html>
  <head>
  <script src="https://kit.fontawesome.com/33593f5208.js" crossorigin="anonymous"></script>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="position: fixed; z-index: 5; width:100%">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.php" style="font-size: 1.5rem; padding-right: 0.5rem;"><img src="assets/icons/venuelocation.svg" alt="Book Venue Nepal" width="50" height="35">Venue Booking             
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown" style="justify-content: right;">
            <ul class="navbar-nav " >
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/Futsals.php">Futsals</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Contact</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#" style="width:8rem;">About US</a>
              </li>
              </ul>
              <?php if(isset($_SESSION['role']) && $_SESSION['role'] != 'user'){
                // $padding="24rem";
                ?>
              <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="width: 8rem;"> Menu </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="RegisterVenue.php">Register Futsal</a></li>
                        <li><a class="dropdown-item" href="MyRegistrations.php">My Registrations</a></li>
                        <li><a class="dropdown-item" href="AllRegistrations.php">All Registrations</a></li>
                        <li><a class="dropdown-item" href="UserBookings.php">User Bookings</a></li>
                        <li><a class="dropdown-item" href="Users.php">Users</a></li>
                        <!-- <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li> -->
                    </ul>
                </li>                
            </ul>
            <?php }
                else
                {
                  // $padding="31rem";
                }?>
            <?php if(isset($_SESSION['id']) != null){?>
              <ul class="navbar-nav" style="padding-left:<?=$padding?>;">             
                <li class="nav-item dropdown" >
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-user"></i>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <li><a class="dropdown-item" href="Profile.php">My Profile</a></li>
                  <li><a class="dropdown-item" href="MyBookings.php">My Bookings</a></li>
                  <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                 
                </ul>
              </li>
            </ul>
                  
                   <?php }
                  else
                  {?>
                   <ul class="navbar-nav" >   
                   <li class="nav-item">
                <a class="nav-link" href="Login.php">Login</a>               
                  </li>
                 
                  </ul>
                <?php }?>
              
              </div>
        </div>
      </nav>      
</body>
</html>
