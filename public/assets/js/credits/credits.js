function change_type_credit(value){
    if(value != ''){
        let type_credit = type_credits.find(t => t.id == value);
        $('#quota_max').attr('max', type_credit.quota_max);
        $('#quota_max').val(type_credit.quota_max);
        $('#rate').val(type_credit.rate);
    }else{
        $('#quota_max').attr('max', 100);
        $('#quota_max').val('');
        $('#rate').val('');
        $('#value').val('');
    }
    M.updateTextFields();
    $('.section.table').html("");
}

function reinit(){
    $('#quota_max').attr('max', 100);
    $('#quota_max').val('');
    $('#rate').val(''); 
    $('#value').val(''); 
    $('#type_credit_id').val('');
    $('#pledge').val('');
    $('#co-signer').val('');
    $('#observation').val('');
    M.updateTextFields();
    $('select').formSelect();
    $('.section.table').html("");
}

function as_submit(event){
    event.preventDefault();
    var credit_id = $('#type_credit_id').val();
    if(credit_id == '')
        return alert('Debe de seleccionar un tipo de crédito');
    let mont_value = $('#value').val();
    if(mont_value == '')
        return alert('Debe de ingresar un monto');
    mont_value = parseFloat(mont_value.replace(/,/g, ''));
    let type_credit = type_credits.find(t => t.id == credit_id);
    let quota_max = $('#quota_max').val();
    if(parseInt(quota_max) > parseInt(type_credit.quota_max))
        return alert('El valor de los peridos mensuales superan al permitido');
    let valor_tasa  = type_credit.rate/100;
    let segu_tasa = 0.0005;
    let tasa_interes = valor_tasa + segu_tasa;
    let cuota = (mont_value * (tasa_interes * Math.pow(1 + tasa_interes, quota_max))) / (Math.pow(1 + tasa_interes, quota_max) - 1);

    let sald_fina = mont_value;

    let table = ``;

    for (let index = 0; index < quota_max; index++) {
        let sald_inic = index == 0 ? mont_value : sald_fina;
        let inte_actu =  sald_inic * valor_tasa;
        let segu_actu =  sald_inic * segu_tasa;
        let capi_actu = Math.abs(inte_actu + segu_actu - cuota);
        sald_fina =  sald_inic - capi_actu;
        table += `
            <tr>
                <td>${index+1}</td>
                <td>${formatPrice(sald_inic)}</td>
                <td>${formatPrice(inte_actu)}</td>
                <td>${formatPrice(capi_actu)}</td>
                <td>${formatPrice(segu_actu)}</td>
                <td>${formatPrice(cuota)}</td>
                <td>${formatPrice(sald_fina)}</td>
            </tr>
        `;
    }

    $('.section.table').html(`
        <div class="card">
            <div class="card-content">
                <a href="javascript:void(0);" onclick="create_credit()" class="btn bg-primary">
                    Solicitar Crédito
                </a>
                <table class="centered">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Saldo Inicial</th>
                            <th>Interes</th>
                            <th>Abono a capital</th>
                            <th>Seguro</th>
                            <th>Cuota a Pagar</th>
                            <th>Saldo Final</th>
                        </tr>
                    </thead>

                    <tbody>
                        ${table}
                    </tbody>
                </table>
            </div>
        </div>
    `);
}

// async function as_submit(event){
//     event.preventDefault();
//     var credit_id = $('#type_credit_id').val();
//     if(credit_id == '')
//         return alert('Debe de seleccionar un tipo de crédito');
//     let mont_value = $('#value').val();
//     if(mont_value == '')
//         return alert('Debe de ingresar un monto');
//     mont_value = parseFloat(mont_value.replace(/,/g, ''));
//     let type_credit = type_credits.find(t => t.id == credit_id);
//     let quota_max = $('#quota_max').val();
//     if(parseInt(quota_max) > parseInt(type_credit.quota_max))
//         return alert('El valor de los peridos mensuales superan al permitido');
//     let form = {
//         type_credit_id  : credit_id,
//         value           : mont_value,
//         quota_max       : quota_max
//     }
//     let url = base_url(['dashboard/simulate_credit']);
//     await proceso_fetch(url, JSON.stringify(form)).then( data => {
//         var byteCharacters = atob(data.pdf);
//         var byteNumbers = new Array(byteCharacters.length);
//         for (var i = 0; i < byteCharacters.length; i++) {
//             byteNumbers[i] = byteCharacters.charCodeAt(i);
//         }
//         var byteArray = new Uint8Array(byteNumbers);
//         var blob = new Blob([byteArray], { type: 'application/pdf' });
//         const blobUrl = window.URL.createObjectURL(blob);
//         $('.section.table').html(`
//             <div class="card">
//                 <div class="card-content">
//                     <a href="${blobUrl}" class="btn bg-primary" download="mi_documento.pdf">
//                         Imprimir
//                     </a>
//                     ${data.page}
//                 </div>
//             </div>
//         `);
//     });
// }

async function create_credit(){
    var credit_id = $('#type_credit_id').val();
    if(credit_id == '')
        return alert('Debe de seleccionar un tipo de crédito');
    let mont_value = $('#value').val();
    if(mont_value == '')
        return alert('Debe de ingresar un monto');
    mont_value = parseFloat(mont_value.replace(/,/g, ''));
    let type_credit = type_credits.find(t => t.id == credit_id);
    let quota_max = $('#quota_max').val();
    if(parseInt(quota_max) > parseInt(type_credit.quota_max))
        return alert('El valor de los peridos mensuales superan al permitido');
    let form = {
        type_credit_id  : credit_id,
        value           : mont_value,
        quota_max       : quota_max,
        pledge          : $('#pledge').val(),
        co_signer       : $('#co-signer').val(),
        observation     : $('#observation').val()
    }
    let url = base_url(['dashboard/credits/create']);
    
    alert('Enviando solicitud', 'orange');
    await proceso_fetch(url, JSON.stringify(form)).then( data => {
        setTimeout(() => {
            alert(data.message, data.status ? 'green' : red);
            if(data.status)
                reinit()
        }, 2000)
    });
}