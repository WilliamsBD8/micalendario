<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <?php
        $color_primary = isset(configInfo()['primary_color']) && !empty(configInfo()['primary_color']) ? (string) configInfo()['primary_color'] : '8e24aa';
        $secondary_color = isset(configInfo()['secundary_color']) && !empty(configInfo()['secundary_color']) ? (string) configInfo()['secundary_color'] : 'ff6e40';
        $color_primary = "$color_primary";
    ?>
    <style>
        .button,.footer,.header{text-align:center}.button a,.footer a{text-decoration:none}body{font-family:Arial,sans-serif;margin:0;padding:0;background-color:#f9f9f9}.email-container{max-width:600px;margin:0 auto;background:#fff;border:1px solid #ddd;border-radius:10px;overflow:hidden;box-shadow:0 2px 5px rgba(0,0,0,.1)}.header{background-color:#<?= $color_primary ?>;color:#fff;padding:20px 10px}.header h1{margin:0;font-size:1.8em}.content{padding:20px;color:#333}.content h2{font-size:1.4em;margin-bottom:10px}.content p{font-size:1em;line-height:1.6;margin:10px 0}.button{margin:20px 0}.button a{display:inline-block;background-color:#08c;color:#fff;padding:10px 20px;border-radius:5px;font-size:1em}.footer{padding:15px 10px;background:#f1f1f1;font-size:.9em;color:#555}.footer a{color:#08c}
    </style>
</head>
<body>
  <div class="email-container">
    <!-- Header -->
    <div class="header">
      <h1>¡Bienvenido(a) a <?= isset(configInfo()['name_app']) ? configInfo()['name_app'] : 'IPLANET' ?>!</h1>
    </div>
    <!-- Content -->
    <div class="content">
      <h2>Hola <?= $user->name ?>,</h2>
      <p>
        Nos alegra mucho que te hayas unido a nuestra plataforma. Estamos comprometidos a ofrecerte la mejor experiencia y ayudarte en todo lo que necesites.
      </p>
      <!-- <p>
        Aquí tienes algunos recursos para empezar:
      </p>
      <ul>
        <li>Accede a tu perfil para personalizar tu cuenta.</li>
        <li>Explora nuestras funciones exclusivas.</li>
        <li>Contáctanos si tienes alguna pregunta.</li>
      </ul> -->
      <!-- <div class="button">
        <a href="[URL_DE_TU_PLATAFORMA]" target="_blank">Ir a mi cuenta</a>
      </div> -->
      <!-- <p>Nuestro proposito es trabajar para que los datos para sean el activo más valioso de las empresas del planeta.</p>
      <p>Saludos,<br>El equipo de <?= isset(configInfo()['name_app']) ? configInfo()['name_app'] : 'IPLANET' ?></p> -->
    </div>
    <!-- Footer -->
    <div class="footer">
      <p>
        Este correo se ha enviado a <?= $user->email ?>. Si no solicitaste este registro, por favor <a href="micalendariotributario@micalendariotributario.com">contáctanos
      </p>
      <p>&copy; Todos los derechos reservados - Mawii</p>
    </div>
  </div>
</body>
</html>
