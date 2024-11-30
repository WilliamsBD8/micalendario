// /**
//  * UI Tooltips & Popovers
//  */

'use strict';

(function () {
  const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
  const popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
    return new bootstrap.Popover(popoverTriggerEl);
  });

  var popoverTrigger = document.querySelector('.btn-floating');

  // Inicializar el popover
  const popover = new bootstrap.Popover(popoverTrigger, {
    content: `
        <a
          href="javascript:void(0);"
          data-bs-toggle="offcanvas"
          data-bs-target="#canvasRegister"
          aria-controls="canvasRegister"
          class="btn btn-primary px-2 px-sm-4 px-lg-2 px-xl-4">
          <span class="tf-icons ri-user-line me-md-1"></span>
          <span class="d-none d-md-block">${filter.nit.status ? 'Iniciar Sesion' : 'Registro'}</span>
        </a>
    `,
    title: '¿Quieres que te recordemos tus fechas de vencimiento?',
    placement: 'left',
    html: true,
    sanitize: false
  });

  console.log(filter);

  $('.btn-floating').click();
})();
