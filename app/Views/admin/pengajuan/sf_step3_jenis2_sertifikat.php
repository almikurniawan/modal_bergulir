<h5>Yang Bertanda Tangan</h5>
<div class="row">
    <div class="form-group col-sm-6">
        <label class="<?= $field['jam_pemegang_ktp_no']['class'] ?>"><?= $field['jam_pemegang_ktp_no']['title'] ?></label>
        <?= $field['jam_pemegang_ktp_no']['field'] ?>
    </div>
    <div class="form-group col-sm-6">
        <label class="<?= $field['jam_pekerjaan']['class'] ?>"><?= $field['jam_pekerjaan']['title'] ?></label>
        <?= $field['jam_pekerjaan']['field'] ?>
    </div>
</div>
<h5>Sertifikat Tanah</h5>
<hr/>
<div class="row">
    <div class="form-group col-sm-12">
        <?= $field['jam_jenis']['field'] ?>
        <label class="<?= $field['jam_jenis_kepemilikan']['class'] ?>"><?= $field['jam_jenis_kepemilikan']['title'] ?></label>
        <?= $field['jam_jenis_kepemilikan']['field'] ?>
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-6">
        <label class="<?= $field['jam_no_akta']['class'] ?>"><?= $field['jam_no_akta']['title'] ?></label>
        <?= $field['jam_no_akta']['field'] ?>
    </div>
    <div class="form-group col-sm-6">
        <label class="<?= $field['jam_tempat']['class'] ?>"><?= $field['jam_tempat']['title'] ?></label>
        <?= $field['jam_tempat']['field'] ?>
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-6">
        <label class="<?= $field['jam_su_tanggal']['class'] ?>"><?= $field['jam_su_tanggal']['title'] ?></label>
        <?= $field['jam_su_tanggal']['field'] ?>
    </div>
    <div class="form-group col-sm-6">
        <label class="<?= $field['jam_nomor_surat_ukur']['class'] ?>"><?= $field['jam_nomor_surat_ukur']['title'] ?></label>
        <?= $field['jam_nomor_surat_ukur']['field'] ?>
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-6">
        <label class="<?= $field['jam_luas_tanah']['class'] ?>"><?= $field['jam_luas_tanah']['title'] ?></label>
        <?= $field['jam_luas_tanah']['field'] ?>
    </div>
    <div class="form-group col-sm-6">
        <label class="<?= $field['jam_harga_perkiraan']['class'] ?>"><?= $field['jam_harga_perkiraan']['title'] ?></label>
        <?= $field['jam_harga_perkiraan']['field'] ?>
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-6">
        <label class="<?= $field['jam_harga_perkiraan_total']['class'] ?>"><?= $field['jam_harga_perkiraan_total']['title'] ?></label>
        <?= $field['jam_harga_perkiraan_total']['field'] ?>
    </div>
    <div class="form-group col-sm-6">
        <label class="<?= $field['jam_atas_nama_tanah']['class'] ?>"><?= $field['jam_atas_nama_tanah']['title'] ?></label>
        <?= $field['jam_atas_nama_tanah']['field'] ?>
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-12">
        <label class="<?= $field['jam_alamat_tanah']['class'] ?>"><?= $field['jam_alamat_tanah']['title'] ?></label>
        <?= $field['jam_alamat_tanah']['field'] ?>
    </div>
</div>
<?= $submit_btn . $cancel_btn ?>