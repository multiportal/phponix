<?php
include('../admin/conexion.php');
$tabla=$DBprefix."mode_page";
$resultado = mysqli_query($mysqli,"SHOW COLUMNS FROM {$tabla};");
if (!$resultado) {
    echo 'No se pudo ejecutar la consulta: ' . mysqli_error($mysqli);
    exit;
}
echo '<table>';
echo '<tr><th>Nombre del Campo</th><th>Tipo del campo</th></tr>';
if (mysqli_num_rows($resultado) > 0) {
    while ($fila = mysqli_fetch_assoc($resultado)) {
		echo '<tr><td>'.$fila['Field'].'</td><td>'.$fila['Type']."</tr>\n";
        //print_r($fila);
    }
}
echo'</table>';
?>