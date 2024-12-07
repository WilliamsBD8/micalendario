function getMeses(mes = null){
    const meses = [
        "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
        "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
    ];
    return mes == null ? meses : meses[mes]
}

function template_1(taxes){
    var template = "";
    Object.entries(taxes).forEach(([i, tax]) => {
        template += `
            <div class="pb-5 w-100">
                <h5 class="card-header py-1">${tax.title}</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table table-light table-sm table-borderless">
                        <thead>
                            <tr class="">
                                <th colspan="${tax.details.length + 1}"  class="table-primary text-center">Presentación / Pago</th>
                            </tr>
                            <tr>
                                <th class="table-primary">Último dígito del NIT</th>
        `;
        tax.details.map(d => template += `<th class="table-primary text-center">${d.last_digit_nit}</th>`);
        template += `
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <tr>
                                <td class="table-secondary">Hasta ${getMeses(tax.month)}</td>`;
                            tax.details.map(d => {
                                let [year, month, day] = d.date.split("-").map(String)
                    template += `<td class="text-center ${filter.last_dig == d.last_digit_nit ? 'table-info' : 'table-white'}">${day}</td>`
                            })
                template += `</tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br>`
    })
    return template
}

function template_2(tax){
    const last_digit_nit = Object.entries(tax.last_digit_nit).length;
    var template = `
        <div class="pb-5 w-100">
            <div class="table-responsive text-nowrap">
                <table class="table table-light table-sm table-borderless">
                    <thead>
                        <tr class="">
                            <th rowspan="2" class="center-celda table-primary"><b>Periodo</b></th>
                            <th rowspan="2" class="table-white"></th>
                            <th colspan="${last_digit_nit + 1}"  class="table-primary text-center">Presentación / Pago</th>
                        </tr>
                        <tr>
                            <th class="table-primary">Último dígito del NIT</th>`;
                            Object.entries(tax.last_digit_nit).forEach(([i, d]) => template += `<th class="table-primary">${d}</th>`);
            template += `</tr>
                    </thead>
                    <tbody class="table-border-bottom-0">`;
                    Object.entries(tax.taxes).forEach(([i, t]) => {
                        template += `
                            <tr>
                                <td class="table-primary">${t.title}</td>
                                <td class="table-white"></td>
                                <td class="table-secondary">Hasta ${getMeses(t.month)}</td>`;
                                Object.entries(tax.last_digit_nit).forEach(([i, dig]) => {
                                    let d = t.details.find(dd => dd.last_digit_nit == dig)
                                    let [year, month, day] = d.date.split("-").map(String)
                                    template += `<td class="${filter.last_dig == d.last_digit_nit ? 'table-info' : 'table-white'} ${filter.last_dig} ${d.last_digit_nit}">${day}</td>`;
                                });
                template += `</tr>`
                    });
            template += `</tbody>
                </table>
            </div>
        </div>
        <br>`
    return template;
}

function load_view_general(){
    var data = ``
    const countTotal = categories.reduce((total, category) => total + category.calendaries.length, 0);
    $('#btn-list-category-general div').html(countTotal)
    categories.map(category => {
        let total = category.calendaries.length
        $(`#btn-list-category-${category.id} div`).html(total)
        total > 0 ? $(`#btn-list-category-${category.id} button`).removeClass('disabled') : $(`#btn-list-category-${category.id} button`).addClass('disabled');
        $(`#tax-${category.id}`).html("")
        category.calendaries.map(calendary => {
            var templates = ``;
            switch (calendary.template) {
                case "1":
                    var tem = template_2(calendary);
                    templates += tem
                    $(`#tax-${category.id}`).append(`
                        <div class="card mb-5">
                            <div class="card-body">
                                <div class="slide-in">
                                    <div class="divider my-0">
                                        <div class="divider-text">
                                            <div class="text-center container section-sub_title aos-init aos-animate" data-aos="fade-up">
                                                <h2>${calendary.name}</h2>
                                                <p>${calendary.description}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                ${tem}
                            </div>
                        </div>    
                    `)
                    break;
            
                default:
                    var tem = template_1(calendary.taxes);
                    templates += tem;
                    $(`#tax-${category.id}`).append(`
                        <div class="card mb-5">
                            <div class="card-body">
                                <div class="slide-in">
                                    <div class="divider my-0">
                                        <div class="divider-text">
                                            <div class="text-center container section-sub_title aos-init aos-animate" data-aos="fade-up">
                                                <h2>${calendary.name}</h2>
                                                <p>${calendary.description}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                ${tem}
                            </div>
                        </div>    
                    `)
                    break;
            }
            data += `
                <div class="card mb-5">
                    <div class="card-body">
                        <div class="slide-in">
                            <div class="divider my-0">
                                <div class="divider-text">
                                    <div class="text-center container section-sub_title aos-init aos-animate" data-aos="fade-up">
                                        <h2>${calendary.name}</h2>
                                        <p>${calendary.description}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        ${templates}
                    </div>
                </div>
            `
        })
    })
    $('#navs-left-home').html(data);
}