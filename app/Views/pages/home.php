<?= view('layouts/header') ?>
<?= view('layouts/navbar_vertical') ?>
<?= view('layouts/navbar_horizontal') ?>
    <!-- BEGIN: Page Main-->
<?php if ( !empty(configInfo()['intro']) && isset(configInfo()['intro'])): ?>
    <div id="main">
        <div class="row">
            <div class="col s12">
                <div class="container">
                    <div class="section">
                        <div class="card">
                            <div class="card-content">
                                <?= configInfo()['intro'] ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <div id="main">
        <div class="row">
            <div class="col s12">
                <div class="container" style="margin-bottom:40px">
                    <div class="section">
                        <!--card stats start-->
                        <div id="card-stats" class="pt-0">
                            <div class="row">
                                <div class="col s12 m6 l6 xl3">
                                    <div class="card gradient-45deg-light-blue-cyan gradient-shadow min-height-100 white-text animate fadeLeft">
                                        <div class="padding-4">
                                            <div class="row">
                                                <div class="col s4">
                                                    <i class="material-icons background-round mt-5">people</i>
                                                </div>
                                                <div class="col s8 right-align">
                                                    <h5 class="mb-0 white-text"><?= $users_new ?></h5>
                                                    <p class="no-margin">Nuevos</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col s7">
                                                    <p class="center-align">Afiliados</p>
                                                </div>
                                                <div class="col s5">
                                                    <p class="center-align"><?= $users_actives ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 m6 l6 xl3">
                                    <div class="card gradient-45deg-red-pink gradient-shadow min-height-100 white-text animate fadeLeft">
                                        <div class="padding-4">
                                            <div class="row">
                                                <div class="col s4">
                                                    <i class="material-icons background-round mt-5">monetization_on</i>
                                                </div>
                                                <div class="col s8 right-align">
                                                    <h5 class="mb-0 white-text"><?= $credits_pendiente ?></h5>
                                                    <p class="no-margin">Pendientes</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col s7">
                                                    <p class="center-align">Creditos</p>
                                                </div>
                                                <div class="col s5">
                                                    <p class="center-align"><?= $credits_total ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 m6 l6 xl3">
                                    <div class="card gradient-45deg-amber-amber gradient-shadow min-height-100 white-text animate fadeRight">
                                        <div class="padding-4">
                                            <div class="row">
                                                <div class="col s4">
                                                    <i class="material-icons background-round mt-5">question_answer</i>
                                                </div>
                                                <div class="col s8 right-align">
                                                    <h5 class="mb-0 white-text"><?= $pqrs_pendiente ?></h5>
                                                    <p class="no-margin">Sin revisar</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col s7">
                                                    <p class="center-align">PQRS</p>
                                                </div>
                                                <div class="col s5">
                                                    <p class="center-align"><?= $pqr_total ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 m6 l6 xl3">
                                    <div class="card gradient-45deg-green-teal gradient-shadow min-height-100 white-text animate fadeRight">
                                        <div class="padding-4">
                                            <div class="row">
                                                <div class="col s4">
                                                    <i class="material-icons background-round mt-5">insert_drive_file</i>
                                                </div>
                                                <div class="col s8 right-align">
                                                    <h5 class="mb-0 white-text"><?= $extract->date ?? '' ?></h5>
                                                    <p class="no-margin">Ultimo Cargado</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col s7">
                                                    <p class="center-align">Extractos</p>
                                                </div>
                                                <div class="col s5">
                                                    <p class="center-align"><?= $extracts_total ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--card stats end-->
                        <!--yearly & weekly revenue chart start-->

                        <div id="sales-chart">
                            <div class="row">
                                <div class="col s12 m4 l4">
                                    <div id="weekly-earning" class="card animate fadeUp">
                                        <div class="card-content">
                                            <h4 class="header m-0 center-align">Afiliados</h4>
                                            <div class="center-align">
                                                <table class="centered">
                                                    <thead>
                                                        <tr>
                                                            <th>Afiliado</th>
                                                            <th>Ultima Conexión</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($history_users as $key => $user): ?>
                                                            <tr>
                                                                <td><?= $user->name ?></td>
                                                                <td><?= transformDate($user->created_at) ?></td>
                                                            </tr>
                                                        <?php endforeach ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col s12 m4 l4">
                                    <div id="weekly-earning" class="card animate fadeUp">
                                        <div class="card-content">
                                            <h4 class="header m-0 center-align">
                                                PQRS
                                                <a href="<?= base_url(['table/pqrs']) ?>" class="waves-effect waves-light btn bg-primary-secondary right">Ver mas</a>
                                            </h4>
                                            <div class="center-align">
                                                <table class="centered">
                                                    <thead>
                                                        <tr>
                                                            <th>Afiliado</th>
                                                            <th>Motivo</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($pqrs as $key => $pqr): ?>
                                                            <tr>
                                                                <td><?= $pqr->name ?></td>
                                                                <td><?= $pqr->type ?></td>
                                                            </tr>
                                                        <?php endforeach ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col s12 m4 l4">
                                    <div id="weekly-earning" class="card animate fadeUp">
                                        <div class="card-content">
                                            
                                            <h4 class="header m-0 center-align">
                                                Créditos
                                                <a href="<?= base_url(['table/credits']) ?>" class="waves-effect waves-light btn bg-primary-secondary right">Ver mas</a>
                                            </h4>
                                            <div class="center-align">
                                                <table class="centered">
                                                    <thead>
                                                        <tr>
                                                            <th>Afiliado</th>
                                                            <th>Fecha Solicitud</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($credits as $key => $credit): ?>
                                                            <tr>
                                                                <td><?= $credit->name ?></td>
                                                                <td><?= transformDate($credit->created_at) ?></td>
                                                            </tr>
                                                        <?php endforeach ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="content-overlay"></div>
            </div>
        </div>
    </div>
<?php endif; ?>


<?= view('layouts/footer') ?>

<?php if($day <= 10): ?>
    <script>
        $(() => {
            Swal.fire({
                title: "Renovación de contraseña",
                text: "Quedan solo <?= $day ?> días para cambiar su contraseña. Para mantener la seguridad de su cuenta, por favor, actualice su contraseña lo antes posible.",
                icon: "warning"
            });
        })
    </script>
<?php endif ?>