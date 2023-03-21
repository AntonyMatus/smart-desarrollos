
<!-- Top Bar Start -->
<div class="topbar">

<!-- LOGO -->
<div class="topbar-left">
    <a href="index.php" class="logo">
        <span>
            <img src="assets/images/Recurso 4.svg" alt="" width="180" height="100">
        </span>
        <i>
            <img src="../../template/images/logos/Recurso 2.svg" alt="" height="22">
        </i>
    </a>
</div>

<nav class="navbar-custom">

    <ul class="navbar-right d-flex list-inline float-right mb-0">
        

        <li class="dropdown m-25">
            <p><?php echo $_SESSION['user_id'] ?></p>
        </li>
        <li class="dropdown notification-list">
            <div class="dropdown notification-list nav-pro-img">
                
                <a class="dropdown-toggle nav-link arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="assets/images/users/user-4.jpg" alt="user" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <!-- item-->
                    
                    <!-- <a class="dropdown-item text-danger" href="#"><i class="mdi mdi-power text-danger"></i> </a> -->
                    <form action="logout.php" method="post">
                        <button type="submit" class="dropdown-item text-danger" name="logout-btn"><i class="mdi mdi-power text-danger"></i>Logout</button>
                    </form>
                </div>                                                                    
            </div>
        </li>

    </ul>

    <ul class="list-inline menu-left mb-0">
        <li class="float-left">
            <button class="button-menu-mobile open-left waves-effect">
                <i class="mdi mdi-menu"></i>
            </button>
        </li>
        
    </ul>

</nav>

</div>
<!-- Top Bar End -->