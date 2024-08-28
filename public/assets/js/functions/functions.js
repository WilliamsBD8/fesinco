function proceso_fetch(url, data, method = 'POST') {
  return fetch(url, {
      method: method,
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: data
  }).then(response => {
      if (!response.ok) throw Error(response.status);
      return response.json();
  }).catch(error => {
    console.error(error);
    alert('<span class="red-text">Error en la consulta</span>', 'red lighten-5');
  });
}

function proceso_fetch_get(url) {
  return fetch(url).then(response => {
      if (!response.ok) throw Error(response.status);
      return response.json();
  }).catch(error => {
    console.error(error);
    alert('Error en la consulta', 'red');
  });
}

function alert(message, type = 'red', duration = 300) {
  M.toast({ html: `'<span class="${type}-text">${message}</span>'`, classes: `rounded ${type} lighten-5`, outDuration: duration });
}

function base_url(array = []) {
  var url = localStorage.getItem('url');
  if (array.length == 0) return `${url}`;
  else return `${url}${array.join('/')}`;
}

function formatPrice(price){
  const formatter = new Intl.NumberFormat('es-CO', {
      style: 'currency',
      currency: 'COP',
      minimumFractionDigits: 2
  })
  return formatter.format(price)
}

const separador_miles = (numero) => {
  let partesNumero = numero.toString().split('.');
  partesNumero[0] = partesNumero[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');
  return partesNumero.join('.')
}

function updateFormattedValue(input) {
  var value = input.value
  value = value.replace(/[a-zA-Z]/g, '').replace(/,/g, '');
  const formattedValue = separador_miles(value);
  input.value = formattedValue;
}

function changeFile(event, complemento = '') {
  const url = event.target.files[0];
  $(`#filename${complemento}`).val(event.target.files[0].name);
  const reader = new FileReader();
  reader.readAsDataURL(url);
  const data = reader.onload = () => {
      const base64 = reader.result;
      $(`#file${complemento}`).val(base64);
  }
}