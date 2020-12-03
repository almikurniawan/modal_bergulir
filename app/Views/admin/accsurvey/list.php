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
                        <button onclick="start_survey();" class="btn btn-primary btn-raised float-right">Survey</button>
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
    function start_survey() {
        let peng_id = [];
        $(':checkbox:checked').each(function(i) {
            peng_id.push($(this).val());
        });
        if(peng_id.length>0){
            window.location.href= '<?= base_url('admin/survey/proses') ?>' + '?id=' + peng_id;
        }else{
            kendo.alert("Silahkan Pilih Pengajuan yang ingin di survey");
        }
    }
</script>
<?= $this->endSection() ?>