async function extract_load(){
    alert('Realizando cargue del extracto', 'indigo');
    let url = base_url(['dashboard/extracts/load']);
    
    setTimeout(async () => {
        let info = await proceso_fetch(url, JSON.stringify({}));
        M.Toast.dismissAll();
        if(info.status){
            Swal.fire({
                icon: 'success',
                title: info.message,
            })
            $('.fa-refresh').trigger('click');
        }
        else{
            if("data" in info){
                let uniqueData = [...new Set(info.data)];
                Swal.fire({
                    'title': info.message,
                    html: uniqueData.join(', ')
                })
                console.log(uniqueData);
            }else if("errors_format" in info){
                let respond = "<ul>";
                respond += info.errors_format.map(li => `<li>${li}</li>`);
                Swal.fire({
                    icon: 'warning',
                    title: "Error en el formato en los archivos.",
                    html: respond
                })
            }else{ 
                Swal.fire({
                    icon: 'warning',
                    title: info.message,
                })
            }
        }
    }, 3000)
}