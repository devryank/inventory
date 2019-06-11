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
              <a href="<?php echo site_url('dashboard/user'); ?>" class="btn btn-primary">Kembali</a>
              </ul>
            </nav>
          </div>
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                <?php echo form_open_multipart('dashboard/add_year');?>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama</label>
                        <input type="number" name="nama_tahun" class="form-control" placeholder="Tahun">
                        <?php echo form_error('nama_tahun', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                  </form>
                </div>
              </div>
            </div>

            <!-- content-wrapper ends -->
        <?php $this->load->view('partials/_footer'); ?>