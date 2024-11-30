async function proceso_fetch(url, data, alert_valid = true, method = 'POST') {
  const isEmpty = (obj) => {
      return Object.keys(obj).length === 0;
  };
  const valid = isEmpty(data);
  if(!valid && alert_valid){
      Swal.fire({
          showConfirmButton: false,
          allowOutsideClick: false,
          customClass: {},
          willOpen: function () {
              Swal.showLoading();
          }
      });
  }
  return fetch(url, {
      method: method,
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(data)
  }).then(async response => {
      if (!response.ok) {
          const errorData = await response.json();
          throw new Error(JSON.stringify({
              msg: errorData.msg || 'Error desconocido',
              title: errorData.title || 'Error en la consulta',
              error: errorData.erro || 'Error general'
          }));
      }
      const responseData = await response.json();
      return new Promise(resolve => {
          setTimeout(() => {
              Swal.close();
              resolve(responseData);
          }, !valid && alert_valid ? 2000 : 0);
      });
  }).catch(error => {
      console.log(error.message);
      const error_parse = JSON.parse(error.message);
      console.log(error_parse);
      return new Promise((_, reject) => {
          setTimeout(() => {
              Swal.close();
              alert(error_parse.title, error_parse.msg, 'error');
              reject(error_parse);
          }, !valid  && alert_valid ? 2000 : 0);
      });
  });
}

function alert(title = 'Alert', msg = 'Alert', icon = 'success'){
  var shortCutFunction = icon,
      prePositionClass = 'toast-top-right';

  prePositionClass =
      typeof toastr.options.positionClass === 'undefined' ? 'toast-top-right' : toastr.options.positionClass;
  toastr.options = {
      maxOpened: 10,
      autoDismiss: true,
      closeButton: true,
      newestOnTop: true,
      progressBar: true,
      preventDuplicates: true,
      // timeOut: 0,             // Duración en milisegundos (0 significa que no se cierra automáticamente)
      // extendedTimeOut: 0,
      onclick: null,
      tapToDismiss: true,
  };
  var $toast = toastr[shortCutFunction](msg, title); // Wire up an event handler to a button in the toast, if it exists
  if (typeof $toast === 'undefined') {
    return;
  }
}

function base_url(array = []) {
  var url = localStorage.getItem('url') ? localStorage.getItem('url') : 'http://calendar.will/';
  if (array.length == 0) return `${url}`;
  else return `${url}${array.join('/')}`;
}