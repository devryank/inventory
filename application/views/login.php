<div class="content-wrapper">
    <div class="col-md-6 mx-auto grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Login</h4>
                <br>
                <?php echo $this->session->flashdata('message'); ?>
                <form action="<?php echo base_url('auth/index'); ?>" class="forms-sample" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                        <?php echo form_error('email', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        <?php echo form_error('password', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                </form>
                <br>
                <a href="<?php echo site_url('auth/registration');?>" style="font-size: 12px;">Buat akun baru</a>
            </div>
        </div>
    </div>
</div>