<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Apolo</title>

  <meta name="theme-color" content="#ff2e01">
  <meta name="MobileOptimized" content="width">
  <meta name="HandhledFriendly" content="true">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar" content="black-traslucent">

  <!--Tags SEO-->
  <meta name="author" content="Miproyecto">
  <meta name="description" content="Aplicativo para enseñanza de Bootstrap">
  <meta name="keyworks" content="SENA, sena, Sena, Web App, web app, WEB APP">

  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <script src="assets/js/bootstrap.bundle.js"></script>
  <script src="assets/js/nuevo.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body>
  <?php
  require_once 'conexion.php';


  if (isset($_POST['insertar'])) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $documento = $_POST['documento'];
    $edad = $_POST['edad'];
    $email = $_POST['email'];
    $usuario = $_POST['usuario'];
    $clave = password_hash($_POST['clave'], PASSWORD_BCRYPT);

    // Validar que los campos no estén vacíos
    if (!empty($nombre) && !empty($apellido) && !empty($documento) && !empty($edad) && !empty($email) && !empty($usuario) && !empty($clave)) {
      // Preparar la consulta SQL
      $insert = $conn->prepare('INSERT INTO estudiante (nombre, apellido, documento, edad, email, usuario, clave) VALUES (?, ?, ?, ?, ?, ?, ?)');
      $insert->bindParam(1, $nombre);
      $insert->bindParam(2, $apellido);
      $insert->bindParam(3, $documento);
      $insert->bindParam(4, $edad);
      $insert->bindParam(5, $email);
      $insert->bindParam(6, $usuario);
      $insert->bindParam(7, $clave);

      // Ejecutar la consulta y verificar el resultado
      if ($insert->execute()) {
        echo "Registro exitoso";
      } else {
        echo "Error al registrar";
      }
    } else {
      echo "Por Favor llene todos los campos";
    }
  }

  ?>

  
    <form action="" method="POST" enctype="application/x-www-form-urlencoded">
      <section class="form-register">
        <h4>Registro de Alumnos</h4>

        <input class="controls" type="text" name="nombre" placeholder="Ingrese su Nombre" require>

        <input class="controls" type="text" name="apellido" placeholder="Ingrese su Apellido" require>

        <input class="controls" type="text" name="documento" placeholder="Ingrese su Documento" require>

        <input class="controls" type="text" name="edad" required onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="Ingrese su edad">

        <input class="controls" type="email" name="email" required placeholder="Ingrese su Correo">

        <input class="controls" type="text" name="usuario" required placeholder="Ingrese su Usuario">

        <input class="controls" type="password" name="clave" required placeholder="Ingrese su Contraseña">

        <button class="botons" type="submit" name="insertar">Enviar</button>

      </section>
    </form>


    <style>

      .form-register {
        width: 400px;
        background: #24303c;
        padding: 30px;
        margin: auto;
        border-radius: 10px;
        font-family: 'calibri';
        color: white;
        box-shadow: 10px 13px 37px #000;
      }

      .form-register h4 {
        font-size: 22px;
        margin-bottom: 20px;
      }

      .controls {
        width: 100%;
        background: #24303c;
        padding: 5px;
        border-radius: 4px;
        margin-bottom: 16px;
        border: 1px solid #1f53c5;
        font-family: 'calibri';
        font-size: 18px;
        color: white;
      }

      .form-register h4 {
        height: 40px;
        text-align: center;
        font-size: 18px;
        line-height: 40px;
      }

      .form-register a {
        color: white;
        text-decoration: none;
      }

      .form-register a:hover {
        color: white;
        text-decoration: underline;
      }

      .form-register .botons {
        width: 100%;
        background: #1f53c5;
        border: none;
        padding: 12px;
        color: white;
        margin: 16px 0;
        font-size: 16px;
      }
      
    </style>


  </body>

  </html>