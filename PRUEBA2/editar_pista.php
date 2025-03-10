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
<!-- Se incluye el encabezado común, que abre el HTML, inicia la sesión y carga el CSS -->

<div class="container">
  <!-- Contenedor principal para el contenido de la página -->

  <?php
  include 'includes/conexion.php';
  // Se incluye el archivo de conexión a la base de datos para poder ejecutar consultas SQL

  // Se verifica que se hayan recibido los parámetros 'tipo_pista' e 'id_tipo' por URL
  if (!isset($_GET['tipo_pista']) || !isset($_GET['id_tipo'])) {
      echo "<p>Error: Falta información de la pista.</p>";
      exit(); // Se detiene la ejecución si no se encuentran dichos parámetros
  }
  // Se asignan a variables los valores enviados en la URL
  $tipo_pista = $_GET['tipo_pista'];
  $id_tipo = $_GET['id_tipo'];
  
  // Si se envía el formulario mediante POST, se procesa la actualización
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $estado = $_POST['estado'];
      // Se crea la consulta SQL para actualizar el estado de la pista
      $query = "UPDATE pistas SET estado='$estado' WHERE tipo_pista='$tipo_pista' AND id_tipo='$id_tipo'";
      // Se ejecuta la consulta; si es exitosa, se muestra un mensaje de confirmación
      if (mysqli_query($conexion, $query)) {
          echo "<p>Pista actualizada correctamente.</p>";
      } else {
          // Si ocurre un error, se muestra el mensaje de error con el detalle obtenido
          echo "<p style='color:red;'>Error: " . mysqli_error($conexion) . "</p>";
      }
  }
  
  // Se consulta la base de datos para obtener los datos actuales de la pista a editar
  $query = "SELECT * FROM pistas WHERE tipo_pista='$tipo_pista' AND id_tipo='$id_tipo'";
  $resultado = mysqli_query($conexion, $query);
  $pista = mysqli_fetch_assoc($resultado);
  // Ahora, $pista contiene la información actual de la pista que se va a editar
  ?>

  <h2>Editar Pista</h2>
  <!-- Título de la sección -->

  <!-- Formulario para actualizar el estado de la pista -->
  <form action="editar_pista.php?tipo_pista=<?php echo $tipo_pista; ?>&id_tipo=<?php echo $id_tipo; ?>" method="post">
      <!-- El action incluye los parámetros 'tipo_pista' e 'id_tipo' para mantener la información en la URL -->
      
      <p>Tipo de Pista: <?php echo $tipo_pista; ?></p>
      <!-- Muestra el tipo de pista (por ejemplo, Padel, Tenis, etc.) -->

      <p>ID Pista: <?php echo $id_tipo; ?></p>
      <!-- Muestra el identificador de la pista -->

      <label for="estado">Estado</label>
      <!-- Etiqueta para el selector del estado -->
      
      <select name="estado" id="estado">
          <!-- Menú desplegable para seleccionar el nuevo estado -->
          <option value="Libre" <?php if ($pista['estado'] == 'Libre') echo 'selected'; ?>>Libre</option>
          <option value="Ocupada" <?php if ($pista['estado'] == 'Ocupada') echo 'selected'; ?>>Ocupada</option>
      </select>

      <input type="submit" value="Actualizar">
      <!-- Botón para enviar el formulario y actualizar la información -->
  </form>
  
  <p><a href="panel_admin.php">Volver al Panel</a></p>
  <!-- Enlace para regresar al panel de administración -->
</div>

</body>
</html>

