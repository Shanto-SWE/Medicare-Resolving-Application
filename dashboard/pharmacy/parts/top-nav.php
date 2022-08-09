<div class="header-left">
    <a href="index.php" class="logo">
        <img src="assets/img/logo.png" width="35" height="35" alt=""> <span>CMS</span>
    </a>
</div>
<a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
<a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
<ul class="nav user-menu float-right">
   
   
    <li class="nav-item dropdown has-arrow">
        <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
            <span class="user-img">
                <img class="rounded-circle" style="height: 40px;width: 40px" src="<?php echo $row['photo']; ?>" width="24" onerror="this.onerror=null; this.src='assets/img/user.jpg'" alt="">
                <span class="status online"></span>
            </span>
            <span><?php echo $row['first_name']; ?></span>
        </a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="profile.php">My Profile</a>
            <a class="dropdown-item" href="update-profile.php">Edit Profile</a>
            <a class="dropdown-item" href="settings.html">Settings</a>
            <a class="dropdown-item" href="logout.php">Logout</a>
        </div>
    </li>
</ul>
<div class="dropdown mobile-user-menu float-right">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
    <div class="dropdown-menu dropdown-menu-right">
        <a class="dropdown-item" href="profile.php">My Profile</a>
        <a class="dropdown-item" href="update-profile.php">Edit Profile</a>
        <a class="dropdown-item" href="settings.html">Settings</a>
        <a class="dropdown-item" href="logout.php">Logout</a>
    </div>
</div>