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
<h5>BPKB</h5>
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
        <label class="<?= $field['jam_tahun_pembuatan']['class'] ?>"><?= $field['jam_tahun_pembuatan']['title'] ?></label>
        <?= $field['jam_tahun_pembuatan']['field'] ?>
    </div>
    <div class="form-group col-sm-6">
        <label class="<?= $field['jam_nopol']['class'] ?>"><?= $field['jam_nopol']['title'] ?></label>
        <?= $field['jam_nopol']['field'] ?>
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-6">
        <label class="<?= $field['jam_type_bpkb']['class'] ?>"><?= $field['jam_type_bpkb']['title'] ?></label>
        <?= $field['jam_type_bpkb']['field'] ?>
    </div>
    <div class="form-group col-sm-6">
        <label class="<?= $field['jam_nopol']['class'] ?>"><?= $field['jam_nopol']['title'] ?></label>
        <?= $field['jam_nopol']['field'] ?>
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-6">
        <label class="<?= $field['jam_mesin']['class'] ?>"><?= $field['jam_mesin']['title'] ?></label>
        <?= $field['jam_mesin']['field'] ?>
    </div>
    <div class="form-group col-sm-6">
        <label class="<?= $field['jam_rangka']['class'] ?>"><?= $field['jam_rangka']['title'] ?></label>
        <?= $field['jam_rangka']['field'] ?>
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-6">
        <label class="<?= $field['jam_atas_nama']['class'] ?>"><?= $field['jam_atas_nama']['title'] ?></label>
        <?= $field['jam_atas_nama']['field'] ?>
    </div>
    <div class="form-group col-sm-6">
        <label class="<?= $field['jam_alamat']['class'] ?>"><?= $field['jam_alamat']['title'] ?></label>
        <?= $field['jam_alamat']['field'] ?>
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-6">
        <label class="<?= $field['jam_no_bpkb']['class'] ?>"><?= $field['jam_no_bpkb']['title'] ?></label>
        <?= $field['jam_no_bpkb']['field'] ?>
    </div>
    
</div>
<?= $submit_btn . $cancel_btn ?>