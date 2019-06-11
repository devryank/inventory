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
              Barang Keluar
            </h3>
            <nav aria-label="breadcrumb">
              <ul class="breadcrumb">
              <a href="<?php echo site_url('dashboard/export_penjualan'); ?>" class="btn btn-success">Export Excel</a>
              </ul>
            </nav>
          </div>
          <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <table class="table table-bordered table-hover" id="table_id">
                    <thead>
                      <tr>
                        <th>Nama Barang</th>
                        <th>Produsen</th>
                        <th>Penerima</th>
                        <th>Unit</th>
                        <th>Harga Jual</th>
                        <th>Tanggal Terima</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($keluar as $k):?>
                        <tr>
                            <td><?php echo $k->nama_barang ?></td>
                            <td><?php echo $k->produsen ?></td>
                            <td><?php echo $k->penjual ?></td>
                            <td><?php echo $k->unit_jual ?></td>
                            <td>Rp <?php echo $k->jual ?>,-</td>
                            <td><?php echo $k->nama_bulan ?> <?php echo $k->nama_tahun ?></td>
                            <td>
                                <a href="<?php echo site_url('dashboard/delete_out/'. $k->id_barang); ?>" class="btn btn-danger btn-sm"><i class="mdi mdi-delete"></i></a>
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

  