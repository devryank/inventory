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
                <?php echo form_open_multipart('dashboard/add');?>
                <input type="hidden" value="<?php echo $user['name'] ?>" name="penerima">

                    <div class="form-group">
                      <label for="NamaBarang">Nama Barang</label>
                      <input type="text" class="form-control" id="nama_barang" placeholder="Nama Barang" name="nama_barang">
                      <?php echo form_error('nama_barang', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <div class="form-group">
                      <label>File upload</label>
                      <input type="file" name="img[]" class="file-upload-default">
                      <div class="input-group col-xs-12">
                        <input type="file" class="custom-file-input" id="image" name="foto_barang">
                        <label class="custom-file-label" for="image"></label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="Produsen">Produsen</label>
                      <input type="text" class="form-control" id="Produsen" placeholder="Produsen" name="produsen">
                      <?php echo form_error('produsen', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <div class="form-group">
                      <label for="Unit">Unit</label>
                      <input type="number" class="form-control" id="Unit" placeholder="Unit" name="unit">
                      <?php echo form_error('unit', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <div class="form-group">
                      <label for="Modal">Modal</label>
                      <input type="number" class="form-control" id="Modal" placeholder="Modal" name="modal">
                      <?php echo form_error('modal', '<small class="text-danger pl-3">', '</small>');?>
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
                    <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                  </form>
                </div>
              </div>
            </div>

            <!-- content-wrapper ends -->
        <?php $this->load->view('partials/_footer'); ?>