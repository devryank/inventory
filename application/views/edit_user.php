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
                <?php foreach ($edit as $e): ?>
                <?php echo form_open_multipart('dashboard/edit_user/'.$e->id);?>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama</label>
                        <input type="text" name="name" class="form-control" id="exampleInputName1" placeholder="Nama" value="<?php echo $e->name; ?>">
                        <?php echo form_error('name', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email" value="<?php echo $e->email; ?>">
                        <?php echo form_error('email', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        <?php echo form_error('password', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputSelect1">Level</label>
                        <select name="level" class="form-control">
                            <option value="1" <?php if($e->level == 1){echo "selected='selected'";}?>>Administrator</option>
                            <option value="2" <?php if($e->level == 2){echo "selected='selected'";}?>>Seller</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                </form>
                <?php endforeach;?>
                </div>
              </div>
            </div>

            <!-- content-wrapper ends -->
        <?php $this->load->view('partials/_footer'); ?>