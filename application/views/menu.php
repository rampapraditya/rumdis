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
            <li class="dropdown <?php if($menu == 'welcome' || $menu == 'identitas' || $menu == 'changepass'){ echo 'active'; } ?>">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-laptop"></i> <span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <li class="<?php if($menu == 'welcome'){ echo 'active'; } ?>"><a class="nav-link" href="<?php echo base_url(); ?>welcome">Home</a></li>
                    <li class="<?php if($menu == 'identitas'){ echo 'active'; } ?>"><a class="nav-link" href="<?php echo base_url(); ?>identitas">Identitas</a></li>
                    <li class="<?php if($menu == 'changepass'){ echo 'active'; } ?>"><a class="nav-link" href="<?php echo base_url(); ?>changepass">Ganti Password</a></li>    
                </ul>
            </li>
            <li class="dropdown <?php if($menu == 'korps' || $menu == 'pangkat' || $menu == 'users' || $menu == 'komplek' ){ echo 'active'; } ?>">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-database"></i> <span>Data</span></a>
                <ul class="dropdown-menu">
                    <li class="<?php if($menu == 'korps'){ echo 'active'; } ?>"><a class="nav-link" href="<?php echo base_url(); ?>korps">Korps</a></li>
                    <li class="<?php if($menu == 'pangkat'){ echo 'active'; } ?>"><a class="nav-link" href="<?php echo base_url(); ?>pangkat">Pangkat</a></li>
                    <li class="<?php if($menu == 'komplek'){ echo 'active'; } ?>"><a class="nav-link" href="<?php echo base_url(); ?>komplek">Komplek</a></li>
                    <li class="<?php if($menu == 'users'){ echo 'active'; } ?>"><a class="nav-link" href="<?php echo base_url(); ?>users">Users</a></li>
                </ul>
            </li>
        </ul>
    </aside>
</div>