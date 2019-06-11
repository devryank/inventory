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
              <a href="<?php echo site_url('dashboard/add_year'); ?>" class="btn btn-primary mr-1">Tambah Tahun</a>
              </ul>
            </nav>
          </div>
          <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <table class="table table-bordered table-hover" id="table_id">
                    <thead>
                    <tr>
                        <th>Tahun</th>
                        <th style="text-align: center;">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($row as $r): ?>
                        <tr>
                            <td><?php echo $r->nama_tahun ?></td>
                            <td class="text-center">
                                <a href="<?php echo site_url('dashboard/delete_tahun/'. $r->id); ?>" class="btn btn-primary btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          
          
          
        <!-- content-wrapper ends -->
        <?php $this->load->view('partials/_footer'); ?>

  