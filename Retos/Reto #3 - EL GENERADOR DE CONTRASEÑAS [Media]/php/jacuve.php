<?php
class GeneradorPassword
{
    private $longitud;
    private $mayusculas;
    private $numeros;
    private $simbolos;
    const LETRAS = ['a','b','c','d','e','f', 'g','h','i','j','k','l','m','n','o','p','q','r'];

    public function __construct (int $longitud, bool $mayusculas, bool $numeros, bool $simbolos)
    {
        if ($longitud <8 || $longitud >16) {
            throw new InvalidArgumentException("longitud no válida, debe estar entre 8 y 16");
        }
        $this->longitud = $longitud;
        $this->mayusculas = $mayusculas;
        $this->numeros = $numeros;
        $this->simbolos = $simbolos;
    }
    public function generar()
    {
        $nuevaPass = '';
        $arrayValoresGenerar = range('a','z');
        if ($this->mayusculas) {
            $arrayValoresGenerar = array_merge($arrayValoresGenerar, range('A','Z'));
        }
        if ($this->numeros) {
            $arrayValoresGenerar = array_merge($arrayValoresGenerar, range(0,9));
        }
        if ($this->mayusculas) {
            $arrayValoresGenerar = array_merge($arrayValoresGenerar, [',',';','.',':','*','+','{','}','$','@','#']);
        }
        for ($i= 1 ; $i< $this->longitud; $i++) {
            $nuevaPass .= $arrayValoresGenerar[rand(0,count($arrayValoresGenerar)-1)];
        }
        return $nuevaPass;
    }

}

$generador = new GeneradorPassword(10, true, true, true);
$password = $generador->generar();
echo 'Nueva password : ' . $password;
