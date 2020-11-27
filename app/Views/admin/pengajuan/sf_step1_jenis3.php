<div class="row">
    <div class="form-group col-sm-4">
        <label class="<?= $field['peng_member_id']['class'] ?>"><?= $field['peng_member_id']['title'] ?></label>
        <?= $field['peng_member_id']['field'] ?>
    </div>
    <div class="form-group col-sm-4">
        <label class="<?= $field['peng_tanggal']['class'] ?>"><?= $field['peng_tanggal']['title'] ?></label>
        <?= $field['peng_tanggal']['field'] ?>
    </div>
    <div class="form-group col-sm-4">
        <label class="<?= $field['peng_tempat']['class'] ?>"><?= $field['peng_tempat']['title'] ?></label>
        <?= $field['peng_tempat']['field'] ?>
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
        <label class="<?= $field['peng_susunan_pengurus']['class'] ?>"><?= $field['peng_susunan_pengurus']['title'] ?></label>
        <?= $field['peng_susunan_pengurus']['field'] ?>
    </div>
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_fc_akta_pendirian']['class'] ?>"><?= $field['peng_fc_akta_pendirian']['title'] ?></label>
        <?= $field['peng_fc_akta_pendirian']['field'] ?>
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_fc_buku_laporan_rapat']['class'] ?>"><?= $field['peng_fc_buku_laporan_rapat']['title'] ?></label>
        <?= $field['peng_fc_buku_laporan_rapat']['field'] ?>
    </div>
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_fc_jaminan']['class'] ?>"><?= $field['peng_fc_jaminan']['title'] ?></label>
        <?= $field['peng_fc_jaminan']['field'] ?>
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_fc_ktp_pengurus']['class'] ?>"><?= $field['peng_fc_ktp_pengurus']['title'] ?></label>
        <?= $field['peng_fc_ktp_pengurus']['field'] ?>
    </div>
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_fc_ktp_pengawas']['class'] ?>"><?= $field['peng_fc_ktp_pengawas']['title'] ?></label>
        <?= $field['peng_fc_ktp_pengawas']['field'] ?>
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_fc_siup']['class'] ?>"><?= $field['peng_fc_siup']['title'] ?></label>
        <?= $field['peng_fc_siup']['field'] ?>
    </div>
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_fc_tdp']['class'] ?>"><?= $field['peng_fc_tdp']['title'] ?></label>
        <?= $field['peng_fc_tdp']['field'] ?>
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_fc_npwp']['class'] ?>"><?= $field['peng_fc_npwp']['title'] ?></label>
        <?= $field['peng_fc_npwp']['field'] ?>
    </div>
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_fc_sertifikat_penilaian']['class'] ?>"><?= $field['peng_fc_sertifikat_penilaian']['title'] ?></label>
        <?= $field['peng_fc_sertifikat_penilaian']['field'] ?>
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_foto_pengurus']['class'] ?>"><?= $field['peng_foto_pengurus']['title'] ?></label>
        <?= $field['peng_foto_pengurus']['field'] ?>
    </div>
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_foto_pengawas']['class'] ?>"><?= $field['peng_foto_pengawas']['title'] ?></label>
        <?= $field['peng_foto_pengawas']['field'] ?>
    </div>
</div>
<?= $submit_btn . $cancel_btn ?>
<script type="text/javascript">
    function cancel_filter() {
        <?= $cancel_action ?>
    }
</script>