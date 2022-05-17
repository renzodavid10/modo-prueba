<?php

ob_start(); // empezar a llenar el buffer para meter todo ese contenido y convertirlo en pdf



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>


<body>


    <img src="img/logoNomMuni.jpeg" height="120px" width="500px" hspace="200px">


    <?php include('../Modelo/modelo_usuario.php');

    $llamar = new modelo_usu;


    $hola = $llamar->listar_select_rol(); ?>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>NOMBRE</th>
                <th>ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($hola as $hol) { ?>
                <tr>
                    <td><?php echo $hol['rol_id']; ?></td>
                    <td><?php echo $hol['rol_nombre']; ?></td>
                    <td><?php echo $hol['rol_fregistro']; ?></td>
                    <td><a class="btn btn-danger">Eliminar</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>
<?php
$html = ob_get_clean(); // capturar conetnido en la mememoria
//echo $html;


require_once '../libreria/dompdf/autoload.inc.php';

use Dompdf\Dompdf; //para incluir el namespace de la librería
$dompdf = new Dompdf(); //crear el objeto de la clase Dompdf

//para datos e img
$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);

// Añadir el HTML a dompdf
$dompdf->loadHtml($html);

//Establecer el tamaño de hoja en DOMPDF
// $dompdf->setPaper('A4', 'portrait'); //vertical
$dompdf->setPaper('letter', 'landscape'); //esta es una forma de ponerlo horizontal

$dompdf->render();
// Forzar descarga del PDF true si no false

$dompdf->stream("generar.pdf", ["Attachment" => false]);




?>