<?= $this->extend('template/default') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-sm-12">
        <div class="card card-primary">
            <div class="card-body">
                <h1 class="card-title mb-4">
                    <?= $title ?>
                </h1>
                <hr />
                <div class="row">
                    <div class="col-lg-12">
                        <?= $search ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <button onclick="importPembayran();" class="btn btn-primary btn-raised float-right">Import Excell Pembayaran</button>
                        <a href="<?=base_url()?>/templateExcellPembayaran.xlsx" class="btn btn-success btn-raised float-right" download>Template Excell Pembayaran</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <?= $grid ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function _delete(id) {
        kendo.confirm("Yakin ingin delete data ini?").then(function() {
            $.post("<?= $url_delete ?>", {
                id: id
            }, function(result) {
                if (result.status) {
                    kendo.alert(result.message);
                    gridReload();
                } else {
                    kendo.alert(result.message);
                }
            }, 'json');
        }, function() {});
    }
    function importPembayran(params) {
        showForm(750, 500, '_newFormUpload', "<?=base_url('admin/pembayaran/importPembayran')?>");

    }
</script>
<?= $this->endSection() ?>