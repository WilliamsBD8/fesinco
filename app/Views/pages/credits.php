<?= $this->extend('layouts/page') ?>

<?= $this->section('content') ?>
<div class="col s12">
    <div class="container" style="margin-bottom: 80px">
        <div class="section">
            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <h4>Solicitud de créditos</h4>
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
                                    <input value="" id="quota_max" type="number" class="validate">
                                    <label for="quota_max">Períodos Mensuales</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 l6">
                                    <input onkeyup="updateFormattedValue(this)" value="" id="value" type="text" class="validate">
                                    <label for="value">Valor</label>
                                </div>
                                <div class="input-field col s12 l6">
                                    <input value="" id="pledge" type="text" class="validate">
                                    <label for="pledge">Pignoración</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 l6">
                                    <input value="" id="co-signer" placeholder="Si necesita codeudor, indique el nombre del asociado a FESINCO" type="text" class="validate">
                                    <label for="co-signer">Codeudor</label>
                                </div>
                                <div class="input-field col s12 l6">
                                    <textarea id="observation" class="materialize-textarea"></textarea>
                                    <label for="observation">Observación</label>
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
    <script src="<?= base_url(['assets/js/credits/credits.js']) ?>"></script>
<?= $this->endSection() ?>