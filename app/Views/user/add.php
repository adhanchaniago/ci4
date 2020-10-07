<div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-8">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Add User</h3>
            </div>
            <div class="box-body">

                <?php
                $errors = session()->getFlashdata('errors');
                if (!empty($errors)) { ?>
                    <div class="alert alert-danger alert-dismissible">
                        <ul>
                            <?php foreach ($errors as $key => $value) { ?>
                                <li><?= esc($value)  ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
                <?php echo form_open_multipart('user/insert'); ?>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label>Nama User</label>
                        <input name="username" class="form-control" placeholder="Enter nama user" required>
                    </div>
                    <div class="col-md-6">
                        <label>Email</label>
                        <input name="email" type="email" class="form-control" placeholder="Enter email user" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label>Password</label>
                        <input name="password" class="form-control" placeholder="Enter password user" required>
                    </div>
                    <div class="col-md-6">
                        <label>Status</label>
                        <select name="level" class="form-control">
                            <option value="">--Status user--</option>
                            <option value="1">Admin</option>
                            <option value="2">User</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label>Departemen</label>
                        <select name="id_departemen" class="form-control">
                            <option value="">--Pilih Departemen--</option>
                            <?php foreach ($departemen as $key => $value) { ?>
                                <option value="<?= $value['id_departemen'] ?>"><?= $value['nama_departemen'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Foto</label>
                        <input type="file" name="foto" class="form-control">
                    </div>
                </div>
                <div class="box-footer">
                    <a href="<?= base_url('user') ?>" class="btn btn-primary">Kembali</a>
                    <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                </div>
                <?php echo form_close() ?>

            </div>
        </div>
    </div>
    <div class="col-md-2">
    </div>
</div>