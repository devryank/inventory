<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
              <div class="nav-profile-image">
                <span class="login-status online"></span> <!--change to offline or busy as needed-->              
              </div>
              <div class="nav-profile-text d-flex flex-column">
                <span class="font-weight-bold mb-2"><?php echo $user['name']; ?></span>
                <span class="text-secondary text-small"><?php if($user['level'] == 1){echo 'Adminstrator';} else {echo 'Seller';} ?></span>
              </div>
              <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('dashboard/'); ?>">
              <span class="menu-title">Dashboard</span>
              <i class="mdi mdi-home menu-icon"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <span class="menu-title">Barang</span>
              <i class="menu-arrow"></i>
              <i class="mdi mdi-crosshairs-gps menu-icon"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?php echo site_url('dashboard/gudang'); ?>">Gudang</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo site_url('dashboard/out'); ?>">Barang Keluar</a></li>
              </ul>
            </div>
          </li>
          <?php if($user['level'] == 1):?>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic2" aria-expanded="false" aria-controls="ui-basic">
              <span class="menu-title">Tambah</span>
              <i class="menu-arrow"></i>
              <i class="mdi mdi-crosshairs-gps menu-icon"></i>
            </a>
            <div class="collapse" id="ui-basic2">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="<?php echo site_url('dashboard/user'); ?>">User</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo site_url('dashboard/tahun'); ?>">Tahun</a></li>
              </ul>
            </div>
          </li>
          <?php endif;?>
        </ul>
      </nav>