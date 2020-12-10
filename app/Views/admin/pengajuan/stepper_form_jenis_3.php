<?php
$request = service('request');
?>
<link rel="stylesheet" href="<?= base_url() ?>/assets/stepper.min.css" />
<script src="<?= base_url() ?>/assets/stepper.min.js"></script>
        <div class="bs-stepper vertical row">
            <div class="bs-stepper-header col-sm-2" role="tablist">
                <div onclick="jump(1)" class="step <?= (($request->getGet('step')>=1 || $request->getGet('step')=='') ? 'active' : '')?>" data-target="#logins-part">
                    <button type="button" class="step-trigger" role="tab" aria-controls="logins-part" id="logins-part-trigger">
                        <span class="bs-stepper-circle">1</span>
                        <span class="bs-stepper-label">Surat Permohonan</span>
                    </button>
                </div>
                <div class="line"></div>
                <div onclick="jump(2)" class="step <?= ($request->getGet('step')>=2 ? 'active' : '')?>" data-target="#logins-part2">
                    <button type="button" class="step-trigger" role="tab" aria-controls="logins-part2" id="logins-part2-trigger">
                        <span class="bs-stepper-circle">2</span>
                        <span class="bs-stepper-label">Profil Usaha Mikro</span>
                    </button>
                </div>
                <div class="line"></div>
                <div onclick="jump(3)" class="step <?= ($request->getGet('step')>=3 ? 'active' : '')?>" data-target="#logins-part2">
                    <button type="button" class="step-trigger" role="tab" aria-controls="logins-part2" id="logins-part2-trigger">
                        <span class="bs-stepper-circle">3</span>
                        <span class="bs-stepper-label">Dokumen Jaminan</span>
                    </button>
                </div>
                <!-- <div class="line"></div>
                <div onclick="jump(4)" class="step <?= ($request->getGet('step')>=4 ? 'active' : '')?>" data-target="#logins-part2">
                    <button type="button" class="step-trigger" role="tab" aria-controls="logins-part2" id="logins-part2-trigger">
                        <span class="bs-stepper-circle">4</span>
                        <span class="bs-stepper-label">Surat Keterangan</span>
                    </button>
                </div> -->
                <div class="line"></div>
                <div onclick="jump(5)" class="step <?= ($request->getGet('step')>=5 ? 'active' : '')?>" data-target="#logins-part2">
                    <button type="button" class="step-trigger" role="tab" aria-controls="logins-part2" id="logins-part2-trigger">
                        <span class="bs-stepper-circle">4</span>
                        <span class="bs-stepper-label">Denah Lokasi Usaha</span>
                    </button>
                </div>
                <div class="line"></div>
                <div onclick="jump(6)" class="step <?= ($request->getGet('step')>=6 ? 'active' : '')?>" data-target="#logins-part2">
                    <button type="button" class="step-trigger" role="tab" aria-controls="logins-part2" id="logins-part2-trigger">
                        <span class="bs-stepper-circle">5</span>
                        <span class="bs-stepper-label">Foto Pendukung</span>
                    </button>
                </div>
                <div class="line"></div>
                <div onclick="jump(7)" class="step <?= ($request->getGet('step')>=7 ? 'active' : '')?>" data-target="#logins-part2">
                    <button type="button" class="step-trigger" role="tab" aria-controls="logins-part2" id="logins-part2-trigger">
                        <span class="bs-stepper-circle">6</span>
                        <span class="bs-stepper-label">Surat Pernyataan</span>
                    </button>
                </div>
            </div>
            <div class="bs-stepper-content col-sm-10">
                <?php
                    if($peng_lock_is=='t'){
                        echo '<a target="_new" class="btn btn-success btn-xs btn-raised float-right" href="'.base_url("admin/cetak3/profil/".$peng_id).'"><i class="k-icon k-i-print"></i> Cetak</a>';
                    }
                ?>
                <?= $form ?>
            </div>
        </div>

<script>
$(document).ready(function () {
  var stepper = new Stepper($('.bs-stepper')[0])
})
function jump(step){
    window.location.href = "<?= base_url("admin/pengajuan/detail/".$id."?step=")?>"+step;
}
</script>