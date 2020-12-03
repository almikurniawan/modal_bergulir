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
                        <?= $form ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

</script>
<?= $this->endSection() ?>