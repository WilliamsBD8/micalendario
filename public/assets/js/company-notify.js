async function saveNotification(e){
    e.preventDefault();
}


async function changeData(_this){
    let type = $(_this).attr('type');
    if(type != 'checkbox'){
        const name = $(_this).attr('name'); // Obtiene el atributo 'name'
        const value = $(_this).val();      // Obtiene el valor del elemento
        // if(value != ''){
        var data = {
            name: name,
            value: value,
            company: $('#company_id').val()
        }
        // let url = base_url(['created/notify']);
        // const res = await proceso_fetch(url, data, false);
        // }
    }else{
        const tax = $(_this).val(); 
        const checked = $(_this).prop('checked'); 
        var data = {
            name: type,
            value: tax,
            checked,
            company: $('#company_id').val()
        }
    }

    let url = base_url(['created/notify']);
    const res = await proceso_fetch(url, data, false);
    console.log(res);
}