<?php
 $nombre = $_REQUEST["nombre"];
 $cedula = $_REQUEST["cedula"];
 $nroVentas = $_REQUEST["nroVentas"];

 $host = "localhost";
 $dbname = "agencia";
 $username = "root";
 $password = "";

 $conexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
 $guardar = $conexion->prepare("INSERT INTO agentes (id,cedula,nombre,nro_ventas) VALUES (NULL,'$cedula','$nombre','$nroVentas')");
 $guardar->execute();
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
        <h2>Vendedor</h2>
        <form class="formulario">
            <fieldset>
                <legend>Vendedor creado con éxito</legend>
                <div class="contenedor-campos">

                <div class="campo">
                <label>Nombre: <?php echo $nombre;?> </label>
                </div>
                
                <div class="campo">
                <label>Cedula: <?php echo $cedula;?> </label>
                </div>
                
                <div class="campo">
                <label>Número de Ventas: <?php echo $nroVentas;?> </label>
                </div>
            </div> <!-- .contenedor-campos-->

            </fieldset>
        </form>
    </section>
    </main>

    <footer class="footer">
        <p>Todos los derechos reservados. Miguel Aguirre Realtor</p>
    </footer>
    
</body>
</html>
