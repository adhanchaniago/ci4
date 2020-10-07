<div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-8">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Edit User</h3>
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
                <?php echo form_open_multipart('user/update/' . $user['id_user']); ?>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label>Nama User</label>
                        <input name="username" value="<?= $user['username'] ?>" class="form-control" placeholder="Enter nama user" required>
                    </div>
                    <div class="col-md-6">
                        <label>Email</label>
                        <input name="email" value="<?= $user['email'] ?>" type="email" class="form-control" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label>Password</label>
                        <input name="password" value="<?= $user['password'] ?>" class="form-control" placeholder="Enter password user" required>
                    </div>
                    <div class="col-md-6">
                        <label>Status</label>
                        <select name="level" class="form-control">
                            <option value="
                                <?= $user['level'] ?>">
                                <?php if ($user['level'] == 1) {
                                    echo 'Admin';
                                } else {
                                    echo 'User';
                                } ?>
                            </option>
                            <option value="1">Admin</option>
                            <option value="2">User</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label>Departemen</label>
                        <select name="id_departemen" class="form-control">
                            <option value="
                                <?= $user['id_departemen'] ?>">
                                <?= $user['nama_departemen'] ?>
                            </option>
                            <?php foreach ($departemen as $key => $value) { ?>
                                <option value="
                                    <?= $value['id_departemen'] ?>">
                                    <?= $value['nama_departemen'] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label>Ganti Foto</label>
                            <input type="file" name="foto" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <img src="<?= base_url('img/' . $user['foto']) ?>" width="80px">
                        </div>
                    </div>

                </div>
                <div class="box-footer">
                    <a href="<?= base_url('user') ?>" class="btn btn-primary">Kembali</a>
                    <button type="submit" class="btn btn-primary pull-right">Update</button>
                </div>
                <?php echo form_close() ?>

            </div>
        </div>
    </div>
    <div class="col-md-2">
    </div>
</div>