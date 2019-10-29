<?php
namespace Vendor;

include_once 'ConfigurarTroya.php';

/**
 *
 * @author Airy Fabian Rosales
 * @date 27 de Octubre de 2019
 *
 */
class Troya extends ConfigurarTroya
{

    /**
     */
    public function __construct($tamanoCifrado)
    {
        parent::__construct($tamanoCifrado);
    }

    /**
     */
    function __destruct()
    {}

    /**
     */
    public function armarCaballoTroya(String $abcString): string
    {
        $response = "";
        for ($i = 0; $i < mb_strlen($abcString, "UTF-8"); $i++) {
            $response .= $this->baseAbc[mb_substr($abcString, $i, 1, "UTF-8")];
        }
        return $response;
    }

    /**
     */
    public function desarmarCaballoTroya(String $codigoString): string
    {
        if (strlen($codigoString) < $this->TAM_MAXIMO_CIFRADO) {
            die("No se puede decodificar " . $codigoString . " porque no cumple con los parametros de decodificacion");
        }
        $response = "";
        for ($i = 0; $i < strlen($codigoString); $i = $i + $this->TAM_MAXIMO_CIFRADO) {
            $response = $response . $this->codeAbc(substr($codigoString, $i, $i + $this->TAM_MAXIMO_CIFRADO - 1));
        }
        return $response;
    }
}

