<h5>1. IDENTITAS PERUSAHAAN</h5>
<hr/>
<div class="row">
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_prof_nama_usaha']['class'] ?>"><?= $field['peng_prof_nama_usaha']['title'] ?></label>
        <?= $field['peng_prof_nama_usaha']['field'] ?>
    </div>
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_prof_alamat']['class'] ?>"><?= $field['peng_prof_alamat']['title'] ?></label>
        <?= $field['peng_prof_alamat']['field'] ?>
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_prof_pimpinan']['class'] ?>"><?= $field['peng_prof_pimpinan']['title'] ?></label>
        <?= $field['peng_prof_pimpinan']['field'] ?>
    </div>
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_prof_perizinan']['class'] ?>"><?= $field['peng_prof_perizinan']['title'] ?></label>
        <?= $field['peng_prof_perizinan']['field'] ?>
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_prof_jumlah_karyawan']['class'] ?>"><?= $field['peng_prof_jumlah_karyawan']['title'] ?></label>
        <?= $field['peng_prof_jumlah_karyawan']['field'] ?>
    </div>
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_prof_tahun_mulai']['class'] ?>"><?= $field['peng_prof_tahun_mulai']['title'] ?></label>
        <?= $field['peng_prof_tahun_mulai']['field'] ?>
    </div>
</div>
<h5 class="mt-3">2. USAHA YANG DIKELOLA</h5>
<hr/>
<div class="row">
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_prof_jenis_usaha']['class'] ?>"><?= $field['peng_prof_jenis_usaha']['title'] ?></label>
        <?= $field['peng_prof_jenis_usaha']['field'] ?>
    </div>
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_prof_komoditi_produk']['class'] ?>"><?= $field['peng_prof_komoditi_produk']['title'] ?></label>
        <?= $field['peng_prof_komoditi_produk']['field'] ?>
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_prof_omset_per_bulan']['class'] ?>"><?= $field['peng_prof_omset_per_bulan']['title'] ?></label>
        <?= $field['peng_prof_omset_per_bulan']['field'] ?>
    </div>
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_prof_lokasi_pemasaran']['class'] ?>"><?= $field['peng_prof_lokasi_pemasaran']['title'] ?></label>
        <?= $field['peng_prof_lokasi_pemasaran']['field'] ?>
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_prof_pola_pemasaran']['class'] ?>"><?= $field['peng_prof_pola_pemasaran']['title'] ?></label>
        <?= $field['peng_prof_pola_pemasaran']['field'] ?>
    </div>
</div>

<h5 class="mt-3">3. KINERJA PERUSAHAAN</h5>
<hr/>
<div class="row">
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_prof_pendapatan_penjualan']['class'] ?>"><?= $field['peng_prof_pendapatan_penjualan']['title'] ?></label>
        <?= $field['peng_prof_pendapatan_penjualan']['field'] ?>
    </div>
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_prof_beban_penjualan']['class'] ?>"><?= $field['peng_prof_beban_penjualan']['title'] ?></label>
        <?= $field['peng_prof_beban_penjualan']['field'] ?>
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_prof_laba_per_bulan']['class'] ?>"><?= $field['peng_prof_laba_per_bulan']['title'] ?></label>
        <?= $field['peng_prof_laba_per_bulan']['field'] ?>
    </div>
</div>

<h5 class="mt-3">4. PERMODALAN</h5>
<hr/>
<div class="row">
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_prof_modal_sendiri']['class'] ?>"><?= $field['peng_prof_modal_sendiri']['title'] ?></label>
        <?= $field['peng_prof_modal_sendiri']['field'] ?>
    </div>
    <div class="form-group col-sm-6">
        <label class="<?= $field['peng_prof_modal_luar']['class'] ?>"><?= $field['peng_prof_modal_luar']['title'] ?></label>
        <?= $field['peng_prof_modal_luar']['field'] ?>
    </div>
</div>
<?= $submit_btn . $cancel_btn ?>
<script type="text/javascript">
    function cancel_filter() {
        <?= $cancel_action ?>
    }
</script>