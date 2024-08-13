
$(() => {
  jQuery(document).ready(function() {
      jQuery('.gc-container').groceryCrud({
          callbackAfterUpdate: function () {
              replace_colors()
          },
          callbackAfterInsert: function () {
              replace_colors()
          },
      });
  });
});

function replace_colors(){
  if($('input[name="primary_color"]').val() != undefined){
      var primary     = $('input[name="primary_color"]').val();
      var secundary   = $('input[name="secundary_color"]').val();
      document.documentElement.style.setProperty('--primary-color', `#${primary == '' ? '8e24aa' : primary}`);
      document.documentElement.style.setProperty('--secondary-color', `#${secundary == '' ? 'ff6e40' : secundary}`);
      document.documentElement.style.setProperty('--primary-rgb', hexToRgb(`${primary == '' ? '8e24aa' : primary}`));
      document.documentElement.style.setProperty('--secondary-rgb', hexToRgb(`${secundary == '' ? 'ff6e40' : secundary}`));
  }
}

function hexToRgb(hex) {
  var bigint = parseInt(hex, 16);
  var r = (bigint >> 16) & 255;
  var g = (bigint >> 8) & 255;
  var b = bigint & 255;
  return `${r}, ${g}, ${b}`;
}

async function credit_solicit(id, type = '1'){
  let url = base_url(['dashboard/credits/updated']);
  let data = {
    type,
    id
  };
  switch (type) {
    case '1':
      Swal.fire({
        icon: 'warning',
        title: "Antes de realizar la solicitud, asegurece de revisar los datos",
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: "Solicitar",
        denyButtonText: `Revisar datos`
      }).then(async (result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          await proceso_fetch(url, JSON.stringify(data)).then(info => {
            alert(info.message, info.status ? 'green' : 'red');
            $('.fa-refresh').trigger('click');
          });
        } else if (result.isDenied) {
          window.location.href = `#/edit/${id}`;
        }
      });
      break;
  
    default:
      await proceso_fetch(url, JSON.stringify(data)).then(info => {
        alert(info.message, info.status ? 'green' : 'red');
        $('.fa-refresh').trigger('click');
      });
      break;
  }
}