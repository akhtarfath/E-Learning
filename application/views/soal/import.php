<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"><?= $subjudul ?></h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <ul class="alert alert-info" style="padding-left: 40px">
            <li>Silahkan import data dari excel, menggunakan format yang sudah disediakan</li>
            <li>Data tidak boleh ada yang kosong, harus terisi semua.</li>
			<li>Untuk data Dosen, hanya bisa diisi menggunakan ID DOsen. <a data-toggle="modal" href="#dosenId" style="text-decoration:none" class="btn btn-xs btn-primary">Lihat ID</a>.</li>
        </ul>
        <div class="text-center">
            <a href="<?= base_url('uploads/import/format/soal.xlsx') ?>" class="btn-default btn">Download Format</a>
        </div>
        <br>
        <div class="row">
            <?= form_open_multipart('soal/preview'); ?>
            <label for="file" class="col-sm-offset-1 col-sm-3 text-right">Pilih File</label>
            <div class="col-sm-4">
                <div class="form-group">
                    <input type="file" name="upload_file">
                </div>
            </div>
            <div class="col-sm-3">
                <button name="preview" type="submit" class="btn btn-sm btn-success">Preview</button>
            </div>
            <?= form_close(); ?>
            <div class="col-sm-6 col-sm-offset-3">
                <?php if (isset($_POST['preview'])) : ?>
                    <br>
                    <h4>Preview Data</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td>No</td>
								<td>Soal</td>
                                <td>Opsi A</td>
                                <td>Opsi B</td>
								<td>Opsi C</td>
								<td>Opsi D</td>
								<td>Opsi E</td>
								<td>Jawaban</td>
								<td>Bobot</td>
                                <td>Dosen_Id</td>
                                <td>Matkul_ID</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $status = true;
                                if (empty($import)) {
                                    echo '<tr><td colspan="2" class="text-center">Data kosong! pastikan anda menggunakan format yang telah disediakan.</td></tr>';
                                } else {
                                    $no = 1;
                                    foreach ($import as $data) :
                                        ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td class="<?= $data['soal'] == null ? 'bg-danger' : ''; ?>">
                                            <?= $data['soal'] == null ? 'BELUM DIISI' : $data['soal']; ?>
                                        </td>
                                        <td class="<?= $data['opsi_a'] == null ? 'bg-danger' : ''; ?>">
                                            <?= $data['opsi_a'] == null ? 'BELUM DIISI' : $data['opsi_a'];; ?>
                                        </td>
                                        <td class="<?= $data['opsi_b'] == null ? 'bg-danger' : ''; ?>">
                                            <?= $data['opsi_b'] == null ? 'BELUM DIISI' : $data['opsi_b'];; ?>
                                        </td>
                                        <td class="<?= $data['opsi_c'] == null ? 'bg-danger' : ''; ?>">
                                            <?= $data['opsi_c'] == null ? 'BELUM DIISI' : $data['opsi_c'];; ?>
                                        </td>
										<td class="<?= $data['opsi_d'] == null ? 'bg-danger' : ''; ?>">
                                            <?= $data['opsi_d'] == null ? 'BELUM DIISI' : $data['opsi_d'];; ?>
                                        </td>
										<td class="<?= $data['opsi_e'] == null ? 'bg-danger' : ''; ?>">
                                            <?= $data['opsi_e'] == null ? 'BELUM DIISI' : $data['opsi_e'];; ?>
                                        </td>
										<td class="<?= $data['jawaban'] == null ? 'bg-danger' : ''; ?>">
                                            <?= $data['jawaban'] == null ? 'BELUM DIISI' : $data['jawaban'];; ?>
                                        </td>
										<td class="<?= $data['bobot'] == null ? 'bg-danger' : ''; ?>">
                                            <?= $data['bobot'] == null ? 'BELUM DIISI' : $data['bobot'];; ?>
                                        </td>
                                        <td class="<?= $data['dosen_id'] == null ? 'bg-danger' : ''; ?>">
                                            <?= $data['dosen_id'] == null ? 'BELUM DIISI' : $data['dosen_id'];; ?>
                                        </td>
										<td class="<?= $data['matkul_id'] == null ? 'bg-danger' : ''; ?>">
                                            <?= $data['matkul_id'] == null ? 'BELUM DIISI' : $data['matkul_id'];; ?>
                                        </td>
                                    </tr>
                            <?php
                                        if ($data['soal'] == null || $data['opsi_a'] == null || $data['opsi_b'] == null || $data['opsi_c'] == null || $data['opsi_d'] == null || $data['opsi_e'] == null || $data['jawaban'] == null || $data['bobot'] == null || $data['dosen_id'] == null || $data['matkul_id'] == null) {
                                            $status = false;
                                        }
                                    endforeach;
                                }
                                ?>
                        </tbody>
                    </table>
                    <?php if ($status) : ?>

                        <?= form_open('soal/do_import', null, ['data' => json_encode($import)]); ?>
                        <button type='submit' class='btn btn-block btn-flat bg-purple'>Import</button>
                        <?= form_close(); ?>

                    <?php endif; ?>
                    <br>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="dosenId">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Data Dosen</h4>
            </div>
            <div class="modal-body">
                <table id="dosen" class="table table-bordered table-condensed table-striped">
                    <thead>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Matkul_id</th>
                    </thead>
                    <tbody>
                        <?php foreach ($dosen as $k) : ?>
                            <tr>
                                <td><?= $k->id_dosen; ?></td>
                                <td><?= $k->nama_dosen; ?></td>
                                <td><?= $k->matkul_id; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        let table;
        table = $("#dosen").DataTable({
            "lengthMenu": [
                [5, 10, 25, 50, 100, -1],
                [5, 10, 25, 50, 100, "All"]
            ],
        });
    });
</script>