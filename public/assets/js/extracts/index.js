$(() => {
    $('#table_datatable').dataTable({
        data: dates_extracts,
        columns: [
            {title: 'Año', data: 'year'},
            {title: 'Mes', data: 'mes', render: (mes) => {
                return ` ${padNumber(mes)} - ${meses(parseInt(mes))}`
            }},
            {title: 'Acciones', data:'', render: (_, __, fecha) => {
                return `
                    <a onclick="view_pdf('${fecha.year}', '${fecha.mes}', '${fecha.user}')" class="indigo-text tooltipped" data-position="bottom" data-tooltip="Ver extracto" href="javascript:void(0);"><i class="material-icons">remove_red_eye</i></a>
                    <a onclick="download_pdf('${fecha.year}', '${fecha.mes}', '${fecha.user}')" class="pink-text tooltipped" data-position="bottom" data-tooltip="Descargar extracto" href="javascript:void(0);"><i class="material-icons">file_download</i></a>
                `
            }}
        ],
        scrollX: true,
        language: { url: "https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json" },
        drawCallback: (setting) => {
            $('.material-tooltip').remove();
            $('.tooltipped').tooltip();
        }
    });
});

function meses(id){
    var meses = [
        'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
    ];
    return meses[parseInt(id) - 1]
}

function padNumber(num) {
    return num.toString().padStart(2, '0');
}

async function view_pdf(year, mes, user) {
    let info = {year, mes: padNumber(mes), user};
    let url = base_url(['dashboard/extracts/view']);
    await proceso_fetch(url, JSON.stringify(info)).then(data => {
        Swal.fire({
            html: `<embed src="data:application/pdf;base64,${data.pdf}" width="100%" height="700" type="application/pdf">`,
            width: '80%',
            heightAuto: '100%',
        })
    });
}

async function download_pdf(year, mes, user) {
    let info = {year, mes: padNumber(mes), user};
    let url = base_url(['dashboard/extracts/view']);
    await proceso_fetch(url, JSON.stringify(info)).then(data => {
        console.log(data);
        var link = document.createElement('a');
        link.href = `data:application/pdf;base64,${data.pdf}`;
        link.download = `extract_${meses(parseInt(mes))}_${year}.pdf`;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    });
}