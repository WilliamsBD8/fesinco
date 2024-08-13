<?= $this->extend('layouts/page') ?>
<?= $this->section('title') ?>
    Extractos
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<?= $this->include('layouts/css_datatable') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="col s12">
    <div class="container" style="margin-bottom: 80px">
        <div class="section">
            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <h4 class="card-title center-align">Mis extractos</h4>
                        <hr>
                        <div class="row">
                            <div id="status" class="col s12 section-data-tables">
                                <table class="display" id="table_datatable"></table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<?= $this->include('layouts/js_datatable') ?>

<script src="<?= base_url(['assets/js/functions/functions.js']) ?>"></script>

<script>
    const dates_extracts = <?= json_encode($fechas) ?>;
</script>

<script src="<?= base_url((['assets/js/extracts/index.js'])) ?>"></script>

<?= $this->endSection() ?>