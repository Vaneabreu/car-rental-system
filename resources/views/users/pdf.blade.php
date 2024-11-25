<?php
$cliente = "Style Shop";
$remitente = "Style Shop";
$mensajePie = "Gracias por su compra!";
$numero = "0002";
$descuento = 0;
$porcentajeImpuestos = 18;


$fecha = date("Y-m-d");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="./bs3.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Factura</title>
    <img src="assets/img/style.php.png" align="right" width="88" height="88" class="rounded">
    <link href="assets/bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css">
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-10 ">
            <h1>FACTURA</h1>
        </div>

    </div>
    <hr>
    <div class="row">
        <div class="col-xs-10">
            <h1 class="h6"><?php echo $remitente ?></h1>

        </div>
        <div class="col-xs-2 text-center">
            <strong>Aut. Ramon Caceres, Moca</strong>
            <br>
            <strong>Fecha:</strong>
            <?php echo $fecha ?>
            <br>
            <strong>Factura No.</strong>
            <?php echo $numero ?>
        </div>
    </div>
    <hr>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                    <th>Precio unitario</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $subtotal = 0;
                $suma = 0;

                foreach ($facturas as $factura) {
                    $suma += ($factura->quantity * $factura->sale_price);


                    ?>
                <tr>

                    <td>{{ $factura->description }}</td>
                    <td>{{ $factura->quantity }}</td>
                    <td>$<?php echo number_format($factura->sale_price)?></td>
                    <td>$<?php echo number_format ($factura->quantity * $factura->sale_price )?></td>
                </tr>
                <?php }
                $subtotal = $suma;
                $subtotalConDescuento = $suma - $descuento;
                $impuestos = ($suma) * ($porcentajeImpuestos / 100);
                 $total =   $subtotalConDescuento + $impuestos;
                ?>

                </tbody>
                <tfoot>
                <tr>
                    <td colspan="3" class="text-right"><strong>Subtotal</strong></td>
                    <td>$<?php echo number_format($subtotal, 2) ?></td>
                </tr>
                <br>
                <tr>
                    <td colspan="3" class="text-right">Descuento</td>
                    <td>$<?php echo number_format($descuento, 2) ?></td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right">Subtotal con descuento</td>
                    <td>$<?php echo number_format($subtotalConDescuento, 2) ?></td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right">Impuestos</td>
                    <td>$<?php echo number_format($impuestos, 2) ?></td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right">
                        <h4>Total Final</h4></td>
                    <td>
                        <h4>$<?php echo number_format($total, 2) ?></h4>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 text-center">
            <p class="h5"><?php echo $mensajePie ?></p>
        </div>
    </div>
</div>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
<style>
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}
</style>
</head>

</html>
