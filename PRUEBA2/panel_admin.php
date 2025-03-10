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
  <!-- Contenedor principal que centra el contenido y define un ancho máximo -->

  <?php
  include 'includes/conexion.php';
  // Se incluye el archivo "conexion.php", que establece la conexión a la base de datos

  if (!isset($_SESSION['admin'])) {
      // Se comprueba que exista una sesión iniciada para el administrador
      header("Location: login_admin.php");
      // Si no se ha iniciado la sesión de administrador, se redirige a la página de login para admin
      exit();
      // Se detiene la ejecución del script para evitar mostrar contenido a usuarios no autorizados
  }

  // Se define la consulta SQL para obtener todas las pistas de la base de datos
  $query = "SELECT * FROM pistas";
  // Se ejecuta la consulta usando la conexión previamente establecida
  $resultado = mysqli_query($conexion, $query);
  ?>

  <h1>Panel de Administración</h1>
  <!-- Título principal de la página -->

  <p><a href="logout.php" class="btn btn-logout">Cerrar Sesión</a></p>
  <!-- Enlace con clase "btn btn-logout" para cerrar sesión. Al hacer clic, se ejecuta "logout.php" -->

  <a href="agregar_pista.php" class="btn">Añadir Pista</a>
  <!-- Botón/enlace que redirige a la página para agregar una nueva pista -->

  <table>
    <!-- Tabla que mostrará el listado de pistas -->

    <tr>
      <!-- Fila de encabezado de la tabla -->
      <th>Tipo de Pista</th>
      <th>ID Pista</th>
      <th>Estado</th>
      <th>Acciones</th>
    </tr>

    <?php while ($pista = mysqli_fetch_assoc($resultado)): ?>
      <!-- Bucle que recorre cada registro obtenido de la consulta SQL.
           "mysqli_fetch_assoc" obtiene una fila como un arreglo asociativo -->
    <tr>
      <!-- Fila de la tabla para cada pista -->
      <td><?php echo $pista['tipo_pista']; ?></td>
      <!-- Se muestra el tipo de pista (por ejemplo: Padel, Tenis, etc.) -->

      <td><?php echo $pista['id_tipo']; ?></td>
      <!-- Se muestra el identificador de la pista -->

      <td><?php echo $pista['estado']; ?></td>
      <!-- Se muestra el estado actual de la pista (Libre u Ocupada) -->

      <td>
        <!-- Columna de acciones para cada pista -->
        <a href="editar_pista.php?tipo_pista=<?php echo $pista['tipo_pista']; ?>&id_tipo=<?php echo $pista['id_tipo']; ?>">Editar</a> |
        <!-- Enlace para editar la pista. Se pasan los parámetros "tipo_pista" e "id_tipo" en la URL -->
        <a href="eliminar_pista.php?tipo_pista=<?php echo $pista['tipo_pista']; ?>&id_tipo=<?php echo $pista['id_tipo']; ?>" onclick="return confirm('¿Estás seguro de eliminar esta pista?');">Eliminar</a>
        <!-- Enlace para eliminar la pista. Se muestran los mismos parámetros en la URL y se usa "onclick" para pedir confirmación antes de proceder -->
      </td>
    </tr>
    <?php endwhile; ?>
    <!-- Fin del bucle: se han mostrado todas las pistas obtenidas de la consulta -->
  </table>
</div>

</body>
</html>

