function send_contact(e){
    e.preventDefault();
    $('.loading').addClass('d-block');
    const thisForm = $('#form_contact');
    const formData = {
        name: $('#name').val(),
        email: $('#email').val(),
        subject: $('#subject').val(),
        message: $('#message').val()
    };
    if(!validateFormData(formData))
        return displayError("Por favor valida que todos los campos estén rellenos.");
    const action = base_url(['send/contact']);
    fetch(action, {
        method: 'POST',
        body: JSON.stringify(formData),
        headers: {'Content-Type': 'application/json'}
    })
    .then(response => {
        if( response.ok ) {
            return response.json();
        } else {
            throw new Error(`${response.status} ${response.statusText} ${response.url}`); 
        }
    })
    .then(data => {
        console.log(data);
        $('.loading').removeClass('d-block');
        $('.error-message').removeClass('d-block');
        $('.sent-message').removeClass('d-block');
        if (data.status) {
            $('.sent-message').addClass('d-block');
            thisForm[0].reset(); 
        } else {
            throw new Error(data.msg); 
        }
    })
    .catch((error) => {
        displayError(error);
    });


}

function displayError(error) {
    $('.loading').removeClass('d-block');
    $('.error-message').html(error);
    $('.error-message').addClass('d-block');
}

function validateFormData(data) {
    console.log(data);
    for (const key in data) {
        if(data[key] === null)
            return false
        else if (data[key].trim() === '') {
            return false;
        }
    }
    return true;
}