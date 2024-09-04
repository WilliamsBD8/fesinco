<?= $this->extend('layouts/page') ?>
<?= $this->section('content') ?>
    <div class="col s12">
        <div class="section">
            <!--card stats start-->
            <div id="card-stats" class="pt-0">
                <h4 class="center-align">Portal de Afiliados FESINCO</h4>
            </div>
        </div>
        <div class="section">
            <!--card stats start-->
            <div id="card-stats" class="pt-0">
                <div class="row">
                    <?php foreach($credits as $key => $credit): ?>
                        <div class="col s12 m3 xl<?= 12 / count($credits) ?>">
                            <div class="card border-radius-10 <?= $credit->id == 1 ? 'gradient-45deg-amber-amber' : ($credit->id == 2 ? 'gradient-45deg-light-blue-cyan' : ($credit->id == 3 ? 'gradient-45deg-green-teal' : 'gradient-45deg-red-pink')) ?> gradient-shadow min-height-100 white-text animate fadeLeft">
                                <div class="padding-4">
                                    <div class="row">
                                        <div class="col s12">
                                            <!-- <i class="material-icons background-round mt-5">
                                                <?php if($credit->id == 1): ?>
                                                    timeline
                                                <?php elseif($credit->id == 2): ?>
                                                    attach_money
                                                <?php elseif($credit->id == 3): ?>
                                                    check
                                                <?php else: ?>
                                                    close
                                                <?php endif ?>
                                            </i> -->
                                            <h5 class="mb-0 white-text center-align">Créditos <?= $credit->name ?></h5>
                                        </div>
                                        <div class="col s12 center-align">
                                            <p class="mb-0 white-text">Total: <?= $credit->total ?></p>
                                            <p class="no-margin">Valor: <b>$ <?= number_format($credit->value, 0, ',', '.') ?></b></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
        <?php if($day <= 15 || (!empty(session('user')->link_file)) && empty(session('user')->link_updated)): ?>
            <div class="card animate fadeUp">
                <div class="card-content">
                    <table class="centered striped">
                        <tbody>
                            <?php if(!empty(session('user')->link_file)): ?>
                                <?php if(empty(session('user')->link_updated)): ?>
                                    <tr>
                                        <td>Actualizar datos de usuario</td>
                                        <td><a class="btn btn-small bg-primary-secondary" target="_blank" href="<?= session('user')->link_file ?>">Actualizar</a></td>
                                    </tr>
                                <?php endif ?>
                            <?php endif ?>
                            <tr></tr>
                            <?php if($day > 10 && $day <= 15): ?>
                                <tr>
                                    <td colspan="2" class="orange-text">Quedan solo <?= $day ?> días para cambiar su contraseña.</td>
                                </tr>
                            <?php elseif($day <= 10): ?>
                                <tr>
                                    <td colspan="2" class="red-text">Quedan solo <?= $day ?> días para cambiar su contraseña.</td>
                                </tr>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif ?>
        <div class="card animate fadeUp" style="margin-bottom: 70px">
            <div class="card-content">
                <div class="row">
                    <div class="col s12 m6">
                        <h6 class="center-align padding-1"><b>PQRs Total: </b> <?= $pqrs_indi->total ?></h6>
                    </div>
                    <div class="col s12 m6">
                        <h6 class="center-align padding-2 border-radius-10 <?= $pqrs_indi->mes >= 5 ? ($pqrs_indi->mes >= 10 ? 'red lighten-5 red' : 'orange lighten-5 orange') : 'black' ?>-text"><b>PQRs del Mes: </b> <?= $pqrs_indi->mes ?></h6>
                    </div>
                </div>
                <table class="centered striped">
                    <thead>
                        <tr>
                            <th>PQRS</th>
                            <th>Motivo</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($pqrs) > 0): ?>
                            <?php foreach($pqrs as $pqr): ?>
                                <tr>
                                    <td width="33%"><?= maxTruncate($pqr->observation, 70) ?></td>
                                    <td width="33%"><?= $pqr->type ?></td>
                                    <td width="33%"><?= $pqr->status ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3">No se han registrado PQRS</td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="content-overlay"></div>
    </div>
<?= $this->endSection() ?>