<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->

    <?php $this->load->view('partials/_navbar'); ?>

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      
      <?php $this->load->view('partials/_sidebar'); ?>

      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-home"></i>                 
              </span>
              User
            </h3>
            <nav aria-label="breadcrumb">
              <ul class="breadcrumb">
              <a href="<?php echo site_url('dashboard/add_user'); ?>" class="btn btn-primary mr-1">Tambah User</a>
              </ul>
            </nav>
          </div>
          <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <table class="table table-bordered table-hover" id="table_id">
                    <thead>
                      <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Level</th>
                        <th style="text-align: center;">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($row as $r):?>
                        <tr>
                            <td><?php echo $r->name ?></td>
                            <td><?php echo $r->email ?></td>
                            <td>
                                <?php if($r->level == 1){
                                    echo 'Administrator';
                                }else if($r->level == 2){
                                    echo 'Seller';
                                } ?>
                            </td>
                            <td class="text-center">
                                <a href="<?php echo site_url('dashboard/edit_user/'. $r->id); ?>" class="btn btn-primary btn-sm">Edit</a>
                                <a href="<?php echo site_url('dashboard/delete_user/'. $r->id); ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-home"></i>                 
                </span>
                Activate User
              </h3>
            </div>
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <table class="table table-bordered table-hover" id="table_id2">
                    <thead>
                      <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Level</th>
                        <th style="text-align: center;">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($row as $r):
                        if($r->is_active == 0):?>
                        <tr>
                            <td><?php echo $r->name ?></td>
                            <td><?php echo $r->email ?></td>
                            <td>
                                <?php if($r->level == 1){
                                    echo 'Administrator';
                                }else if($r->level == 2){
                                    echo 'Seller';
                                } ?>
                            </td>
                            <td class="text-center">
                                <a href="<?php echo site_url('dashboard/activate/'. $r->id); ?>" class="btn btn-primary btn-sm">Aktifkan</a>
                            </td>
                        </tr>
                        <?php endif;?>
                    <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          
          
          
        <!-- content-wrapper ends -->
        <?php $this->load->view('partials/_footer'); ?>

  
