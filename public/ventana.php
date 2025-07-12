<?php
    // Incluimos el archivo que contiene la configuración y la conexión a la base de datos
    require_once '../config/db.php';

    // Guardamos en la variable $query la consulta SQL para seleccionar 
    // todos los usuarios y obtener sus columnas ID, nombre, correo y cargo
    $query = "SELECT ID_USUARIO, NOMBRE, CORREO, CARGO FROM USUARIO";
    // Preparamos la consulta SQL usando el objeto $conn (la conexión)
    $stmt = $conn->prepare($query);
    // Ejecutamos la consulta preparada
    $stmt->execute();
    // Obtenemos el resultado de la consulta en un objeto mysqli_result 
    //y lo guardamos en $resultado_usuarios
    $resultado_usuarios = $stmt->get_result();

    // Guardamos en la variable $query una nueva consulta SQL para obtener
    // solo el usuario que tenga ID_USUARIO igual a 2
    $query = "SELECT ID_USUARIO, NOMBRE, CORREO, CARGO FROM USUARIO WHERE ID_USUARIO = 2";
    // Preparamos la segunda consulta SQL
    $stmt = $conn->prepare($query);
    // Ejecutamos la segunda consulta preparada
    $stmt->execute();
    // Obtenemos el resultado de la segunda consulta y lo guardamos en $resultado_unico
    $resultado_unico = $stmt->get_result();
?>
<!DOCTYPE html> <!-- Indica al navegador que el documento es HTML5 -->
<html lang="es"> <!-- Define el idioma principal de la página como español -->
<head>
    <meta charset="UTF-8"> <!-- Define la codificación de caracteres para que soporte tildes y caracteres especiales -->
    <title>Artesanos</title> <!-- Define el título que aparecerá en la pestaña del navegador -->
    <link rel="stylesheet" href="../styles/estyle.css"> <!-- Vincula el archivo de estilos CSS para aplicar diseño -->
</head>
<body> <!-- Inicio del cuerpo de la página -->

<main class="main"> <!-- Contenedor principal del contenido, usa la clase 'main' para estilos -->

    <br> <!-- Salto de línea para dar espacio visual -->
    <br> <!-- Otro salto de línea -->
    <br> <!-- Otro salto de línea -->

    <h1>RESULTADO DE BUSQUEDA DE TODOS LOS USUARIOS</h1> <!-- Título que describe la sección que lista todos los usuarios -->
    
    <br> <!-- Más espacios para separar el contenido visualmente -->
    <br>
    <br>
    
    <!-- Verifica si hay filas en el resultado de la consulta de todos los usuarios -->
    <?php if ($resultado_usuarios->num_rows > 0): ?>
        <!-- Contenedor para organizar las tarjetas en filas -->
        <div class="row-cards"> 
        <!-- Itera sobre cada fila (usuario) del resultado -->    
        <?php while ($usuario = $resultado_usuarios->fetch_assoc()): ?> 
                <!-- Tarjeta individual para cada usuario -->
                <div class="card">
                 <!-- Contenedor del contenido principal de la tarjeta -->    
                <div class="card-body">
                        <p class="card-text">
                            <!-- Muestra el ID del usuario, escapando caracteres especiales -->
                            <?php echo htmlspecialchars($usuario['ID_USUARIO']); ?> 
                        </p>
                        <p class="card-text-des">
                            <!-- Muestra el nombre del usuario, escapando caracteres especiales -->
                            <?php echo htmlspecialchars($usuario['NOMBRE']); ?>
                        </p>
                        <p class="card-text-des">
                            <!-- Muestra el correo del usuario, escapando caracteres especiales -->
                            <?php echo htmlspecialchars($usuario['CORREO']); ?> 
                        </p>
                        <p class="card-text-des">
                            <!-- Muestra el cargo del usuario, escapando caracteres especiales -->
                            <?php echo htmlspecialchars($usuario['CARGO']); ?> 
                        </p>
                    </div>
                    <!-- Enlace para ir a la página con más información del usuario, enviando su ID por URL -->
                    <a class="button-card" href="ver-usuario.php?id=<?php echo $usuario['ID_USUARIO']; ?>">
                        Ver más 
                    </a>
                </div>
                <!-- Fin del ciclo while que recorre todos los usuarios -->
            <?php endwhile; ?> 
        <!-- Fin del contenedor de tarjetas -->
        </div>
    <!-- Si no hay usuarios en el resultado -->
    <?php else: ?>
         <!-- Mensaje que indica que no existen usuarios -->
        <p class="p-account"><strong>No hay usuarios aún</strong></p>
        <!-- Fin de la estructura condicional -->
    <?php endif; ?> 

    <br> <!-- Espacios visuales -->
    <br>
    <br>

    <h1>RESULTADO DE BUSQUEDA POR EL ID DEL USUARIO</h1> <!-- Título para la sección donde se muestra el usuario con ID 2 -->
    
    <br>
    <br>
    <br>

    <!-- Contenedor para la tarjeta del usuario específico -->
    <div class="row-cards"> 
        <!-- Itera sobre el resultado del usuario único (normalmente 1 fila) -->
        <?php while ($usuario_unico = $resultado_unico->fetch_assoc()): ?> 
            <!-- Tarjeta individual -->
            <div class="card"> 
                 <!-- Contenido principal de la tarjeta -->
                <div class="card-body">
                    <p class="card-text">
                        <!-- Muestra el ID -->
                        <?php echo htmlspecialchars($usuario_unico['ID_USUARIO']); ?>
                    </p>
                    <p class="card-text-des">
                        <!-- Muestra el nombre -->
                        <?php echo htmlspecialchars($usuario_unico['NOMBRE']); ?>
                    </p>
                    <p class="card-text-des">
                        <!-- Muestra el correo -->
                        <?php echo htmlspecialchars($usuario_unico['CORREO']); ?>
                    </p>
                    <p class="card-text-des">
                        <!-- Muestra el cargo -->
                        <?php echo htmlspecialchars($usuario_unico['CARGO']); ?> 
                    </p>
                </div>
                <!-- Enlace para ver más información detallada del usuario, con el ID en la URL -->
                <a class="button-card" href="ver-artesano.php?id=<?php echo $usuario_unico['ID_USUARIO']; ?>">
                    Ver más
                </a>
            </div>
            <!-- Fin del ciclo while para el usuario único -->
        <?php endwhile; ?>
        <!-- Fin del contenedor de tarjetas -->
    </div> 

</main> <!-- Fin del contenido principal -->
</body> <!-- Fin del cuerpo -->
</html> <!-- Fin del documento HTML -->
