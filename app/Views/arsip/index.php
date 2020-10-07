<div class="row">
    <div class="col-md-12">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Data Arsip</h3>

                <div class="box-tools pull-right">
                    <a href="<?= base_url('arsip/add') ?>" class="btn btn-info btn-sm btn-flat"><i class="fa fa-plus"></i> Arsip Baru</a>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <?php
                if (session()->getFlashdata('pesan')) {
                    echo '<div class="alert alert-success alert-dismissible">';
                    echo session()->getFlashdata('pesan');
                    echo '</div>';
                }
                ?>
                <table class="table table-bordered table-hover" id="example1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No. Arsip</th>
                            <th>Nama Arsip</th>
                            <th>Kategori</th>
                            <th>Uploaded</th>
                            <th>Updated</th>
                            <th>User</th>
                            <th>Departemen</th>
                            <th>File</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($arsip as $key => $value) { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $value['no_arsip']; ?></td>
                                <td><?= $value['nama_arsip']; ?></td>
                                <td><?= $value['nama_kategori']; ?></td>
                                <td><?= $value['tgl_upload']; ?></td>
                                <td><?= $value['tgl_update']; ?></td>
                                <td><?= $value['username']; ?></td>
                                <td><?= $value['nama_departemen']; ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('arsip/pdf/' . $value['id_arsip']) ?>">
                                        <i class="fa fa-file-pdf-o fa-2x label-danger"></i></a><br>
                                    <?= number_format($value['ukuran_file'], 0); ?> Byte
                                </td>
                                <td>
                                    <a href="<?= base_url('arsip/edit/' . $value['id_arsip']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete<?= $value['id_arsip']; ?>">Hapus</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div> <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>

<!-- /.modal Delete-->
<?php foreach ($arsip as $key => $value) { ?>
    <div class="modal fade" id="delete<?= $value['id_user']; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Hapus User</h4>
                </div>
                <div class="modal-body">
                    <h4>Yakin ingin menghapus <b><?= $value['nama_arsip']; ?></b>...?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Kembali</button>
                    <a href="<?= base_url('arsip/delete/' . $value['id_arsip']) ?>" type="submit" class="btn btn-warning">Confirm</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php } ?>
<!-- /.End modal Delete-->