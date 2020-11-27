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
    function verifikasi(id) {
        kendo.confirm("Yakin ingin verifikasi dokumen ini?").then(function() {
            $.post("<?= base_url("admin/verifikasi/approve");?>",{
                'id' : id
            },function(res){
                if(res.status)
                    gridReload();
                else
                    kendo.alert("Terjadi Kesalaha.");
            },'json');
        }, function() {
        });
    }

    function reject(id) {
        kendo.prompt("Masukan Catatan", "").then(function (data) {
            $.post("<?= base_url("admin/verifikasi/reject");?>",{
                'id' : id,
                'catatan' : data
            },function(res){
                if(res.status)
                    gridReload();
                else
                    kendo.alert("Terjadi Kesalaha.");
            },'json');
        }, function () {
        })
    }

    function view(id){
        
    }
</script>
<?= $this->endSection() ?>