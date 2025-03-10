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
<div class="container">
  <!-- Contenedor principal para centrar y limitar el ancho del contenido -->

  <?php
  include 'includes/conexion.php';
  // Se incluye el archivo de conexión a la base de datos

  if (!isset($_SESSION['cliente'])) {
      // Se verifica que el usuario esté logueado como cliente
      header("Location: login.php");
      // Si no está logueado, se redirige a la página de login
      exit();
  }

  // Se verifica que los parámetros 'tipo_pista' e 'id_tipo' hayan sido enviados por la URL
  if (!isset($_GET['tipo_pista']) || !isset($_GET['id_tipo'])) {
      echo "<p>Error: Falta información de la pista.</p>";
      exit(); // Se detiene la ejecución si no se tienen los datos necesarios
  }

  // Se asignan los valores recibidos por GET a variables
  $tipo_pista = $_GET['tipo_pista'];
  $id_tipo    = $_GET['id_tipo'];

  // Se consulta la base de datos para obtener el estado de la pista correspondiente
  $query = "SELECT estado FROM pistas WHERE tipo_pista='$tipo_pista' AND id_tipo='$id_tipo' LIMIT 1";
  $resultado = mysqli_query($conexion, $query);

  // Se verifica que la consulta haya devuelto algún resultado
  if (!$resultado || mysqli_num_rows($resultado) == 0) {
      echo "<p>Pista no encontrada.</p>";
      exit();
  }
  // Se obtiene la información de la pista como un arreglo asociativo
  $pista = mysqli_fetch_assoc($resultado);

  // Se comprueba si la pista ya está ocupada
  if ($pista['estado'] == 'Ocupada') {
      echo "<p>Esta pista ya está ocupada.</p>";
      echo "<p><a href='panel_cliente.php'>Volver al Panel</a></p>";
      exit();
  }

  // Se prepara la consulta para actualizar el estado de la pista a "Ocupada"
  $update_query = "UPDATE pistas SET estado='Ocupada' WHERE tipo_pista='$tipo_pista' AND id_tipo='$id_tipo'";
  
  // Se ejecuta la actualización y, si es exitosa, se procede a registrar la reserva
  if (mysqli_query($conexion, $update_query)) {
      // Se obtiene la información del cliente desde la sesión
      $cliente = $_SESSION['cliente'];
      // Se define la fecha actual
      $fecha = date('Y-m-d');
      // Se definen horarios predeterminados (en este caso, sin horarios específicos)
      $hora_inicio = "00:00:00";
      $hora_fin = "00:00:00";
      // Se prepara la consulta para insertar la reserva en la tabla "reservas"
      $insert_query = "INSERT INTO reservas (id_socio, tipo_pista, id_tipo, fecha, hora_inicio, hora_fin)
                       VALUES (" . $cliente['id_socio'] . ", '$tipo_pista', '$id_tipo', '$fecha', '$hora_inicio', '$hora_fin')";
      // Se ejecuta la inserción de la reserva
      mysqli_query($conexion, $insert_query);
      // Se muestra un mensaje de éxito
      echo "<p>Reserva realizada con éxito. La pista ahora está ocupada.</p>";
  } else {
      // En caso de error al actualizar el estado de la pista, se muestra un mensaje de error con el detalle
      echo "<p>Error al reservar la pista: " . mysqli_error($conexion) . "</p>";
  }
  ?>
  <!-- Enlace para volver al panel del cliente -->
  <p><a href="panel_cliente.php">Volver al Panel</a></p>
</div>

</body>
</html>

