$(() => {
  const $offcanvas = $('.offcanvas');
  $offcanvas.on('show.bs.offcanvas', function () {
    $('.btn-floating').click();
  });
  $offcanvas.on('hide.bs.offcanvas', function () {
    $('.btn-floating').click();
  });
  load_view_general();

  if(!isEmptyJson(user_calendar)){
    console.log(user_calendar);
    $("#company-id").val(user_calendar.company.id);
    $("#name-company").val(user_calendar.company.name);
    $("#email-notify").val(user_calendar.email);
    const emails = user_calendar.company.emails != null && user_calendar.company.emails != "" ? user_calendar.company.emails.split(" ") : [];
    $("#email-notify-2").val(emails[0]);
    $("#email-notify-3").val(emails.length == 2 ? emails[1] : "");
    $("#nit-notify").val(user_calendar.company.nit);
    $("#first_working_day").prop("checked", Boolean(parseInt(user_calendar.company.first_working_day)))
    $("#three_days_due").prop("checked", Boolean(parseInt(user_calendar.company.three_days_due)))
    $("#due_date").prop("checked", Boolean(parseInt(user_calendar.company.due_date)))
  }

});

function validateForm(e = false){
  const nit = $("#nit").val();
  if(nit != ""){
    if(nit.length !== 9 && nit.length !== 10){
      e.preventDefault();
      alert('Campo Obligatorio', 'Número de NIT no válido.', 'warning')
    }
  }
}

async function notify(e){
  e.preventDefault();
  let data_valid = [
    {name: 'Nombre de la empresa', id:"name-company"},
    {name: 'Correo de notificación', id:"email-notify"},
    {name: 'Nit', id:"nit-notify"},
  ];
  const valid = data_valid.every( d => {
    if ($(`#${d.id}`).val().trim() === "") {
      alert("", `El campo <b>${d.name}</b> es obligatorio.`, 'warning');
      return false
    }else if(d.id == "nit-notify"){
      if($(`#${d.id}`).val().length != 9){
        alert('', 'Número de NIT no válido.', 'warning')
      }
    }
    return true
  })

  if (!valid) {
    return; // Detén la ejecución si hay campos vacíos
  }
  toastr.clear();

  let data = {
    name: $('#name-company').val(),
    email: $('#email-notify').val(),
    email_2: $('#email-notify-2').val(),
    email_3: $('#email-notify-3').val(),
    nit: $('#nit-notify').val(),
    first_working_day: $('#first_working_day').prop('checked'),
    three_days_due: $('#three_days_due').prop('checked'),
    due_date: $('#due_date').prop('checked'),
    company: $('#company-id').val()
  }

  let url = base_url(['updated/company']);

  const res = await proceso_fetch(url, data);
  alert(res.title, res.msg, 'success');
  $('#btn-cancel-notify').click();
  console.log(res);
  $('#email-notify-2').val(res.date_p.email_2)
  $('#email-notify-3').val(res.date_p.email_3)
}

async function register(e){
  e.preventDefault();
  toastr.clear();
  const form = $(e.target); // Captura el formulario
  const formData = form.serializeArray().reverse(); // Serializa los datos
  let isValid = true;
  let i = 1;
  formData.forEach((item) => {
    const input = form.find(`[name="${item.name}"]`);
    const value = item.value.trim(); // Eliminar espacios en blanco
    const label = input.siblings('label').text(); // Obtiene el atributo 'for'
    if (!value) {
      i += 1;
      isValid = false;
      alert('Campo Obligatorio', `El campo <b>${label}</b> es obligatorio.`, 'warning', ((i + 5) * 1000));
    }else if(item.name == "register-nit" && value.length !== 9 && value.length !== 10){
      i += 1;
      isValid = false;
      alert('Campo Obligatorio', `El campo <b>${label}</b> no es válido.`, 'warning', ((i + 5) * 1000));
    }
  });
  if(!isValid) return
  const data = formData.reduce((obj, item) => {
    const key = item.name.replace(/-/g, "_"); // Reemplazar "-" por "_"
    obj[key] = item.value.trim(); // Asignar el valor al JSON
    return obj;
  }, {});
  let url = base_url(['register/home']);
  const res = await proceso_fetch(url, data);
  window.location.href = base_url();
  return alert('', 'Usuario y empresa registrado con exito', 'success');
}

async function login(e){
  e.preventDefault();
  toastr.clear();
  const form = $(e.target); // Captura el formulario
  const formData = form.serializeArray().reverse(); // Serializa los datos
  let isValid = true;

  formData.forEach((item, i ) => {
    const input = form.find(`[name="${item.name}"]`);
    const value = item.value.trim(); // Eliminar espacios en blanco
    const label = input.siblings('label').text(); // Obtiene el atributo 'for'
    if (!value) {
      isValid = !isValid;
      return alert('Campo Obligatorio', `El campo <b>${label}</b> es obligatorio.`, 'warning', ((i + 5) * 1000));
    }
  });

  if(!isValid) return

  const data = formData.reduce((obj, item) => {
    const key = item.name.replace(/-/g, "_"); // Reemplazar "-" por "_"
    obj[key] = item.value.trim(); // Asignar el valor al JSON
    return obj;
  }, {});

  console.log(data);

  let url = base_url(['login/home']);
  const res = await proceso_fetch(url, data);
  window.location.href = base_url();
  // return alert('', 'Usuario y empresa registrado con exito', 'success')
}

async function findNit(e){
  e.preventDefault();
  var nit = $('#nit').val();
  if(nit != ''){
    if(nit.length !== 9 && nit.length !== 10){
      return alert('Campo Obligatorio', 'Número de NIT no válido.', 'warning')
    }
  }
  let url = base_url();
  let data = {
    nit,
    anio: $('#anio-tax').val(),
    mes: $('#mes-tax').val()
  }

  var valid_change = Object.entries(data).some(([i, data_post]) => data_post != filter[i]);
  if(valid_change){
    const res = await proceso_fetch(url, data, 500);
    Object.assign(filter, res.filter);
    Object.assign(categories, res.data);
    load_view_general();
    if(filter.nit != ""){
      $('.title-NIT').show();
      $('#nit-text-title').html(`NIT ${filter.nit}`);
    }else $('.title-NIT').hide();
    $('#btn-list-category-general button').click();
  }
}

function clickButton(){
    Swal.fire({
        title: "¿Quieres que te recordemos tus fechas vencimientos?",
        showDenyButton: true,
        confirmButtonText: "Si",
        denyButtonText: `No`
    }).then((result) => {
        if (result.isConfirmed) {
            $('#register').offcanvas('show');
        }
    });
}

function changeYear(year){
    $('#div-select-mounth').html('');
    const meses = [
        "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
        "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
    ];

    let anio = dates.find(d => d.anio == year);
    let options = anio.meses.map(m => {
        let option = `<option ${filter.mes == m ? 'selected' : ''} value="${m} ">${meses[m - 1]}</option>`
        return option
    })

    let new_select = `
        <select
            id="mes-tax"
            class="select2 form-select form-select-lg"
            data-allow-clear="true" data-default="Seleccionar mes" name="mes">
            <option value="" selected>Seleccionar mes</option>
            ${options}
        </select>
        <label for="mes-tax">Mes</label>
    `
    $('#div-select-mounth').html(new_select);
    const select2 = $('.select2');
    select2.each(function () {
        var $this = $(this);
        select2Focus($this);
        $this.wrap('<div class="position-relative"></div>').select2({
          placeholder: $this.attr('data-default') != undefined ? `${$this.attr('data-default')}` : 'Select value',
          dropdownParent: $this.parent()
        });
    });
}

function validTC(){
  var check = $('#accept-tc').prop('checked');
  $('#btn-send-register').attr('disabled', !check)
}

$(document).on('click', '.ul-primary .nav-link', function () {
    const tabText = $(this).text();
    const meses = [
      "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
      "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
    ];
    $('#title-tab').removeClass('slide-in');
    setTimeout(() => {
        $('#title-tab').html(`
            <div class="text-center container section-title aos-init aos-animate" data-aos="fade-up">
                <h2> ${filter.mes != '' ? `${meses[filter.mes - 1]} - ` : ''}${filter.anio}</h2>
                <p>${tabText}</p>
            </div>
        `);
        $('#title-tab').addClass('slide-in');
    }, 10);
});

