<!doctype html>
<html lang="es">

<head>
  <title>Notas de paz</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  <script src="../assets/js/bootstrap.bundle.js"></script>
  <link rel="stylesheet" href="Tform.css">
</head>

<body>
  <?php
  require_once 'conexion.php';


  if (isset($_POST['insertar'])) {
    $nombre = $_POST['nombre'];
    $numero = $_POST['numero'];
    $seccion = $_POST['seccion'];

    // Validar que los campos no estén vacíos
    if (!empty($nombre) && !empty($numero) && !empty($seccion)) {
      // Preparar la consulta SQL
      $insert = $conn->prepare('INSERT INTO instrumento (nombre, numero, seccion) VALUES (?, ?, ?)');
      $insert->bindParam(1, $nombre);
      $insert->bindParam(2, $numero);
      $insert->bindParam(3, $seccion);

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
  <header class="list">
  </header>
  <form action="" method="POST" enctype="application/x-www-form-urlencoded">
    <section class="form-register">
      <h4>Registro de Instrumentos</h4>

      <input class="controls" type="text" name="nombre" placeholder="Ingrese el Instrumento" require>

      <input class="controls" type="number" name="numero" required onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="Ingrese cantidad">

      <div class="mb-3">
        <h5 class="text-center">Tipo</h5>
        <select name="seccion" id="seccion" class="form-control">
          <option value="Banda">Banda</option>
          <option value="Coro">Coro</option>
          <option value="Estudiantina">Estudiantina</option>
        </select>
      </div>
      <br>
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

    .form-control {
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