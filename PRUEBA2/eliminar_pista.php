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
<!-- Se incluye el archivo header.php, que generalmente contiene la estructura inicial del HTML,
     la apertura de las etiquetas <html>, <head> y <body>, y puede iniciar la sesión. -->

<div class="container">
  <!-- Contenedor principal para centrar y limitar el ancho del contenido -->

  <?php
  include 'includes/conexion.php';
  // Se incluye el archivo de conexión a la base de datos para poder ejecutar consultas SQL.

  // Se verifica que se hayan recibido los parámetros 'tipo_pista' e 'id_tipo' a través de la URL.
  if (!isset($_GET['tipo_pista']) || !isset($_GET['id_tipo'])) {
      echo "<p>Error: Falta información de la pista.</p>";
      exit(); // Si alguno de los parámetros falta, se muestra un mensaje de error y se detiene la ejecución.
  }
  
  // Se asignan a variables los valores recibidos en la URL.
  $tipo_pista = $_GET['tipo_pista'];
  $id_tipo = $_GET['id_tipo'];
  
  // Se crea la consulta SQL para eliminar la pista que coincide con el tipo y el id proporcionados.
  $query = "DELETE FROM pistas WHERE tipo_pista='$tipo_pista' AND id_tipo='$id_tipo'";
  
  // Se ejecuta la consulta y se muestra un mensaje según el resultado.
  if (mysqli_query($conexion, $query)) {
      echo "<p>Pista eliminada correctamente.</p>";
  } else {
      // Si ocurre un error, se muestra el mensaje de error devuelto por MySQL.
      echo "<p style='color:red;'>Error: " . mysqli_error($conexion) . "</p>";
  }
  ?>
  
  <!-- Enlace para regresar al panel de administración -->
  <p><a href="panel_admin.php">Volver al Panel</a></p>
</div>

</body>
</html>

