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
  <!-- Contenedor principal para el contenido, con un ancho máximo definido en el CSS -->

  <?php
  include 'includes/conexion.php';
  // Se incluye el archivo de conexión a la base de datos para ejecutar consultas SQL

  if (!isset($_SESSION['cliente'])) {
      // Se verifica que la sesión del cliente esté iniciada. Si no lo está:
      header("Location: login.php");
      // Se redirige a la página de login para clientes
      exit();
      // Se detiene la ejecución del script para evitar que se muestre contenido a usuarios no autenticados
  }
  // Se asigna a la variable $cliente la información del cliente almacenada en la sesión
  $cliente = $_SESSION['cliente'];

  // Se define la consulta para obtener todas las pistas de la base de datos
  $pistas_query = "SELECT * FROM pistas";
  // Se ejecuta la consulta y se almacena el resultado en $pistas_result
  $pistas_result = mysqli_query($conexion, $pistas_query);
  ?>

  <!-- Menú de navegación para el cliente -->
  <div class="client-menu">
    <!-- Enlaces para navegar por las diferentes secciones del panel del cliente -->
    <a href="tipo_pista.php">Listado de Pistas</a>
    <!-- Redirige a la página donde se muestran los tipos de pistas -->
    <a href="panel_cliente.php#reservar">Mis Reservas</a>
    <!-- Redirige al panel del cliente y salta a la sección "Reservar" usando un ancla -->
    <a href="menu_cliente.php" class="btn-logout">Volver</a>
    <!-- Enlace para volver al menú del cliente -->
    <a href="logout.php" class="btn-logout">Cerrar Sesión</a>
    <!-- Enlace para cerrar la sesión -->
  </div>

  <!-- Título de bienvenida con el nombre del cliente -->
  <h1>Bienvenido, <?php echo $cliente['nombre']; ?></h1>
  <!-- Se muestra otro enlace para cerrar sesión (opcional, podría eliminarse si ya está en el menú) -->
  <p><a href="logout.php" class="btn btn-logout">Cerrar Sesión</a></p>

  <!-- Sección "Listado de Pistas" -->
  <h2>Listado de Pistas</h2>
  <table>
    <!-- Encabezado de la tabla -->
    <tr>
      <th>Tipo de Pista</th>
      <th>ID Pista</th>
      <th>Estado</th>
      <th>Acción</th>
    </tr>
    <?php while ($pista = mysqli_fetch_assoc($pistas_result)): ?>
      <!-- Bucle que recorre cada registro de la consulta a la tabla 'pistas' -->
    <tr>
      <td><?php echo $pista['tipo_pista']; ?></td>
      <!-- Muestra el tipo de pista (por ejemplo: Padel, Tenis, etc.) -->
      <td><?php echo $pista['id_tipo']; ?></td>
      <!-- Muestra el identificador de la pista -->
      <td><?php echo $pista['estado']; ?></td>
      <!-- Muestra el estado actual de la pista (Libre u Ocupada) -->
      <td>
        <?php if ($pista['estado'] == 'Libre'): ?>
          <!-- Si el estado de la pista es "Libre", se muestra un enlace para reservarla -->
          <a href="reservar.php?tipo_pista=<?php echo $pista['tipo_pista']; ?>&id_tipo=<?php echo $pista['id_tipo']; ?>">Reservar</a>
        <?php else: ?>
          <!-- Si la pista no está libre, se muestra el texto "Ocupada" -->
          Ocupada
        <?php endif; ?>
      </td>
    </tr>
    <?php endwhile; ?>
    <!-- Fin del bucle, se han mostrado todas las pistas -->
  </table>
  
  <!-- Sección "Mis Reservas" -->
  <h2 id="reservar">Mis Reservas</h2>
  <?php
  // Se obtiene el id del cliente (socios) de la sesión
  $cliente_id = $cliente['id_socio'];
  
  // Se define la consulta para obtener las reservas activas del cliente.
  // Se usa una subconsulta para obtener, para cada combinación de tipo e id de pista, la reserva con el máximo id (la última reserva)
  // Luego se hace un JOIN con la tabla "pistas" para asegurar que la pista siga en estado 'Ocupada'
  $reservas_query = "SELECT r.id_reserva, r.tipo_pista, r.id_tipo
                     FROM reservas r
                     JOIN (
                         SELECT tipo_pista, id_tipo, MAX(id_reserva) AS max_id
                         FROM reservas
                         GROUP BY tipo_pista, id_tipo
                     ) latest ON r.tipo_pista = latest.tipo_pista
                                AND r.id_tipo = latest.id_tipo
                                AND r.id_reserva = latest.max_id
                     JOIN pistas p ON r.tipo_pista = p.tipo_pista
                                   AND r.id_tipo = p.id_tipo
                     WHERE r.id_socio = $cliente_id
                       AND p.estado = 'Ocupada'";
  // Se ejecuta la consulta y se almacena el resultado en $reservas_result
  $reservas_result = mysqli_query($conexion, $reservas_query);

  // Si se obtienen reservas, se muestran en una tabla
  if (mysqli_num_rows($reservas_result) > 0) {
      echo "<table>
              <tr>
                <th>ID Reserva</th>
                <th>Tipo de Pista</th>
                <th>ID Pista</th>
              </tr>";
      while ($res = mysqli_fetch_assoc($reservas_result)) {
          echo "<tr>
                  <td>" . $res['id_reserva'] . "</td>
                  <td>" . $res['tipo_pista'] . "</td>
                  <td>" . $res['id_tipo'] . "</td>
                </tr>";
      }
      echo "</table>";
  } else {
      // Si no hay reservas activas, se muestra un mensaje informativo
      echo "<p>No tienes reservas activas.</p>";
  }
  ?>
</div>

</body>
</html>

