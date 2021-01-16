<?php
$uri = service('uri');
?>
<h5>Surat Keterangan</h5>
<hr/>
<div class="row">
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_uji_kel_no_ktp']['class'] ?>"><?= $field['peng_uji_kel_no_ktp']['title'] ?></label>
        <?= $field['peng_uji_kel_no_ktp']['field'] ?>
    </div>
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_uji_kel_pekerjaan']['class'] ?>"><?= $field['peng_uji_kel_pekerjaan']['title'] ?></label>
        <?= $field['peng_uji_kel_pekerjaan']['field'] ?>
    </div>
</div>
<?= $submit_btn . $cancel_btn ?> <a href="<?= base_url("admin/pengajuan/lock/".$uri->getSegment(4))?>" class="btn btn-success btn-raised float-right"><i class="k-icon k-i-lock"></i> Kunci Pengajuan</a>
<script type="text/javascript">
    function cancel_filter() {
        <?= $cancel_action ?>
    }
</script>