<?php
namespace Vendor;

/**
 *
 * @author Airy Fabian Rosales
 * @date 27 de Octubre de 2019
 *        
 */
class ConfigurarTroya
{
    public $TAM_MAXIMO_CIFRADO;
    public $valoresRam = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'Ñ', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
    public $baseAbc = ['!' => '', '"' => '', '#' => '', '$' => '', '%' => '', '&' => '', '\'' => '', '(' => '', ')' => '', '*' => '', '+' => '', ',' => '', '-' => '', '.' => '',
        '/' => '', '0' => '', '1' => '', '2' => '', '3' => '', '4' => '', '5' => '', '6' => '', '7' => '', '8' => '', '9' => '', ':' => '', ';' => '', '<' => '',
        '=' => '', '>' => '', '?' => '', '@' => '', 'A' => '', 'B' => '', 'C' => '', 'D' => '', 'E' => '', 'F' => '', 'G' => '', 'H' => '', 'I' => '', 'J' => '',
        'K' => '', 'L' => '', 'M' => '', 'N' => '', 'O' => '', 'P' => '', 'Q' => '', 'R' => '', 'S' => '', 'T' => '', 'U' => '', 'V' => '', 'W' => '', 'X' => '',
        'Y' => '', 'Z' => '', '[' => '', '\\' => '', ']' => '', '^' => '', '_' => '', '`' => '', 'a' => '', 'b' => '', 'c' => '', 'd' => '', 'e' => '', 'f' => '',
        'g' => '', 'h' => '', 'i' => '', 'j' => '', 'k' => '', 'l' => '', 'm' => '', 'n' => '', 'o' => '', 'p' => '', 'q' => '', 'r' => '', 's' => '', 't' => '',
        'u' => '', 'v' => '', 'w' => '', 'x' => '', 'y' => '', 'z' => '', '{' => '', '|' => '', '}' => '', '~' => '', ' ' => '', '€' => '', '='  > '', '‚' => '',
        'ƒ' => '', '„' => '', '…' => '', '†' => '', '‡' => '', 'ˆ' => '', '‰' => '', 'Š' => '', '‹' => '', 'Œ' => '', '='  > '', 'Ž' => '', '='  > '', '‘' => '',
        '’' => '', '“' => '', '”' => '', '•' => '', '–' => '', '—' => '', '™' => '', 'š' => '', '›' => '', 'œ' => '', '='  > '', 'ž' => '', 'Ÿ' => '', '¡' => '',
        '¢' => '', '£' => '', '¤' => '', '¥' => '', '¦' => '', '§' => '', '¨' => '', '©' => '', 'ª' => '', '«' => '', '¬' => '', '­' => '', '®' => '', '¯' => '',
        '°' => '', '±' => '', '²' => '', '³' => '', '´' => '', 'µ' => '', '¶' => '', '·' => '', '¸' => '', '¹' => '', 'º' => '', '»' => '', '¼' => '', '½' => '',
        '¾' => '', '¿' => '', 'À' => '', 'Á' => '', 'Â' => '', 'Ã' => '', 'Ä' => '', 'Å' => '', 'Æ' => '', 'Ç' => '', 'È' => '', 'É' => '', 'Ê' => '', 'Ë' => '',
        'Ì' => '', 'Í' => '', 'Î' => '', 'Ï' => '', 'Ð' => '', 'Ñ' => '', 'Ò' => '', 'Ó' => '', 'Ô' => '', 'Õ' => '', 'Ö' => '', '×' => '', 'Ø' => '', 'Ù' => '',
        'Ú' => '', 'Û' => '', 'Ü' => '', 'Ý' => '', 'Þ' => '', 'ß' => '', 'à' => '', 'á' => '', 'â' => '', 'ã' => '', 'ä' => '', 'å' => '', 'æ' => '', 'ç' => '',
        'è' => '', 'é' => '', 'ê' => '', 'ë' => '', 'ì' => '', 'í' => '', 'î' => '', 'ï' => '', 'ð' => '', 'ñ' => '', 'ò' => '', 'ó' => '', 'ô' => '', 'õ' => '',
        'ö' => '', '÷' => '', 'ø' => '', 'ù' => '', 'ú' => '', 'û' => '', 'ü' => '', 'ý' => '', 'þ' => '', 'ÿ' => '', ' ' => '' ];
    public $codeAbc = ["0000"=>""];

    /**
     */
    public function __construct($tamanoCifrado)
    {
        $this->TAM_MAXIMO_CIFRADO = $tamanoCifrado;
    }

    /**
     */
    function __destruct()
    {}

    public function registrarCodigosEnArchivo($arreglo, $nuevo = false, $rutaNombreArchivo)
    {
        $tipoApertura = $nuevo ? 'w' : 'a';
        $fh = fopen($rutaNombreArchivo, $tipoApertura) or die("Existe un problema para abrir el archivo...");
        fwrite($fh, json_encode($arreglo));
        fwrite($fh, "\n****\n");
        fclose($fh);
    }

    public function leerCodigosEnArchivo($rutaNombreArchivo)
    {
        $jsonArchivo = [
            "",
            ""
        ];
        $posicion = 0;
        $fh = fopen($rutaNombreArchivo, "r") or die("Existe un problema para abrir el archivo...");
        while (! feof($fh)) {
            $tmpLinea = fgets($fh);
            if(strlen($tmpLinea) > 10 ){
                $jsonArchivo[$posicion] = utf8_decode($tmpLinea);
                $posicion ++;
            }
        }
        fclose($fh);
        $this->baseAbc = json_decode($jsonArchivo[0], true);
        $this->codeAbc = json_decode($jsonArchivo[1], true);
    }
    
    
    
    public function cambiarCaracter($letra){
        $codigo = false;
        foreach ($this->baseAbc as $clave => $valor){
            if($letra == $clave){
                $codigo = $valor;
//                 echo "letra ".$letra." clave ".$clave." codigo ".$codigo." valor ".$valor;
                break;
            }
        }
        return $codigo;
    }
}