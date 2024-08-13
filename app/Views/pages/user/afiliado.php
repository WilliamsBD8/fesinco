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
                        <div class="col s12 m3 l3 xl3">
                            <div class="card <?= $credit->id == 1 ? 'gradient-45deg-amber-amber' : ($credit->id == 2 ? 'gradient-45deg-light-blue-cyan' : ($credit->id == 3 ? 'gradient-45deg-green-teal' : 'gradient-45deg-red-pink')) ?> gradient-shadow min-height-100 white-text animate fadeLeft">
                                <div class="padding-4">
                                    <div class="row">
                                        <div class="col s7 m7">
                                            <i class="material-icons background-round mt-5">
                                                <?php if($credit->id == 1): ?>
                                                    timeline
                                                <?php elseif($credit->id == 2): ?>
                                                    attach_money
                                                <?php elseif($credit->id == 3): ?>
                                                    check
                                                <?php else: ?>
                                                    close
                                                <?php endif ?>
                                            </i>
                                            <p>Créditos <?= $credit->name ?></p>
                                        </div>
                                        <div class="col s5 m5 right-align">
                                            <h5 class="mb-0 white-text"><?= $credit->total ?></h5>
                                            <p class="no-margin">Total</p>
                                            <p>$ <?= number_format($credit->value, 2, ',', '.') ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
        <?php if($day <= 15 ): ?>
            <div class="card animate fadeUp">
                <div class="card-content">
                    <table class="centered striped">
                        <tbody>
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
        <div class="card animate fadeUp">
            <div class="card-content">
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