$(() => {
  const $offcanvasRegister = $('#canvasRegister');
  $offcanvasRegister.on('show.bs.offcanvas', function () {
    $('.btn-floating').click();
  });
  $offcanvasRegister.on('hide.bs.offcanvas', function () {
    $('.btn-floating').click();
  });

  const $offcanvasSettingNotify = $('#canvasNotify');
  $offcanvasSettingNotify.on('show.bs.offcanvas', function () {
    $('.btn-floating').click();
  });
  $offcanvasSettingNotify.on('hide.bs.offcanvas', function () {
    $('.btn-floating').click();
  });
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
  let nit = $('#register-nit').val();
  if(nit == '')
    return alert('', 'El campo <b>Nit</b> es obligatorio.', 'warning');

  if(nit.length !== 9 && nit.length !== 10){
    return alert('Campo Obligatorio', 'Número de NIT no válido.', 'warning')
  }

  let name = $('#register-name').val();
  if(name == '')
    return alert('', 'El campo <b>Nombre del dueño</b> es obligatorio.', 'warning')

  let name_company = $('#register-name-company').val();
  if(name_company == '')
    return alert('', 'El campo <b>Nombre de la compañia</b> es obligatorio.', 'warning')

  let email = $('#register-email').val();
  if(email == '')
    return alert('', 'El campo <b>Email</b> es obligatorio.', 'warning')

  let captcha = $('#captcha').val();
  if(captcha == '')
    return alert('', 'El campo <b>captcha</b> es obligatorio.', 'warning')

  let data = {
    nit, name, name_company, email, captcha
  }
  let url = base_url(['register/home']);
  const res = await proceso_fetch(url, data);
  // $('#btn-cancel-login-register').click();
  window.location.href = base_url();
  return alert('', 'Usuario y empresa registrado con exito', 'success');
}

async function login(e){
  e.preventDefault();
  let email = $('#login-email').val();
  if(email == '')
    return alert('Campo Obligatorio', 'El campo email es obligatorio.', 'warning')
  let password = $('#login-password').val();
  if(password == '')
    return alert('Campo Obligatorio', 'El campo contraseña es obligatorio.', 'warning')
  let captcha = $('#captcha').val();
  if(captcha == '')
    return alert('Campo Obligatorio', 'El campo captcha es obligatorio.', 'warning')
  let data = {
    email, password, captcha
  }
  let url = base_url(['login/home']);
  const res = await proceso_fetch(url, data);
  window.location.href = base_url();
  // return alert('', 'Usuario y empresa registrado con exito', 'success')
}

async function findNit(e){
    e.preventDefault();
    var nit = $('#nit').val();
    if(nit != ''){
        let url = base_url(['findNit']);
        let data = {nit}
        const res = await proceso_fetch(url, data);
        if(!res.status){
            $('#div_btn_floating').show()
            setTimeout(() => {
                clickButton()
            }, 1000)
        }else{
            $('#div_btn_floating').hide()
        }
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
  $('#btn-send-register-login').attr('disabled', !check)
}

$(document).on('click', '.ul-primary .nav-link', function () {
    const tabText = $(this).text(); // Obtener el texto de la pestaña seleccionada
    const meses = [
      "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
      "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
    ];
    $('#title-tab').removeClass('slide-in'); // Elimina la animación anterior (si existe)
    // Vuelve a aplicar la animación después de un pequeño retraso para reiniciarla
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