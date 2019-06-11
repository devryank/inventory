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
              Dashboard
            </h3>
            <nav aria-label="breadcrumb">
              <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                  <span></span>Overview
                  <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
              </ul>
            </nav>
          </div>
          <div class="row">
            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient-danger card-img-holder text-white">
                <div class="card-body">
                  <img src="<?php echo base_url();?>assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>
                  <h4 class="font-weight-normal mb-3">Barang Masuk
                    <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                  </h4>
                  <h2 class="mb-5"><?php echo $this->db->select('*')->from('tbl_gudang')->get()->num_rows(); ?></h2>
                  <h6 class="card-text">Increased by 60%</h6>
                </div>
              </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient-info card-img-holder text-white">
                <div class="card-body">
                  <img src="<?php echo base_url();?>assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>                  
                  <h4 class="font-weight-normal mb-3">Gudang
                    <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                  </h4>
                  <h2 class="mb-5"><?php echo $this->db->select('*')->from('tbl_gudang')->get()->num_rows(); ?>
                  <h4>(<?php 
                    $this->db->select_sum('unit');
                    $query = $this->db->get('tbl_gudang');
                    echo $query->row()->unit;
                  ?> Unit)</h4>
                  </h2>
                  <h6 class="card-text">Decreased by 10%</h6>
                </div>
              </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient-success card-img-holder text-white">
                <div class="card-body">
                  <img src="<?php echo base_url();?>assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>                                    
                  <h4 class="font-weight-normal mb-3">Barang Keluar
                    <i class="mdi mdi-diamond mdi-24px float-right"></i>
                  </h4>
                  <h2 class="mb-5"><?php echo $this->db->select('*')->from('tbl_barangkeluar')->get()->num_rows(); ?>
                  <h4>(<?php 
                    $this->db->select_sum('unit_jual');
                    $query = $this->db->get('tbl_barangkeluar');
                    echo $query->row()->unit_jual;
                  ?> Unit)</h4>
                  </h2>
                  <h6 class="card-text">Increased by 5%</h6>
                </div>
              </div>
            </div>
          </div>  
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Penjualan Terbanyak</h4>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>
                            Nama Barang
                          </th>
                          <th>
                            Produsen
                          </th>
                          <th>
                            Penerima
                          </th>
                          <th>
                            Jumlah Unit
                          </th>
                          <th>
                            Harga / Unit
                          </th>
                          <th>
                            Waktu Terima
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach ($max as $m): ?>
                        <tr>
                          <td>
                            <?php echo $m->nama_barang; ?>
                          </td>
                          <td>
                            <?php echo $m->produsen; ?>
                          </td>
                          <td>
                            <?php echo $m->penjual; ?>
                          </td>
                          <td>
                            <?php echo $m->unit_jual; ?>
                          </td>
                          <td>
                            Rp. <?php echo $m->jual; ?>
                          </td>
                          <td>
                            <?php echo $m->nama_bulan; ?> <?php echo $m->nama_tahun; ?>
                          </td>
                        </tr>

          <?php endforeach;?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <!-- content-wrapper ends -->
        <?php $this->load->view('partials/_footer'); ?>

  