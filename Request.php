<?php
header("Content-Type: text/html;charset=utf-8");
/** 
 * @author Airy Fabian Rosales
 * @Date 27 de Octubre de 2019
 * 
 */
require 'Vendor/CifradoTroya.php';
require 'Vendor/Troya.php';
class Request
{
    private $troya;
    private $cifrado;
    public $contenido;

    /**
     */
    public function __construct(String $metodo, $parametros)
    {
        $this->ini();
        $this->$metodo($parametros);
    }
    
    private function ini(){
        $this->troya = new \Vendor\Troya(6);
        $this->cifrado = new \Vendor\CifradoTroya(6);
    }
    
    public function crearNuevoCifrado($parametros){
        $this->cifrado->troya("cifrado.data");
        $this->contenido = $this->cifrado->baseAbc();
//         $this->contenido = $this->cifrado->codigoAbc();
    }
    
    public function convertirFrase($parametros){
        $this->troya->leerCodigosEnArchivo("cifrado.data");
        $this->contenido = $this->troya->armarCaballoTroya($parametros);
    }
}
$request = new Request($_POST["metodo"], $_POST["parametros"]);
echo $request->contenido;