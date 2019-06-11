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
              <a href="<?php echo site_url('dashboard/gudang'); ?>" class="btn btn-primary">Kembali</a>
              </ul>
            </nav>
          </div>
          
          <div class="grid-margin stretch-card">
            <div class="card">
                <div class="row pt-4 pl-4 pb-4">
                    <?php foreach ($detail as $d): ?>
                        <div class="col-md-12 col-lg-3">
                            <img src="<?php echo base_url();?>assets/upload/<?php echo $d->foto_barang; ?>" class="img-thumbnail" width="200"/>
                        </div>
                        <div class="col-md-12 col-lg-9">
                            <div class="row">
                                <div class="col-md-3">
                                    <h4>Nama Barang</h4>
                                    <h4>Produsen</h4>
                                    <h4>Penerima</h4>
                                    <h4>Jumlah Unit</h4>
                                </div>
                                <div class="col-md-8 mb-4">
                                <h4>: <?php echo $d->nama_barang; ?></h4>
                                <h4>: <?php echo $d->produsen; ?></h4>
                                <h4>: <?php echo $d->penerima; ?></h4>
                                <h4>: <?php echo $d->unit; ?></h4>
                                </div>
                            </div>
                            <a href="<?php echo site_url('dashboard/jual/'. $d->id_barang); ?>" class="btn btn-success btn-sm">Jual</a>
                            <a href="<?php echo site_url('dashboard/delete/'. $d->id_barang); ?>" class="btn btn-danger btn-sm">Hapus</a>

                        </div>
                    <?php endforeach;?>
                </div>
            </div>
          </div>
          
          
        <!-- content-wrapper ends -->
        <?php $this->load->view('partials/_footer'); ?>

  