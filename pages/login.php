<?php
$host = 'localhost';
$bd = 'chuensuca';
$user = 'postgres';
$password = '123456';

$conexion = pg_connect("host=$host dbname=$bd user=$user password=$password");

if (!$conexion) {
    echo "Error de conexión.";
} else {
    if (isset($_POST['Num_id']) && isset($_POST['Password'])) {
        $usuario = pg_escape_string($conexion, $_POST['Num_id']);
        $clave = pg_escape_string($conexion, $_POST['Password']);

        $query = "SELECT * FROM usuarios WHERE nombre = '$usuario' AND password = '$clave'";
        $consulta = pg_query($conexion, $query);

        if (!$consulta) {
            echo "Error en el inicio de sesión.";
        } else {
            if (pg_num_rows($consulta) > 0) {
                echo "Login exitoso. Redirigiendo...";
                header('Location: adulto_mayor.html');
                exit;
            } else {
                echo "Usuario o contraseña incorrectos.";
            }
        }
    }
}
?>
