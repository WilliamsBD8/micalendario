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

      <div class="btn-group" role="group" aria-label="Basic example">
        <a
          href="javascript:void(0);"
          data-bs-toggle="offcanvas"
          data-bs-target="#canvasRegister"
          aria-controls="canvasRegister"
          class="btn btn-primary px-2 px-sm-4 px-lg-2 px-xl-4"
          ><span class="d-none d-md-block">Registrarme</span></a>
          <a
            href="javascript:void(0);"
            data-bs-toggle="offcanvas"
            data-bs-target="#canvasLogin"
            aria-controls="canvasLogin"
            class="btn btn-primary px-2 px-sm-4 px-lg-2 px-xl-4"
            >Iniciar Sesión</span></a>
      </div>
    <div class="d-flex justify-content-between">
    </div>
    `,
    title: '¿Quieres que te recordemos tus fechas de vencimiento?',
    placement: 'left',
    html: true,
    sanitize: false
  });

  console.log(filter);

  $('.btn-floating').click();
})();
