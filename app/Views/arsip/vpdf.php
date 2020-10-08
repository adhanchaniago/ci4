<div class="row">
    <div class="col-sm-12">
        <table class="table table-bordered">
            <tr>
                <th width="100px">No. Arsip</th>
                <th width="30px">:</th>
                <td><?= $arsip['no_arsip'] ?></td>
                <th width="120px">Tanggal Upload</th>
                <th width="30px">:</th>
                <td><?= $arsip['tgl_upload'] ?></td>
            </tr>
            <tr>
                <th>Nama Arsip</th>
                <th>:</th>
                <td><?= $arsip['nama_arsip'] ?></td>
                <th>Diperbaharui</th>
                <th>:</th>
                <td><?= $arsip['tgl_update'] ?></td>
            </tr>
            <tr>
                <th>Deskripsi</th>
                <th>:</th>
                <td><?= $arsip['deskripsi'] ?></td>
                <th>Size</th>
                <th>:</th>
                <td><?= $arsip['ukuran_file'] ?></td>
            </tr>
            <tr>
                <th>User</th>
                <th>:</th>
                <td><?= $arsip['username'] ?></td>
                <th>Jabatan</th>
                <th>:</th>
                <td><?= $arsip['nama_departemen'] ?></td>
            </tr>
        </table>
    </div>
    <div class="col-sm-12">
        <iframe src="
        <?= base_url('dokumen/' . $arsip['file_arsip']) ?>" style="border:none;" height="1180px" width="100%" title="Iframe Example">
        </iframe>
    </div>
</div>