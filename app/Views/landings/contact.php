<?= $this->extend('layouts/landing'); ?>
<?= $this->section('content'); ?>
<!-- Main Content -->
<div class="content margin-top60 margin-bottom60">
    <div class="container">
        <div class="row">
            <!-- Contact Form -->
            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12" id="contact-form">
                <h2>Informacion de Contacto</h2>
                <p>* Todos los campos son requeridos.</p>
                <form method="post" class="reply" id="contact">
                    <fieldset>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <input class="form-control" id="name" name="name" type="text" placeholder="Nombre *" value="" required>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <input class="form-control" type="email" id="email" name="email" placeholder="Correo *" value="" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <select class="form-control">
                                    <option selected disabled>Tema *</option>
                                    <?php foreach(contact_topics() as $contact): ?>
                                        <option <?= $tema == $contact->id ? 'selected' :  ''?> value="<?= $contact->id ?>"><?= $contact->title ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <textarea class="form-control" id="text" name="text" rows="3" cols="40" placeholder="Message" required></textarea>
                            </div>
                        </div>
                    </fieldset>
                    <button class="btn btn-color submit pull-right" type="submit">Send</button>
                    <div class="success alert-success alert" style="display:none">Your message has been sent successfully.</div>
                    <div class="error alert-error alert" style="display:none">E-mail must be valid and message must be longer than 100 characters.</div>
                    <div class="clearfix">
                    </div>
                </form>
            </div>
            <!-- /Contact Form -->
            <div class="col-lg-4 col-md-4 col-xs-12 col-sm-6">
                <div class="address widget">
                    <h3 class="title">Head Office</h3>
                    <ul class="contact-us">
                        <li>
                            <i class="fa fa-map-marker"></i>
                            <p>
                                <strong class="contact-pad">Address:</strong> 221 Baker Street<br> London <br>
                                United Kingdom
                            </p>
                        </li>
                        <li>
                            <i class="fa fa-phone"></i>
                            <p>
                                <strong>Phone:</strong> +880 111-111-111
                            </p>
                        </li>
                        <li>
                            <i class="fa fa-envelope"></i>
                            <p>
                                <strong>Email:</strong><a href="mailto:email@demo.com">email@demo.com</a>
                            </p>
                        </li>
                    </ul>
                </div>
                <div class="contact-info widget">
                    <h3 class="title">Business Hour</h3>
                    <ul class="business-hour">
                        <li><i class="fa fa-clock-o"> </i>Monday - Friday 9am to 5pm </li>
                        <li><i class="fa fa-clock-o"> </i>Saturday - 9am to 2pm</li>
                        <li><i class="fa fa-times-circle-o"> </i>Sunday - Closed</li>
                    </ul>
                </div>
                <div class="follow widget">
                    <h3 class="title">Siguenos</h3>
                    <div class="member-social dark">
                        <?php foreach (social_networks() as $key => $network): ?>
                            <a class="<?= strtolower($network->name) ?>" href="<?= $network->link ? $network->link : "#" ?>" target="<?= $network->_blank == 'Si' ? '_blank' : '' ?>"><i class="<?= $network->icon ?>"></i></a>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Main Content -->
<?= $this->endSection(); ?>