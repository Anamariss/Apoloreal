<!DOCTYPE html>
<html lang="es-CO" data-bs-theme="light">

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

  <link rel="stylesheet" href="../assets/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  <script src="../assets/js/bootstrap.bundle.js"></script>
  <script src="../assets/js/nuevo.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>
<body>

   <div class="box w-50 m-auto bg-primary ">
    <!--Datatables Styles-->
<link rel="stylesheet" type="text/css" href="../assets/datatables/css/dataTables.bootstrap5.min.css">
<!--Datatables Buttons-->
<link rel="stylesheet" type="text/css" href="../assets/datatables/css/buttons.bootstrap5.css">
<!--Datatables Buttons-->
<script type="text/javascript" src="../assets/datatables/js/dataTables.responsive.min.js"></script>
<!--Datatables Scripts-->
<script type="text/javascript" src="../assets/datatables/js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="../assets/datatables/js/jquery.datatables.min.js"></script>
<script type="text/javascript" src="../assets/datatables/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="../assets/datatables/js/dataTables.bootstrap5.min.js"></script>
<!--Botones para exportar-->
<script type="text/javascript" src="../assets/datatables/js/pdfmake.min.js"></script>
<script type="text/javascript" src="../assets/datatables/js/jszip.min.js"></script>
<script type="text/javascript" src="../assets/datatables/js/vfs_fonts.js"></script>
<script type="text/javascript" src="../assets/datatables/js/buttons.html5.js"></script>
<script type="text/javascript" src="../assets/datatables/js/buttons.print.js"></script>
<!--Datatables responsive script-->
<script type="text/javascript" src="../assets/datatables/js/dataTables.responsive.min.js"></script>
<link rel="stylesheet" type="text/css" href="../assets/css/tablas.css">
<script type="text/javascript">
  $(document).ready(function () {
    $('#tableresponsive').DataTable({
      dom: 'Bflrtip',
      buttons: [
        {
          extend: 'copyHtml5',
          footer: 'true',
          titleAtrr: 'copiar',
          className: 'btn btn-outline-info btn-md',
          text: '<i class="bi bi-clipboard"></i>'
        },
        {
          extend: 'excelHtml5',
          footer: 'true',
          titleAtrr: 'excel',
          className: 'btn btn-outline-success btn-md',
          text: '<i class="bi bi-file-earmark-excel"></i>'
        },
        {
          extend: 'pdfHtml5',
          footer: 'true',
          titleAtrr: 'pdf',
          className: 'btn btn-outline-danger btn-md',
          text: '<i class="bi bi-file-earmark-pdf"></i>'
        },
        {
          extend: 'print',
          footer: 'true',
          titleAtrr: 'print',
          className: 'btn btn-outline-primary btn-md',
          text: '<i class="bi bi-printer"></i>'
        },
      ],
      responsive: true,
      language: {
        url: '../assets/datatables/es-ES.json',
      },
    });
  });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js" integrity="sha256-LkC+rZzbNkEleBllGdKANe5nxH0QnRjn4hbw2lW+Hjo=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css" integrity="sha256-VJuwjrIWHWsPSEvQV4DiPfnZi7axOaiWwKfXaJnR5tA=" crossorigin="anonymous">
<?php
/*Función Eliminar registro*/
if (isset($_GET['delete'])) {
    $delete = $conn->prepare('DELETE FROM administrador WHERE idadministrador=?');
    $delete->bindParam(1,$_GET['delete']);
    $delete->execute();

    if ($delete) {
        echo "<script>
        Swal.fire({
          icon: 'successs',
          title: 'Exitoso...',
          text: 'Se elimino correctamente!',
        })
        </script>";
    }else{
        echo "Error al borrar";
    }
  }
?>
  <div class="container pt-1">
      <h1 class="text-center">Administradores</h1>
      <table class="table table-striped table-bordered table-hover mt-1" id="tableresponsive" style="width: 100%;">
        <thead>
          <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Documento</th>
            <th scope="col">Edad</th>
            <th scope="col">Email</th>
            <th scope="col">Usuario</th>
          </tr>
        </thead>
        <tbody>
          <?php
          require_once 'conexion.php';
          $result = $conn->prepare('SELECT * FROM administrador');
          $result->execute();

          while ($view = $result->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <tr>
              <td>
                <?php echo $view["nombre"] ?>
              </td>
              <td>
                <?php echo $view["apellido"] ?>
              </td>
              <td>
                <?php echo $view["documento"] ?>
              </td>
              <td>
                <?php echo $view["edad"] ?>
              </td>
              <td>
                <?php echo $view['email']; ?>
              </td>
              <td>
                <?php echo $view['usuario']; ?>
              </td>
              <td>
              <button type="button" data-bs-toggle="modal" data-bs-target="#delete<?php echo $view['idadministrador']; ?>" class="btn btn-outline-danger" title="Eliminar Datos"><i class="bi bi-trash3-fill"></i></button>
          </td>
            <!-- Modal eliminar datos -->
            <div class="modal fade" id="delete<?php echo $view['idadministrador']; ?>">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">Alerta de datos</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>

                  <!-- Modal body -->
                  <div class="modal-body">
                    Realmente desea eliminar el registro con documento:
                    <p><?php echo $view['documento']; ?></p>
                  </div>

                  <!-- Modal footer -->
                  <div class="modal-footer">
                    <a href="hadmin?page=listaa&delete=<?php echo $view['idadministrador']; ?>" title="Aceptar" class="btn btn-success">Aceptar</a>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                  </div>

                </div>
              </div>
            </div>
        <!-- Modal eliminar datos  -->
              
            </tr>
            <?php
            }
            ?>
           
  </div>
</body>
</html>