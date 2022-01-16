<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <?php
        $menu = $this->uri->segment(1);
        ?>
        <div class="sidebar-brand">
            <a href="<?php echo base_url(); ?>">RUMAH DINAS</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">MENU</li>
            <li class="dropdown <?php if($menu == 'welcomeuser' || $menu == 'changepassuser' || $menu == "profileuser"){ echo 'active'; } ?>">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-laptop"></i> <span>Dashbaord</span></a>
                <ul class="dropdown-menu">
                    <li class="<?php if($menu == 'welcomeuser'){ echo 'active'; } ?>"><a class="nav-link" href="<?php echo base_url(); ?>welcomeuser">Home</a></li>
                    <li class="<?php if($menu == 'changepassuser'){ echo 'active'; } ?>"><a class="nav-link" href="<?php echo base_url(); ?>changepassuser">Ganti Password</a></li>
                    <li class="<?php if($menu == 'profileuser'){ echo 'active'; } ?>"><a class="nav-link" href="<?php echo base_url(); ?>profileuser">Profile</a></li>
                </ul>
            </li>
        </ul>
    </aside>
</div>