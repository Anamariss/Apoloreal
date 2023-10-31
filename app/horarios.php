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
    
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    
   
<title>Botón con Imagen</title>
</head>
<body>
    <div class="boton-imagen">
        <input type="file" id="input-imagen" accept="image/*">
        <label for="input-imagen" class="boton-label">Seleccionar Imagen</label>
        <img src="" id="imagen-preview" alt="Imagen previa">
    
   
</div>
  
    <style>
      body {
    font-family: Arial, sans-serif;
    text-align: center;
    padding: 50px;
}

.boton-imagen {
    position: relative;
    display: inline-block;
}

#input-imagen {
    display: none;
}

.boton-label {
    cursor: pointer;
    background-color: #3498db;
    color: #fff;
    padding: 10px 20px;
    border-radius: 5px;
}

#imagen-preview {
    max-width: 100%;
    max-height: 300px;
    margin-top: 10px;
}

    </style>
    <script>
      const inputImagen = document.getElementById('input-imagen');
const imagenPreview = document.getElementById('imagen-preview');

inputImagen.addEventListener('change', (event) => {
    const file = event.target.files[0];

    if (file) {
        const reader = new FileReader();

        reader.onload = (e) => {
            imagenPreview.src = e.target.result;
        };

        reader.readAsDataURL(file);
    } else {
        imagenPreview.src = '';
    }
});

    </script>
      <script src="script.js"></script>

</body>
</html>