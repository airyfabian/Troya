<?php
namespace Vendor;

include_once 'ConfigurarTroya.php';
/**
 *
 * @author Airy Fabian Rosales
 * @date 27 de Octubre de 2019 
 *        
 */
class CifradoTroya extends ConfigurarTroya
{

    /**
     */
    public function __construct($tamanoCifrado)
    {
        parent::__construct($tamanoCifrado);
        if ($this->TAM_MAXIMO_CIFRADO == null || $this->TAM_MAXIMO_CIFRADO <= 0) {
            die("No se ha configurado el proyecto para poder comenzar a utilizarlo");
        }
    }

    /**
     */
    function __destruct()
    {}

    private function seleccionarValorRam()
    {
        $posicion = rand(0, count($this->valoresRam) - 1);
        return $this->valoresRam[$posicion];
    }

    private function creaCodigo()
    {
        $codigo = "";
        for ($i = 0; $i < $this->TAM_MAXIMO_CIFRADO; $i ++) {
            $codigo .= $this->seleccionarValorRam();
        }
        return $codigo;
    }

    private function buscarCodigoDuplicado($arregloCodigo, $nuevoCodigo)
    {
        $existe = false;
        foreach ($arregloCodigo as $clave => $valor){
            if($clave==$nuevoCodigo){
                $existe = true;
                break;
            }
        }
        return $existe;
    }

    public function crearListaNuevoCodigo()
    {
        $tmp = [];
        foreach ($this->baseAbc as $clave => $valor) {
            do {
                $valor = $this->creaCodigo();
            } while ($this->buscarCodigoDuplicado($this->codeAbc, $valor));
            $this->codeAbc[utf8_encode($valor)] = utf8_encode($clave);
            $tmp[utf8_encode($clave)] = utf8_encode($valor);
        }
        $this->baseAbc = $tmp;
    }

    public function troya($rutaNombreArchivo)
    {
        $this->crearListaNuevoCodigo();
        $this->registrarCodigosEnArchivo($this->baseAbc, true, $rutaNombreArchivo);
        $this->registrarCodigosEnArchivo($this->codeAbc, false, $rutaNombreArchivo);
    }

    public function baseAbc()
    {
        return json_encode($this->baseAbc);
    }

    public function codigoAbc()
    {
        return json_encode($this->codeAbc);
    }

    public function imprimir()
    {
        echo "baseAbc = [";
        foreach ($this->baseAbc as $clave => $valor) {
            echo "'" . $clave . "' => '" . $valor . "',\n";
        }
        echo "]\ncodeAbc = [";
        foreach ($this->codeAbc as $clave => $valor) {
            echo "'" . $clave . "' => '" . $valor . "',\n";
        }
        echo "]";
    }
}