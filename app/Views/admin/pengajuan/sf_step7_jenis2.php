<?php
$uri = service('uri');
?>
<h5>Surat Pernyataan</h5>
<hr />
<div class="row">
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_srt_nama']['class'] ?>"><?= $field['peng_srt_nama']['title'] ?></label>
        <?= $field['peng_srt_nama']['field'] ?>
    </div>
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_srt_pekerjaan']['class'] ?>"><?= $field['peng_srt_pekerjaan']['title'] ?></label>
        <?= $field['peng_srt_pekerjaan']['field'] ?>
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_srt_nama_usaha']['class'] ?>"><?= $field['peng_srt_nama_usaha']['title'] ?></label>
        <?= $field['peng_srt_nama_usaha']['field'] ?>
    </div>
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_srt_jenis_usaha']['class'] ?>"><?= $field['peng_srt_jenis_usaha']['title'] ?></label>
        <?= $field['peng_srt_jenis_usaha']['field'] ?>
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_srt_alamat']['class'] ?>"><?= $field['peng_srt_alamat']['title'] ?></label>
        <?= $field['peng_srt_alamat']['field'] ?>
    </div>
</div>
<h5>Rencana Penggunaan</h5>
<hr />
<div class="row">
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_srt_jumlah_pinjaman']['class'] ?>"><?= $field['peng_srt_jumlah_pinjaman']['title'] ?></label>
        <?= $field['peng_srt_jumlah_pinjaman']['field'] ?>
    </div>
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_srt_modal_kerja']['class'] ?>"><?= $field['peng_srt_modal_kerja']['title'] ?></label>
        <?= $field['peng_srt_modal_kerja']['field'] ?>
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_srt_investasi']['class'] ?>"><?= $field['peng_srt_investasi']['title'] ?></label>
        <?= $field['peng_srt_investasi']['field'] ?>
    </div>
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_srt_pengambilan_waktu']['class'] ?>"><?= $field['peng_srt_pengambilan_waktu']['title'] ?></label>
        <?= $field['peng_srt_pengambilan_waktu']['field'] ?>
    </div>

</div>
<div class="row">
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_srt_bunga']['class'] ?>"><?= $field['peng_srt_bunga']['title'] ?></label>
        <?= $field['peng_srt_bunga']['field'] ?>
    </div>
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_srt_omset_penjualan_pokok']['class'] ?>"><?= $field['peng_srt_omset_penjualan_pokok']['title'] ?></label>
        <?= $field['peng_srt_omset_penjualan_pokok']['field'] ?>
    </div>

</div>
<div class="row">
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_srt_pendapatan_lain']['class'] ?>"><?= $field['peng_srt_pendapatan_lain']['title'] ?></label>
        <?= $field['peng_srt_pendapatan_lain']['field'] ?>
    </div>
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_srt_harga_pokok_penjualan']['class'] ?>"><?= $field['peng_srt_harga_pokok_penjualan']['title'] ?></label>
        <?= $field['peng_srt_harga_pokok_penjualan']['field'] ?>
    </div>

</div>
<div class="row">
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_srt_beban_bunga']['class'] ?>"><?= $field['peng_srt_beban_bunga']['title'] ?></label>
        <?= $field['peng_srt_beban_bunga']['field'] ?>
    </div>
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_srt_beban_usaha']['class'] ?>"><?= $field['peng_srt_beban_usaha']['title'] ?></label>
        <?= $field['peng_srt_beban_usaha']['field'] ?>
    </div>

</div>
<div class="row">
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_srt_beban_non_usaha']['class'] ?>"><?= $field['peng_srt_beban_non_usaha']['title'] ?></label>
        <?= $field['peng_srt_beban_non_usaha']['field'] ?>
    </div>
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_srt_laba']['class'] ?>"><?= $field['peng_srt_laba']['title'] ?></label>
        <?= $field['peng_srt_laba']['field'] ?>
    </div>
</div>
<?= $submit_btn . $cancel_btn ?> <?= ($data['peng_lock_is']=='t' ? '' : '<a class="btn btn-success btn-raised float-right" href="'.base_url("admin/pengajuan/lock/".$uri->getSegment(4)).'"><i class="k-icon k-i-lock"></i> Kunci Pengajuan</a>')?>
<script type="text/javascript">
    function cancel_filter() {
        <?= $cancel_action ?>
    }
</script>