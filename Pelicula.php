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
        $this->paginaActual = 1; //Si el usuario no especifica la p�gina en la URL, por defecto ser� la p�gina 1.
        $this->calcularPaginas();
    }
    
    function calcularPaginas() {
        $query = $this->conectar()->query("SELECT COUNT(*) AS total FROM pelicula"); //Esta sentencia SQL retorna la cantidad de filas que hay en la tabla "pelicula".
        $this->totalResultados = $query->fetch(PDO::FETCH_OBJ)->total; //En este atributo se almacenan la cantidad de registros que hay en la tabla (Cantidad de imagenes).
        $this->totalPaginas = ceil($this->totalResultados / $this->resultadosPorPagina); //En este atributo se almacenan la cantidad de p�ginas que se necesitan para mostrar todas la imagenes.
        
        //Proceso de validaci�n (Aqu� se valida que en el navegador se ingrese un n�mero de p�gina valido).
        if (isset($_GET["pagina"])) {
            if (is_numeric($_GET["pagina"])) { //Aqu� se consulta si el valor de la URL es un n�mero (pagina=1, pagina=2...).
                if ($_GET["pagina"] >= 1 && $_GET["pagina"] <= $this->totalPaginas) { //Aqu� se verifica que el valor de la url sea mayor o igual que 1 y que el n�mero no supere el total de p�ginas.
                    $this->paginaActual = $_GET["pagina"];
                    $this->indice = ($this->paginaActual - 1) * ($this->resultadosPorPagina); //En este atributo se almacena el indice de la primera imagen a mostrar.
                }
                else {
                    echo "No existe esa p�gina";
                    $this->error = true;
                }
            }
            else {
                echo "Error al mostrar la p�gina";
                $this->error = true;
            }
        }
    }
    
    function mostrarPeliculas() {
        if ($this->error == false) { //Aqu� se verifica que el usuario se encuentre en una p�gina v�lida.
            $query = $this->conectar()->prepare("SELECT * FROM pelicula LIMIT :posicion, :resultados"); //Esta preparaci�n de sentencia SQL saca los registros desde una posici�n especifica hasta otra posici�n especifica.
            $query->execute(["posicion" => $this->indice, "resultados" => $this->resultadosPorPagina]);
            
            foreach ($query as $pelicula) { //Por cada iteraci�n se incluye "vista_pelicula.php" (Por cada iteraci�n se incluye dicha vista en el "index.php" y la variable $pelicula es utilizada en "vista-pelicula.php").
                include "vista_pelicula.php";
            }
        }
    }
    
    function mostrarPaginas() {
    	if ($this->error == false) {
	        $actual = ""; //Esta variable va a almacenar la clase "actual" de la hoja de estilos.
	        echo "<ul>";
	        for ($i = 0; $i < $this->totalPaginas; $i++) { //Aqu� se recorren todas las p�ginas (Los n�meros que se muestran en "index.php").
	            if ($i + 1 == $this->paginaActual) { 
	                $actual = "class='actual'";
	            }
	            else {
	                $actual = "";
	            }
	            echo "<li>" . "<a $actual href='" . "?pagina=" . ($i + 1) . "'>" . ($i + 1) . "</a></li>"; //Por cada iteraci�n se muestra un n�mero en "index.php".
	        }
	        echo "</ul>";
    	}
    }
}
?>