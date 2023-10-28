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

    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/bootstrap.bundle.js"></script>
    <script src="assets/js/nuevo.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body>
    <section class="pt-5">
        <div class="container">
            <h1>Cronograma de Eventos</h1>

            <div id="event-form">

                <label for="nombre" class="form-label"></label>
                <input type="text" id="event-name" name="nombre" placeholder="Nombre del evento" required>

                <label for="fecha" class="form-label"></label>
                <input type="date" id="event-date" name="fecha">

                <a class="btn btn-primary p-1" href="Eventos.html">Agregar evento</a>

            </div>
            <ul id="event-list">
            </ul>

            <input type="file" id="event-image" accept="image/*">
            <div id="image-preview">
                <img src="#" alt="Imagen" id="uploaded-image">
            </div>

            <div id="comment-section">
                <label for="descripcion" class="form-label" name="descripcion"></label>
                <textarea id="event-comment" placeholder="Agregar un comentario"></textarea>
            </div>
        </div>
    </section>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        #event-form {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .delete-button {
            background-color: #ff0000;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;

        }

        #event-image {
            margin-top: 20px;
        }

        #image-preview {
            text-align: center;
            margin-top: 20px;
        }

        #uploaded-image {
            max-width: 100%;
            max-height: 200px;
            margin-top: 10px;
        }

        #comment-section {
            margin-top: 20px;
        }

        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: vertical;
            min-height: 100px;
        }
    </style>

<?php
  require_once 'conexion.php';
  
  
      if(isset($_POST['insertar'])) {
        $nombre = $_POST['nombre'];
        $fecha = $_POST['fecha'];
        $descripcion = $_POST['descripcion'];
  
          // Validar que los campos no estén vacíos
          if (!empty($nombre) && !empty($fecha) && !empty($descripcion)) {
              // Preparar la consulta SQL
              $insert = $conn->prepare('INSERT INTO evento (nombre, fecha, descripcion) VALUES (?, ?, ?)');
              $insert->bindParam(1, $nombre);
              $insert->bindParam(2, $fecha);
              $insert->bindParam(3, $descripcion);
  
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


    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const eventForm = document.getElementById("event-form");
            const eventNameInput = document.getElementById("event-name");
            const eventDateInput = document.getElementById("event-date");
            const eventTimeInput = document.getElementById("event-time");
            const eventList = document.getElementById("event-list");

            eventForm.addEventListener("submit", function (e) {
                e.preventDefault();
                const eventName = eventNameInput.value;
                const eventDate = eventDateInput.value;
                const eventTime = eventTimeInput.value;

                if (eventName && eventDate && eventTime) {
                    const eventItem = document.createElement("li");
                    eventItem.innerHTML = `
                            ${eventName} - ${eventDate} ${eventTime}
                            <button class="delete-button">Eliminar</button>
                        `;
                    eventList.appendChild(eventItem);

                    eventNameInput.value = "";
                    eventDateInput.value = "";
                    eventTimeInput.value = "";

                    // Agregar evento para eliminar
                    const deleteButton = eventItem.querySelector(".delete-button");
                    deleteButton.addEventListener("click", function () {
                        eventList.removeChild(eventItem);
                    });
                }
            });
        });
        document.addEventListener("DOMContentLoaded", function () {

            const eventImageInput = document.getElementById("event-image");
            const imagePreview = document.getElementById("uploaded-image");

            eventImageInput.addEventListener("change", function () {
                const file = eventImageInput.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        imagePreview.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });

        });
        document.addEventListener("DOMContentLoaded", function () {

            const eventCommentInput = document.getElementById("event-comment");

            eventForm.addEventListener("submit", function (e) {
                e.preventDefault();
                const eventName = eventNameInput.value;
                const eventDate = eventDateInput.value;
                const eventTime = eventTimeInput.value;
                const eventComment = eventCommentInput.value;
                if (eventName && eventDate && eventTime) {
                    const eventItem = document.createElement("li");
                    eventItem.innerHTML = `
                          ${eventName} - ${eventDate} ${eventTime}
                          <p>${eventComment}</p>
                          <img src="${imagePreview.src}" alt="Imagen">
                          <button class="delete-button">Eliminar</button>
                      `;
                    eventList.appendChild(eventItem);

                    eventNameInput.value = "";
                    eventDateInput.value = "";
                    eventTimeInput.value = "";
                    eventCommentInput.value = "";
                    imagePreview.src = "";


                    const deleteButton = eventItem.querySelector(".delete-button");
                    deleteButton.addEventListener("click", function () {
                        eventList.removeChild(eventItem);
                    });
                }
            });


        });

    </script>
</body>

</html>

</html>