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
              <a href="<?php echo site_url('dashboard/add'); ?>" class="btn btn-primary mr-1">Tambah Barang</a>
              <a href="<?php echo site_url('dashboard/export_gudang'); ?>" class="btn btn-success">Export Excel</a>
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
                        <th>Modal</th>
                        <th>Tanggal Terima</th>
                        <th style="text-align: center;">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($gudang as $g):?>
                        <tr>
                            <td><?php echo $g->nama_barang ?></td>
                            <td><?php echo $g->produsen ?></td>
                            <td><?php echo $g->penerima ?></td>
                            <td><?php echo $g->unit ?></td>
                            <td>Rp <?php echo $g->modal ?>,-</td>
                            <td><?php echo $g->nama_bulan ?> <?php echo $g->nama_tahun ?></td>
                            <td class="text-center">
                                <a href="<?php echo site_url('dashboard/detail/'. $g->id_barang); ?>" class="btn btn-primary btn-sm"><i class="mdi mdi-magnify-plus-outline"></i></a>
                                <a href="<?php echo site_url('dashboard/jual/'. $g->id_barang); ?>" class="btn btn-success btn-sm"><i class="mdi mdi-cash-usd"></i></a>
                                <a href="<?php echo site_url('dashboard/delete/'. $g->id_barang); ?>" class="btn btn-danger btn-sm"><i class="mdi mdi-delete"></i></a>
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

  