<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paginacion</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php
include_once 'Pelicula.php';
$p = new Pelicula(5);
?>
    <div id="contenedor">
    
        <div id="peliculas">
        	<?php 
            $p->mostrarPeliculas();
            ?>
        </div>
        
        <div id="paginas">
			<?php 
			$p->mostrarPaginas();
			?>
        </div>

    </div>
</body>
</html>