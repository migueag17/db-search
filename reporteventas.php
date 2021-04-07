<?php
 
 $host = "localhost";
 $dbname = "agencia";
 $username = "root";
 $password = "";

$conexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$where = '';
$tipo = '';
$vendedor = '';
$cliente = '';
$filtro = '';

if (isset($_REQUEST["tipo_propiedad"])) {
    $tipo = $_REQUEST["tipo_propiedad"];
    if ($tipo != "") {
        $where = "WHERE propiedades.tipo = '$tipo'";
    }
}

if (isset($_REQUEST["nombre_vendedor"])) {
    $vendedor = $_REQUEST["nombre_vendedor"];
    if ($vendedor != "") {
        if ($where == "") {
            $where = "WHERE agentes.nombre = '$vendedor'";
        }
        else {
            $filtro = $_REQUEST["filtro"];
            $where .= " $filtro agentes.nombre = '$vendedor'";
        }
    }
}

if (isset($_REQUEST["cedula_cliente"])) {
    $cliente = $_REQUEST["cedula_cliente"];
    if ($cliente != "") {
        if ($where == "") {
            $where = "WHERE clientes.cedula = '$cliente'";
        }
        else {
            $filtro = $_REQUEST["filtro"];
            $where .= " $filtro clientes.cedula = '$cliente'";
        }
    }
}

 $consult = $conexion->prepare("SELECT propiedades.tipo, clientes.nombre AS cNombre, clientes.cedula, agentes.nombre AS aNombre FROM propiedades 
                                INNER JOIN clientes ON propiedades.id_cliente = clientes.id 
                                INNER JOIN agentes ON propiedades.id_vendedor = agentes.id $where" );
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
    <form class="formulario" action="reporteventas.php" method="POST">
            <fieldset>
                <legend>Filtrar Reporte</legend>
                <div class="contenedor-campos">
                    <div class="campo">
                        <label>Tipo inmueble</label>
                        <select class="input-text" name="tipo_propiedad">
                            <option value=""> Seleccione</option>
                            <option value="Casa" <?php if($tipo=="Casa"){echo 'selected';}?> >Casa</option>
                            <option value="Apartamento" <?php if($tipo=="Apartamento"){echo 'selected';}?> >Apartamento</option>
                            <option value="Lote" <?php if($tipo=="Lote"){echo 'selected';}?> >Lote</option>
                            <option value="Finca" <?php if($tipo=="Finca"){echo 'selected';}?> >Finca</option>    
                        </select>
                    </div>
                
                    <div class="campo">
                        <label>Vendedor</label>
                        <input class="input-text" type="text" placeholder="Nombre Vendedor" name="nombre_vendedor" value="<?php echo $vendedor;?>">
                    </div>
                
                    <div class="campo">
                        <label>Cedula cliente</label>
                        <input class="input-text" type="number" placeholder="Cedula Cliente" name="cedula_cliente" value="<?php echo $cliente;?>">
                    </div>

                    <div class="campo"> 
                    <button class="boton" type="submit" name="filtro" value="AND">Filtrar todo</button>
                    <button class="boton" type="submit" name="filtro" value="OR">Cualquiera</button>
                    </div>
                </div>
            </fieldset>
        </form>

    <section>
        <h2>Reporte Ventas</h2>
        <table>
            <thead>
                <th>
                    Tipo inmueble
                </th>
                <th>
                    Vendedor
                </th>
                <th>
                    Cliente
                </th>
                <th>
                    Cédula cliente
                </th>
            </thead>

            <tbody>
            <?php for ($i=0; $i < count($reportes); $i++) { ?>
                <tr>
                    <td>
                        <?php echo $reportes[$i]["tipo"]?>
                    </td>
                    <td>
                        <?php echo $reportes[$i]["aNombre"]?>
                    </td>
                    <td>
                        <?php echo $reportes[$i]["cNombre"]?>
                    </td>
                    <td>
                        <?php echo $reportes[$i]["cedula"]?>
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