<?= $this->extend('layouts/page') ?>

<?= $this->section('content') ?>
<div class="col s12">
    <div class="container" style="margin-bottom: 80px">
        <div class="section">
            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <h4>Simulador de créditos</h4>
                        <form class="col s12" onsubmit="as_submit(event)" method="post" action="<?= base_url(['dashboard/generate_pdf']) ?>">
                            <div class="row">
                                <div class="input-field col s12 l6">
                                    <select id="type_credit_id" onchange="change_type_credit(this.value)">
                                        <option value="">Seleccionar tipo de credito</option>
                                        <?php foreach($type_credits as $credit): ?>
                                            <option value="<?= $credit->id ?>"><?= $credit->credit_name ?> - [<?= $credit->rate ?> %]</option>
                                        <?php endforeach ?>
                                    </select>
                                    <label>Tipo de Crédito</label>
                                </div>
                                <div class="input-field col s12 l6">
                                    <input onkeyup="updateFormattedValue(this)" value="" id="value" type="text" class="validate">
                                    <label for="value">Valor</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 l6">
                                    <input value="" id="quota_max" type="number" class="validate">
                                    <label for="quota_max">Períodos Mensuales</label>
                                </div>
                                <div class="input-field col s12 l6">
                                    <input disabled value="" id="rate" type="text" class="validate">
                                    <label for="rate">Tasa de interes</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 l6">
                                    <button class="btn bg-primary-secondary col s12">
                                        Calcular
                                    </button>
                                </div>
                                <div class="input-field col s12 l6">
                                    <a href="javascript:void(0)" onclick="reinit()" class="btn bg-secondary col s12">
                                        Reiniciar
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="loading-form">
                                    <div class="info">
                                        <i class="material-icons rotating">refresh</i>
                                        Cargando
                                    </div>
                                </div>

                                <div class="error-message card-alert card red lighten-5">
                                    <div class="card-content red-text center-align">
                                        Error
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="section table">
            
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
    <script>
        const type_credits = <?= json_encode($type_credits) ?>;
    </script>
    <script src="<?= base_url(['assets/js/functions/functions.js']) ?>"></script>
    <script src="<?= base_url(['assets/js/credits/simulate.js']) ?>"></script>
<?= $this->endSection() ?>