<?= $this->extend('layouts/page') ?>
<?= $this->section('content') ?>
    <div class="col s12">
        <div class="section">
            <!--card stats start-->
            <div id="card-stats" class="pt-0">
                <h4 class="center-align">Portal de Afiliados FESINCO</h4>
            </div>
        </div>
        <div class="card animate fadeUp">
            <div class="card-content">
                <table class="centered striped">
                    <tbody>
                        <tr>
                            <td>Fecha:</td>
                            <td><?= date('Y-m-d', strtotime(session('user')->password->updated_at)) ?></td>
                        </tr>
                        <tr>
                            <td>Hora: </td>
                            <td><?= date('h:i:s a', strtotime(session('user')->password->updated_at)) ?></td>
                        </tr>
                        <tr>
                            <td>Vigencia contraseña: </td>
                            <td><?= $day ?> días</td>
                        </tr>
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
        <div class="section">
            <!--card stats start-->
            <div id="card-stats" class="pt-0">
                <div class="row">
                    <?php foreach($credits as $key => $credit): ?>
                        <div class="col s12 m6 l6 xl6">
                            <div class="card <?= $key == 0 ? 'bg-primary' : 'bg-primary-secondary' ?> gradient-shadow min-height-100 white-text animate fadeLeft">
                                <div class="padding-4">
                                    <div class="row">
                                        <div class="col s7 m7">
                                            <i class="material-icons background-round mt-5"><?= $key == 0 ? 'local_atm' : 'attach_money' ?></i>
                                            <p><?= $key == 0 ? 'Créditos Simulados' : 'Créditos Solicitados' ?></p>
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
        <div class="content-overlay"></div>
    </div>
<?= $this->endSection() ?>