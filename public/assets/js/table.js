async function extract_load(){
    alert('Realizando cargue del extracto', 'indigo');
    let url = base_url(['dashboard/extracts/load']);
    
    setTimeout(async () => {
        let info = await proceso_fetch(url, JSON.stringify({}));
        M.Toast.dismissAll();
        if(info.status){
            alert(info.message, 'green');
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
            }else{ 
                alert(info.message, 'orange');
            }
        }
    }, 3000)
}