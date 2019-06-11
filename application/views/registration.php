<div class="content-wrapper">
    <div class="col-md-6 mx-auto grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Registrasi</h4>
                <br>
                <?php echo $this->session->flashdata('message'); ?>
                <form action="<?php echo base_url('auth/registration'); ?>" class="forms-sample" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama</label>
                        <input type="text" name="name" class="form-control" id="exampleInputName1" placeholder="Nama" value="<?php echo set_value('name');?>">
                        <?php echo form_error('name', '<small class="text-danger pl-3">', '</small>');?>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email" value="<?php echo set_value('email');?>">
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
                            <option value="1">Administrator</option>
                            <option value="2">Seller</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                </form>
                <br>
                <a href="<?php echo site_url('/');?>" style="font-size: 12px;">Kembali</a>
            </div>
        </div>
    </div>
</div>