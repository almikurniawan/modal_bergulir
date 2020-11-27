<div class="row">
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_member_id']['class'] ?>"><?= $field['peng_member_id']['title'] ?></label>
        <?= $field['peng_member_id']['field'] ?>
    </div>
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_tanggal']['class'] ?>"><?= $field['peng_tanggal']['title'] ?></label>
        <?= $field['peng_tanggal']['field'] ?>
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-12">
        <label class="<?= $field['peng_nominal']['class'] ?>"><?= $field['peng_nominal']['title'] ?></label>
        <?= $field['peng_nominal']['field'] ?>
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_bidang_usaha']['class'] ?>"><?= $field['peng_bidang_usaha']['title'] ?></label>
        <?= $field['peng_bidang_usaha']['field'] ?>
    </div>
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_tujuan_penggunaan']['class'] ?>"><?= $field['peng_tujuan_penggunaan']['title'] ?></label>
        <?= $field['peng_tujuan_penggunaan']['field'] ?>
    </div>
</div>

<div class="row">
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_foto_suami']['class'] ?>"><?= $field['peng_foto_suami']['title'] ?></label>
        <?= $field['peng_foto_suami']['field'] ?>
    </div>
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_foto_istri']['class'] ?>"><?= $field['peng_foto_istri']['title'] ?></label>
        <?= $field['peng_foto_istri']['field'] ?>
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_fc_ktp']['class'] ?>"><?= $field['peng_fc_ktp']['title'] ?></label>
        <?= $field['peng_fc_ktp']['field'] ?>
    </div>
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_fc_kk']['class'] ?>"><?= $field['peng_fc_kk']['title'] ?></label>
        <?= $field['peng_fc_kk']['field'] ?>
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_fc_surat_nikah']['class'] ?>"><?= $field['peng_fc_surat_nikah']['title'] ?></label>
        <?= $field['peng_fc_surat_nikah']['field'] ?>
    </div>
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_fc_legalitas_jaminan']['class'] ?>"><?= $field['peng_fc_legalitas_jaminan']['title'] ?></label>
        <?= $field['peng_fc_legalitas_jaminan']['field'] ?>
    </div>
</div>
<?= $submit_btn . $cancel_btn ?>
<script type="text/javascript">
    function cancel_filter() {
        <?= $cancel_action ?>
    }
</script>