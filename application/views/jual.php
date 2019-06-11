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
              Tambah Barang
            </h3>
            <nav aria-label="breadcrumb">
              <ul class="breadcrumb">
              <a href="<?php echo site_url('dashboard/gudang'); ?>" class="btn btn-primary">Kembali</a>
              </ul>
            </nav>
          </div>
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                <?php var_dump($jual); ?>
                  <?php foreach ($jual as $j): ?>
                  <form action="<?php echo site_url('dashboard/jual/'.$j->id_barang);?>" method="post">
                
                <input type="hidden" value="<?php echo $user['name'] ?>" name="penerima">
                    <div class="form-group">
                      <label for="Unit">Unit</label>
                      <input type="number" class="form-control" id="Unit" name="unit" value="<?php echo $j->unit;?>">
                      <?php echo form_error('unit', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <div class="form-group">
                      <label for="Unit">Produsen</label>                      
                      <input type="text" class="form-control" id="Produsen" name="produsen" value="<?php echo $j->produsen; ?>" readonly>
                      <?php echo form_error('produsen', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <div class="form-group">
                      <label for="Unit">Penjual</label>                      
                      <input type="text" class="form-control" id="penjual" name="penjual">
                      <?php echo form_error('penjual', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <div class="form-group">
                      <label for="Jual">Harga Jual</label>                      
                      <input type="number" class="form-control" id="jual" name="jual" placeholder="Modal : <?php echo $j->modal; ?>">
                      <?php echo form_error('jual', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-4">
                            <label for="Bulan">Bulan</label>
                            <select class="form-control" name="bulan" id="Bulan">
                                <?php foreach ($bulan as $b): ?>
                                <option value="<?php echo $b->id ?>"><?php echo $b->nama_bulan ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-lg-4">
                            <label for="Tahun">Tahun</label>
                            <select class="form-control" name="tahun" id="Tahun">
                                <?php foreach ($tahun as $t): ?>
                                <option value="<?php echo $t->id ?>"><?php echo $t->nama_tahun ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                  <?php endforeach; ?>
                    <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                  </form>
                </div>
              </div>
            </div>

            <!-- content-wrapper ends -->
        <?php $this->load->view('partials/_footer'); ?>