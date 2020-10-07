<div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-8">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Arsip</h3>
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
                <?php
                echo form_open_multipart('arsip/update/' . $arsip['id_arsip']);
                ?>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label>No. Arsip</label>
                        <input name="no_arsip" type="email" class="form-control" value="<?= $arsip['no_arsip'] ?>" readonly>
                    </div>
                    <div class="col-md-6">
                        <label>Nama Arsip</label>
                        <input name="nama_arsip" value="<?= $arsip['nama_arsip'] ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label>Kategori</label>
                        <select name="idkategori" class="form-control">
                            <option value="
                            <?= $arsip['idkategori'] ?>">
                            <?= $arsip['nama_kategori'] ?>
                        </option>
                            <?php foreach ($kategori as $key => $value) { ?>
                                <option value="<?= $value['id_kategori'] ?>"><?= $value['nama_kategori'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Ganti File Arsip</label>
                        <input type="file" name="file_arsip" class="form-control">
                        <label class="text-danger">*Format file .pdf</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="4"><?= $arsip['deskripsi'] ?></textarea>
                </div>
                <div class="box-footer">
                    <a href="<?= base_url('arsip') ?>" class="btn btn-primary">Kembali</a>
                    <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                </div>
                <?php echo form_close() ?>

            </div>
        </div>
    </div>
    <div class="col-md-2">
    </div>
</div>