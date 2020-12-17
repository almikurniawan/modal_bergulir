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

                <?= $search . $grid ?>
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

    function upload_cetak(id) {
        showForm(1000, 600, '_newpop', '<?= base_url('admin/pengajuan/upload_cetakan') ?>/' + id);
    }
    function lihat_cetak(id) {
        showForm(1000, 600, '_newpop', '<?= base_url('admin/pengajuan/lihat_cetakan') ?>/' + id);
    }
</script>
<?= $this->endSection() ?>