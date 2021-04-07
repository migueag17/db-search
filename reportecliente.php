<?php
 
 $host = "localhost";
 $dbname = "agencia";
 $username = "root";
 $password = "";

$conexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$where = '';
$cedula = '';
$cliente = '';
$nroCompras = '';
$filtro = '';

if (isset($_REQUEST["cedula"])) {
    $cedula = $_REQUEST["cedula"];
    if ($cedula != "") {
        $where = "WHERE clientes.cedula = '$cedula'";
    }
}

if (isset($_REQUEST["nombre_cliente"])) {
    $cliente = $_REQUEST["nombre_cliente"];
    if ($cliente != "") {
        if ($where == "") {
            $where = "WHERE clientes.nombre = '$cliente'";
        }
        else {
            $filtro = $_REQUEST["filtro"];
            $where .= " $filtro clientes.nombre = '$cliente'";
        }
    }
}

if (isset($_REQUEST["nro_compras"])) {
    $nroCompras = $_REQUEST["nro_compras"];
    if ($nroCompras != "") {
        if ($where == "") {
            $where = "WHERE clientes.nro_compras = '$nroCompras'";
        }
        else {
            $filtro = $_REQUEST["filtro"];
            $where .= " $filtro clientes.nro_compras = '$nroCompras'";
        }
    }
}

$consult = $conexion->prepare("SELECT clientes.cedula, clientes.nombre, clientes.nro_compras FROM clientes $where" );
 $consult->execute(); 
 $reportes = $consult->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inmobiliaria Miguel</title>
    <link rel="preload" href="css/normalize.css" as="style">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Krub:wght@400;700&display=swap" rel="stylesheet">
    <link rel="preload" href="inicio.css" as="style">
    <link href="inicio.css" rel="stylesheet">

</head>
<body>
    <header>
        <h1 class="titulo">Inmobiliaria Miguel</h1>
    </header>

    <div class="nav-bg">
        <nav class="navegacion-principal contenedor">
            <a href="inicio.html">Inicio</a>
            <a href="crearcliente.html">Crear Clientes</a>
            <a href="crearvendedor.html">Crear Vendedores</a>
            <a href="crearventa.php">Crear Venta</a>
            <a href="reportecliente.php">Reporte Clientes</a>
            <a href="reporteventas.php">Reporte Ventas</a>
        </nav>
    </div>
   
    <main class="contenedor sombra">
    <section>
        <h2>Cliente</h2>
        <form class="formulario" action="reportecliente.php" method="POST">
            <fieldset>
                <legend>Reporte Clientes</legend>
                <div class="contenedor-campos">

                <div class="campo">
                    <label>Nombre cliente</label>
                    <input class="input-text" type="text" placeholder="Nombre cliente" name="nombre_cliente" value="<?php echo $cliente;?>" > 
                </div>
                
                <div class="campo">
                    <label>Cédula cliente</label>
                    <input class="input-text" type="tel" placeholder="Cedula Cliente" name="cedula" value="<?php echo $cedula;?>" >
                </div>
                
                <div class="campo">
                    <label>Número de compras</label>
                    <input class="input-text" type="tel" placeholder="Nro Compras" name="nro_compras" value="<?php echo $nroCompras?>" >
                </div>
                
                </div> <!-- .contenedor-campos-->

            <div class="campo"> 
                    <button class="boton" type="submit" name="filtro" value="AND">Filtrar todo</button>
                    <button class="boton" type="submit" name="filtro" value="OR">Cualquiera</button>
            </div>

            </fieldset>
        </form>
    </section>

    <section>
        <h2>Reporte Ventas</h2>
        <table>
            <thead>
                <th>
                    Nombre cliente
                </th>
                <th>
                    Cédula
                </th>
                <th>
                    Número de Compras
                </th>
            </thead>

            <tbody>
            <?php for ($i=0; $i < count($reportes); $i++) { ?>
                <tr>
                    <td>
                        <?php echo $reportes[$i]["nombre"]?>
                    </td>
                    <td>
                        <?php echo $reportes[$i]["cedula"]?>
                    </td>
                    <td>
                        <?php echo $reportes[$i]["nro_compras"]?>
                    </td>
                </tr>
                <?php }?>
            </tbody>

        </table>
    </section>
</main>

    <footer class="footer">
        <p>Todos los derechos reservados. Miguel Aguirre Realtor</p>
    </footer>
    
</body>
</html>