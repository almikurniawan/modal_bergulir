<?= $this->extend('template/default_popup') ?>
<?= $this->section('title') ?>
<?= $title ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-sm-12">
        <div class="card card-primary">
            <div class="card-body">
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
    function pilih(kar_id) {
        $.post("<?= base_url("admin/survey/proses_add_petugas/".$id) ?>", {
            id: kar_id
        }, function(result) {
            if (result.status) {
                gridReload();
                window.opener.gridReloadPetugas();
            } else {
                kendo.alert(result.message);
            }
        }, 'json');
    }
</script>
<?= $this->endSection() ?>