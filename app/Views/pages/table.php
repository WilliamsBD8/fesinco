<?= view('layouts/header') ?>
<?= view('layouts/navbar_horizontal') ?>
<?= view('layouts/navbar_vertical') ?>

<!-- BEGIN: Page Main-->
<div id="main">
    <div class="row">
        <div class="col s12">
            <div class="container">
                <div class="section">
                    <div class="card">
                        <div class="card-content">
                            <div class="row">
                                <div class="col s12 l6">
                                    <h4 class="card-title"><?= $title ?></h4>
                                </div>
                                <div class="col s12 l6">
                                    <?php if($title == 'Extractos'): ?>
                                        <a href="javascript:void(0);" onclick="extract_load()" class="btn btn-small right bg-primary ml-2"><i class="material-icons right">cloud_download</i> Cargar Extracto</a>
                                    <?php endif ?>
                                </div>
                            </div>
                            <p><?= $subtitle ?></p>
                                <?=  $output ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url(['assets/js/functions/functions.js']) ?>"></script>

<?= view('layouts/footer') ?>

<script src="<?= base_url(['assets/js/table.js']) ?>"></script>
