<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Club Deportivo</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
  <!-- Contenedor principal para centrar y limitar el ancho del contenido -->
  
  <h2>Añadir Pista</h2>
  <!-- Título de la sección -->

  <?php
  include 'includes/conexion.php';
  // Se incluye el archivo de conexión a la base de datos para poder ejecutar consultas

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Se comprueba si el formulario fue enviado mediante el método POST

      $tipo_pista = $_POST['tipo_pista'];
      // Se obtiene el valor del campo 'tipo_pista' del formulario y se almacena en la variable

      $id_tipo = $_POST['id_tipo'];
      // Se obtiene el valor del campo 'id_tipo' del formulario

      $estado = $_POST['estado'];
      // Se obtiene el valor del campo 'estado' del formulario

      $query = "INSERT INTO pistas (tipo_pista, id_tipo, estado) VALUES ('$tipo_pista', '$id_tipo', '$estado')";
      // Se crea la consulta SQL para insertar una nueva pista en la tabla 'pistas'

      if (mysqli_query($conexion, $query)) {
          // Se ejecuta la consulta; si la operación es exitosa, se muestra un mensaje de confirmación
          echo "<p>Pista añadida correctamente.</p>";
      } else {
          // Si ocurre un error al ejecutar la consulta, se muestra el mensaje de error con el detalle devuelto por MySQL
          echo "<p style='color:red;'>Error: " . mysqli_error($conexion) . "</p>";
      }
  }
  ?>
  <!-- Fin del bloque PHP que procesa el formulario -->

  <form action="agregar_pista.php" method="post">
    <!-- Formulario que envía los datos a 'agregar_pista.php' mediante el método POST -->
    
    <label for="tipo_pista">Tipo de Pista</label>
    <!-- Etiqueta para el selector de tipo de pista -->
    
    <select name="tipo_pista" id="tipo_pista">
      <!-- Menú desplegable para seleccionar el tipo de pista -->
      <option value="Padel">Padel</option>
      <option value="Tenis">Tenis</option>
      <option value="Futbol">Fútbol</option>
      <option value="Golf">Golf</option>
      <option value="Baloncesto">Baloncesto</option>
    </select>
    
    <label for="id_tipo">ID Pista</label>
    <!-- Etiqueta para el campo de número que identifica la pista -->
    
    <input type="number" name="id_tipo" id="id_tipo" required>
    <!-- Campo de entrada numérico para el ID de la pista. El atributo "required" indica que es obligatorio -->
    
    <label for="estado">Estado</label>
    <!-- Etiqueta para el selector del estado de la pista -->
    
    <select name="estado" id="estado">
      <!-- Menú desplegable para seleccionar el estado de la pista -->
      <option value="Libre">Libre</option>
      <option value="Ocupada">Ocupada</option>
    </select>
    
    <input type="submit" value="Añadir">
    <!-- Botón de envío para enviar el formulario -->
  </form>
  
  <p><a href="panel_admin.php">Volver al Panel</a></p>
  <!-- Enlace para regresar al panel de administración -->
</div>

</body>
</html>
