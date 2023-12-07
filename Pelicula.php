<?php include_once 'config/database.php'; ?>

<?php
class Pelicula extends Database {
    private $paginaActual;
    private $totalPaginas;
    private $totalResultados;
    private $resultadosPorPagina;
    private $indice; //Este atributo hace referencia a la fila que contiene la imagen en la BD.
    private $error = false;
    
    function __construct($rpp) {
        parent::__construct();
        
        $this->resultadosPorPagina = $rpp;
        $this->indice = 0; //Este atributo indica desde que imagen comenzar a mostrar.
        $this->paginaActual = 1; //Si el usuario no especifica la página en la URL, por defecto será la página 1.
        $this->calcularPaginas();
    }
    
    function calcularPaginas() {
        $query = $this->conectar()->query("SELECT COUNT(*) AS total FROM pelicula"); //Esta sentencia SQL retorna la cantidad de filas que hay en la tabla "pelicula".
        $this->totalResultados = $query->fetch(PDO::FETCH_OBJ)->total; //En este atributo se almacenan la cantidad de registros que hay en la tabla (Cantidad de imagenes).
        $this->totalPaginas = ceil($this->totalResultados / $this->resultadosPorPagina); //En este atributo se almacenan la cantidad de páginas que se necesitan para mostrar todas la imagenes.
        
        //Proceso de validación (Aquí se valida que en el navegador se ingrese un número de página valido).
        if (isset($_GET["pagina"])) {
            if (is_numeric($_GET["pagina"])) { //Aquí se consulta si el valor de la URL es un número (pagina=1, pagina=2...).
                if ($_GET["pagina"] >= 1 && $_GET["pagina"] <= $this->totalPaginas) { //Aquí se verifica que el valor de la url sea mayor o igual que 1 y que el número no supere el total de páginas.
                    $this->paginaActual = $_GET["pagina"];
                    $this->indice = ($this->paginaActual - 1) * ($this->resultadosPorPagina); //En este atributo se almacena el indice de la primera imagen a mostrar.
                }
                else {
                    echo "No existe esa página";
                    $this->error = true;
                }
            }
            else {
                echo "Error al mostrar la página";
                $this->error = true;
            }
        }
    }
    
    function mostrarPeliculas() {
        if ($this->error == false) { //Aquí se verifica que el usuario se encuentre en una página válida.
            $query = $this->conectar()->prepare("SELECT * FROM pelicula LIMIT :posicion, :resultados"); //Esta preparación de sentencia SQL saca los registros desde una posición especifica hasta otra posición especifica.
            $query->execute(["posicion" => $this->indice, "resultados" => $this->resultadosPorPagina]);
            
            foreach ($query as $pelicula) { //Por cada iteración se incluye "vista_pelicula.php" (Por cada iteración se incluye dicha vista en el "index.php" y la variable $pelicula es utilizada en "vista-pelicula.php").
                include "vista_pelicula.php";
            }
        }
    }
    
    function mostrarPaginas() {
    	if ($this->error == false) {
	        $actual = ""; //Esta variable va a almacenar la clase "actual" de la hoja de estilos.
	        echo "<ul>";
	        for ($i = 0; $i < $this->totalPaginas; $i++) { //Aquí se recorren todas las páginas (Los números que se muestran en "index.php").
	            if ($i + 1 == $this->paginaActual) { 
	                $actual = "class='actual'";
	            }
	            else {
	                $actual = "";
	            }
	            echo "<li>" . "<a $actual href='" . "?pagina=" . ($i + 1) . "'>" . ($i + 1) . "</a></li>"; //Por cada iteración se muestra un número en "index.php".
	        }
	        echo "</ul>";
    	}
    }
}
?>