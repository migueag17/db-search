<?php
$host = "localhost";
$dbname = "agencia";
$username = "root";
$password = "";

$conexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

$consulta = $conexion->prepare("SELECT id,nombre FROM clientes" );
$consulta->execute();
$clientes = $consulta->fetchAll();

$consu = $conexion->prepare("SELECT id,nombre FROM agentes" );
$consu->execute();
$agentes = $consu->fetchAll();

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
        <h2>Crear Venta</h2>
        <form class="formulario" action="guardarventa.php" method="POST">
            <fieldset>
                <legend>Crear Registro de Venta</legend>
                <div class="contenedor-campos">
                <div class="campo">
                    <label>Tipo de Propiedad</label>
                    <input class="input-text" type="text" placeholder="Tipo" name="tipoPropiedad">
                </div>
                
                <div class="campo">
                    <label>Cliente</label>
                    <select name="cliente">
                        <option value=""> Seleccione Cliente</option>
                        <?php
                        for ($i=0; $i < count($clientes); $i++) {
                        ?>
                        <option value="<?php echo $clientes[$i]["id"]?>"> <?php echo $clientes[$i]["nombre"] ?></option>
                        <?php } ?>

                    </select>
                </div>
                
                <div class="campo">
                    <label>Vendedor</label>
                    <select name="vendedor">
                        <option value=""> Seleccione Vendedor</option>
                        <?php
                        for ($i=0; $i < count($agentes); $i++) {
                        ?>
                        <option value="<?php echo $agentes[$i]["id"]?>"> <?php echo $agentes[$i]["nombre"] ?></option>
                        <?php } ?>

                    </select>
                </div>
            </div> <!-- .contenedor-campos-->

            <div class="alinear-derecha flex">
                <input class="boton w-100" type="submit" value="Crear">
            </div>
            </fieldset>
        </form>
    </section>
</main>

    <footer class="footer">
        <p>Todos los derechos reservados. Miguel Aguirre Realtor</p>
    </footer>
    
</body>
</html>