<?php $url = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']); ?>

<div class="sidebar-inner slimscroll">
    <div id="sidebar-menu" class="sidebar-menu">
        <ul>
            <li class="<?php if ($url == 'index.php') {
                echo 'active';
            } ?>">
                <a href="index.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
            </li>
            <li class="submenu">
                <a href="#"><i class="fa fa-user"></i> <span> Profile </span> <span class="menu-arrow"></span></a>
                <ul style="display: none;">
                    <li><a href="profile.php" class="<?php if ($url == 'profile.php') {
                            echo 'active';
                        } ?>">My Profile</a></li>
                    <li><a href="update-profile.php" class="<?php if ($url == 'update-profile.php') {
                            echo 'active';
                        } ?>">Edit Profile</a></li>
                </ul>
            </li>
            <li class="submenu">
                <a href="#">  <i class="fa-solid fa-capsules"></i><span>Manage Stock </span> <span class="menu-arrow"></span></a>
                <ul style="display: none;">
                    <li><a href="manage-stock.php" class="<?php if ($url == 'manage-stock.php') {
                            echo 'active';
                        } ?>">View Stock</a></li>
                    <li><a href="create-stock.php" class="<?php if ($url == 'create-stock.php') {
                            echo 'active';
                        } ?>">Add Medicine</a></li>
                </ul>
            </li>
            <li class="submenu">
                <a href="#">  <i class="fa-solid fa-file-medical"></i><span>Prescription Manage </span> <span class="menu-arrow"></span></a>
                <ul style="display: none;">
                    <li><a href="view-prescription.php" class="<?php if ($url == 'view-prescription.php') {
                            echo 'active';
                        } ?>">View Prescription</a></li>
                    <li><a href="create-prescription.php" class="<?php if ($url == 'create-prescription.php') {
                            echo 'active';
                        } ?>">Create Prescription</a></li>
                </ul>
            </li>
            <li class="submenu">
                <a href="#"> <i class="fa-solid fa-file-invoice"></i><span>Manage Invoice </span> <span class="menu-arrow"></span></a>
                <ul style="display: none;">
                    <li><a href="view-invoice.php" class="<?php if ($url == 'view-invoice.php') {
                            echo 'active';
                        } ?>">View Invoice</a></li>
                    
                </ul>
            </li>
            <li class="submenu">
                <a href="#">  <i class="fa-solid fa-file-invoice-dollar"></i><span>Process Payment </span> <span class="menu-arrow"></span></a>
                <ul style="display: none;">
                    <li><a href="view-payment.php" class="<?php if ($url == 'create-payment.php') {
                            echo 'active';
                        } ?>">View Payment</a></li>
                    <li><a href="create-payment.php" class="<?php if ($url == 'view-payment.php') {
                            echo 'active';
                        } ?>">Make Payment</a></li>
                </ul>
            </li>
           
            <li class="submenu">
                <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i><span>Logout </span> <span class="menu-arrow"></span></a>
             
            </li>
        </ul>
    </div>
</div>