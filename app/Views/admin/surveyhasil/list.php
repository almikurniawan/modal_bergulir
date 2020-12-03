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

    function surveyHasil_kunci(id) {
        kendo.confirm("Yakin ingin mengunci data ini?").then(function() {
            $.post("<?= $url_kunci ?>", {
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

    function surveyHasil_buka_kunci(id) {
        kendo.confirm("Yakin ingin buka kunci data ini?").then(function() {
            $.post("<?= $url_buka_kunci ?>", {
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
</script>
<?= $this->endSection() ?>