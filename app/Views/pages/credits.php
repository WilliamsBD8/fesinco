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
                                <div class="file-field input-field col s12 l6">
                                    <div class="btn bg-primary-secondary">
                                        <span>Desprendible de Nómina</span>
                                        <input type="file" id="file_origin" onchange="changeFile(event, '_credit')">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text" id="filename_origin">
                                    </div>
                                    <input type="hidden" id="file_credit">
                                    <input type="hidden" id="filename_credit">
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 l6">
                                    <!-- <input value="" id="co-signer" placeholder="Si necesita garantia, indique el nombre del asociado a FESINCO" type="text" class="validate">
                                    <label for="co-signer">Garantia</label> -->

                                    <select id="co-signer">
                                        <!-- <option value="">Seleccionar tipo de credito</option> -->
                                        <option value="No aplica" select>No aplica</option>
                                        <option value="Afianzadora">Afianzadora</option>
                                        <option value="Codeudor">Codeudor</option>
                                    </select>
                                    <label>En caso de requerir Garantia autoriza</label>
                                </div>
                                <div class="input-field col s12 l6">
                                    <textarea id="observation" class="materialize-textarea"></textarea>
                                    <label for="observation">Observación</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12 l6">
                                    <input value="" id="date_init" type="date" class="validate">
                                    <label for="date_init">Fecha de ingreso</label>
                                </div>
                                <div class="input-field col s12 l6">
                                    <input value="" id="position" type="text" class="validate">
                                    <label for="position">Cargo que ocupa</label>
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