<?php
    include 'bd.php';
    include 'header.php';

    if(!isset($_SESSION['usuario'])){
        header("location: principal.php");

    }
    $id = $_SESSION['usuario'];
    $data = mysqli_query($conexion,"SELECT * FROM usuarios WHERE id = '$id'");
    ?>
    <title>USUARIO</title>
    <p> Tus Datos </p>
    <?php
    while($row = mysqli_fetch_assoc($data)){
        $nombre = $row['nombre'];
        $correo = $row['correo'];
        $fecha = $row['fecha_nacimiento'];
        echo 'Nombre : '.$nombre.'<br>'.'Correo : '.$correo.'<br>'.'Fecha de nacimiento : '.$fecha.'<br>'; 
    }
    echo '-----------wishlist--------------<br>';
    $whislist = mysqli_query($conexion,"SELECT * FROM wishlist WHERE id_usuario = '$id'");
    while($row = mysqli_fetch_assoc($whislist)){
        $promedio = $row['puntuacion_promedio'];
        $id_producto = $row['id_paquete'];
        $bolean = $row['paquete'];
        if(!$bolean){
            $datos_hotel = mysqli_query($conexion,"SELECT nombre FROM hoteles WHERE id = '$id_producto'");
            $nombre_producto = mysqli_fetch_assoc($datos_hotel)['nombre'];
            echo 'Nombre del hotel: '.'<a href="hotelesYpaquetes.php?id='.$id_producto.'">'.$nombre_producto.'</a><br>'.$promedio.' Estrellas<br>';
        }else{
            $datos_paquete = mysqli_query($conexion,"SELECT nombre FROM paquetes WHERE id = '$id_producto'");
            $nombre_producto = mysqli_fetch_assoc($datos_paquete)['nombre'];
            echo 'Nombre del paquete: '.'<a href="hotelesYpaquetes.php?id='.$id_producto.'">'.$nombre_producto.'</a><br>'.$promedio.' Estrellas<br>';
        }
        ?>
        <form action="delete_wishlist.php" method="get" style="display: inline;">
            <input type="hidden" name="id_producto" value="<?php echo $id_producto; ?>">
            <button type="submit">☠</button>
        </form>
<?php
        echo'<br>⛩⛩⛩⛩⛩⛩⛩⛩⛩⛩⛩⛩⛩⛩⛩⛩⛩⛩⛩ <br>';
    }

    // echo 'si';
?>
<!DOCTYPE html>
<html>
<body>
    <div class="button-group">
    <button onclick="window.location.href='login/logout.php'">cerrar</button>
    <button>Eliminar</button>
    </div>
</body>
</html>