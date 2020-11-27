<?= $this->extend('template/default') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-sm-12">
        <div class="card card-primary">
            <div class="card-body">
                <h1 class="card-title mb-4">
                    <?= $title ?>
                    <a class="btn btn-warning btn-xs btn-raised float-right" href="<?= $url_back ?>"> <i class="k-icon k-i-arrow-chevron-left"></i>Kembali</a>
                </h1>
                <hr />
                <?php
                if (session()->getFlashdata('success')) {
                    echo '<div class="alert alert-success" role="alert">
									' . session()->getFlashdata('success') . '
						  		</div>';
                }
                ?>
                <?php
                if (session()->getFlashdata('danger')) {
                    echo '<div class="alert alert-danger" role="alert">
									' . session()->getFlashdata('danger') . '
						  		</div>';
                }
                ?>
                <?= $form ?>
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="nav nav-tabs bg-primary" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Tempat Survey</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Yang Bertugas</a>
                            </li>
                        </ul>
                        <div class="tab-content p-3" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <button onclick="tambahlokasi();" class="btn btn-primary btn-raised"><i class="k-icon k-i-plus"></i> Tambah Lokasi</button>
                                <?= $grid_tempat ?>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <button onclick="tambahpetugas();" class="btn btn-primary btn-raised"><i class="k-icon k-i-plus"></i> Tambah Petugas</button>
                                <?= $grid_petugas ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function deleteTempat(id){
    kendo.confirm("Yakin ingin delete data ini?").then(function() {
            $.post("<?= base_url("admin/survey/deleteTempat") ?>", {
                id: id
            }, function(result) {
                if (result.status) {
                    kendo.alert(result.message);
                    gridReloadTempat();
                } else {
                    kendo.alert(result.message);
                }
            }, 'json');
        }, function() {});
}

function deletePetugas(id){
    kendo.confirm("Yakin ingin delete data ini?").then(function() {
            $.post("<?= base_url("admin/survey/deletePetugas") ?>", {
                id: id
            }, function(result) {
                if (result.status) {
                    kendo.alert(result.message);
                    gridReloadTempat();
                } else {
                    kendo.alert(result.message);
                }
            }, 'json');
        }, function() {});
}

function tambahlokasi(){
    showForm(1000, 600, '_addlokasi', "<?= base_url('admin/survey/add_lokasi/'.$id) ?>");
}
function tambahpetugas(){
    showForm(900, 500, '_addpetugas', "<?= base_url('admin/survey/add_perugas/'.$id) ?>");
}
</script>
<?= $this->endSection() ?>