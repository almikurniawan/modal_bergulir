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

<!-- <h5 class="mt-3">1. Tanah</h5>
<hr/>
<div class="row">
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_sk_tanah_luas']['class'] ?>"><?= $field['peng_sk_tanah_luas']['title'] ?></label>
        <?= $field['peng_sk_tanah_luas']['field'] ?>
    </div>
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_sk_tanah_desa']['class'] ?>"><?= $field['peng_sk_tanah_desa']['title'] ?></label>
        <?= $field['peng_sk_tanah_desa']['field'] ?>
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_sk_tanah_kecamatan']['class'] ?>"><?= $field['peng_sk_tanah_kecamatan']['title'] ?></label>
        <?= $field['peng_sk_tanah_kecamatan']['field'] ?>
    </div>
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_sk_tanah_no_shm']['class'] ?>"><?= $field['peng_sk_tanah_no_shm']['title'] ?></label>
        <?= $field['peng_sk_tanah_no_shm']['field'] ?>
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_sk_tanah_tanggal_shm']['class'] ?>"><?= $field['peng_sk_tanah_tanggal_shm']['title'] ?></label>
        <?= $field['peng_sk_tanah_tanggal_shm']['field'] ?>
    </div>
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_sk_tanah_atas_nama']['class'] ?>"><?= $field['peng_sk_tanah_atas_nama']['title'] ?></label>
        <?= $field['peng_sk_tanah_atas_nama']['field'] ?>
    </div>
</div>

<h5 class="mt-3">2. Harga</h5>
<hr/>
<div class="row">
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_sk_tanah_harga_ru']['class'] ?>"><?= $field['peng_sk_tanah_harga_ru']['title'] ?></label>
        <?= $field['peng_sk_tanah_harga_ru']['field'] ?>
    </div>
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_sk_tanah_harga_meter']['class'] ?>"><?= $field['peng_sk_tanah_harga_meter']['title'] ?></label>
        <?= $field['peng_sk_tanah_harga_meter']['field'] ?>
    </div>
</div>

<h5 class="mt-3">3. Bangunan</h5>
<hr/>
<div class="row">
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_sk_tanah_luas_bangunan']['class'] ?>"><?= $field['peng_sk_tanah_luas_bangunan']['title'] ?></label>
        <?= $field['peng_sk_tanah_luas_bangunan']['field'] ?>
    </div>
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_sk_tanah_harga_bangunan']['class'] ?>"><?= $field['peng_sk_tanah_harga_bangunan']['title'] ?></label>
        <?= $field['peng_sk_tanah_harga_bangunan']['field'] ?>
    </div>
</div>

<h5 class="mt-3">3. Letak</h5>
<hr/>
<div class="row">
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_sk_tanah_letak_utara']['class'] ?>"><?= $field['peng_sk_tanah_letak_utara']['title'] ?></label>
        <?= $field['peng_sk_tanah_letak_utara']['field'] ?>
    </div>
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_sk_tanah_letak_selatan']['class'] ?>"><?= $field['peng_sk_tanah_letak_selatan']['title'] ?></label>
        <?= $field['peng_sk_tanah_letak_selatan']['field'] ?>
    </div>
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_sk_tanah_letak_timur']['class'] ?>"><?= $field['peng_sk_tanah_letak_timur']['title'] ?></label>
        <?= $field['peng_sk_tanah_letak_timur']['field'] ?>
    </div>
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_sk_tanah_letak_barat']['class'] ?>"><?= $field['peng_sk_tanah_letak_barat']['title'] ?></label>
        <?= $field['peng_sk_tanah_letak_barat']['field'] ?>
    </div>
</div>

<h5 class="mt-3">3. Penggunaan Saat ini</h5>
<hr/>
<div class="row">
    <div class="form-group col-sm-12">
        <label class="<?= $field['peng_sk_tanah_penggunaan']['class'] ?>"><?= $field['peng_sk_tanah_penggunaan']['title'] ?></label>
        <?= $field['peng_sk_tanah_penggunaan']['field'] ?>
    </div>
</div> -->
<?= $submit_btn . $cancel_btn ?>
<script type="text/javascript">
    function cancel_filter() {
        <?= $cancel_action ?>
    }
</script>