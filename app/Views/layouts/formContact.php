<form id="form_contact" onsubmit="send_contact(event)" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
    <div class="row gy-4">

        <div class="col-md-6">
            <input type="text" name="name" id="name" class="form-control" placeholder="Nombre *">
        </div>

        <div class="col-md-6 ">
            <input type="email" class="form-control" name="email" id="email" placeholder="Correo *">
        </div>

        <div class="col-md-12">
            <select class="form-control" name="subject" id="subject">
                <option selected disabled>Tema *</option>
                <?php foreach(contact_topics() as $contact): ?>
                    <option <?= isset($tema) ? ($tema == $contact->id ? 'selected' :  'disabled') : ''?> value="<?= $contact->id ?>"><?= $contact->title ?></option>
                <?php endforeach ?>
            </select>
        </div>

        <div class="col-md-12">
            <textarea class="form-control" name="message" id="message" rows="6" placeholder="Mensaje *"></textarea>
        </div>

        <div class="col-md-12 text-center">
            <div class="loading">Cargando</div>
            <div class="error-message"></div>
            <div class="sent-message">Su mensaje a sido enviado</div>

            <button class="bg-secondary-primary" type="submit">Enviar</button>
        </div>

    </div>
</form>