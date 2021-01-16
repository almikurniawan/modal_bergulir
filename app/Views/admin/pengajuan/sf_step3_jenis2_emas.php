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
<h5>Emas</h5>
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
        <label class="<?= $field['jam_emas_karat']['class'] ?>"><?= $field['jam_emas_karat']['title'] ?></label>
        <?= $field['jam_emas_karat']['field'] ?>
    </div>
    <div class="form-group col-sm-6">
        <label class="<?= $field['jam_emas_gram']['class'] ?>"><?= $field['jam_emas_gram']['title'] ?></label>
        <?= $field['jam_emas_gram']['field'] ?>
    </div>
</div>
<?= $submit_btn . $cancel_btn ?>