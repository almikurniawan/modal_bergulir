<?php
$uri = service('uri');
?>
<h5>Surat Keterangan</h5>
<hr/>
<div class="row">
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_sk_kepala_kelurahan']['class'] ?>"><?= $field['peng_sk_kepala_kelurahan']['title'] ?></label>
        <?= $field['peng_sk_kepala_kelurahan']['field'] ?>
    </div>
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_sk_kecamatan']['class'] ?>"><?= $field['peng_sk_kecamatan']['title'] ?></label>
        <?= $field['peng_sk_kecamatan']['field'] ?>
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_sk_kota']['class'] ?>"><?= $field['peng_sk_kota']['title'] ?></label>
        <?= $field['peng_sk_kota']['field'] ?>
    </div>
</div>
<?= $submit_btn . $cancel_btn ?>
<script type="text/javascript">
    function cancel_filter() {
        <?= $cancel_action ?>
    }
</script>