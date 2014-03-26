<?php
/**
* Clase de control de errores
*
*
* @author Fernando Andrés Pretel
*/

class error
{

/**
* lugar
*
* @var string
*/
var $lugar;


/**
* error
*
* breve explicacion del error
* @var string
*/
var $error;


/**
* error_original
*
* Error en caso de errores que se transmiten a traves de fucniones es
* iomportante saber cual fué el error original, esta var recoge el error original
*
* @var error
*/
var $error_original;


/**
* objeto_tipo_error
*
* FLAG del sistema para saber si lo devuelto es un objeto tipo error
*
* @var boolean
*/
var $objeto_tipo_error;

/**
* tipo
*
* Tipo de error. Esta cadena permite identificar el tipo de error y adecuar la salida a las necesidades de cada tipo
* Ejemplos de tipo de error y su gestion posterior:
* USUARIO: Este es un error que se muestra como parte de la ejecución de la aplicacion, por ejemplo "Usuario o clave incorrectos, acceso denegado"
* SISTEMA: Este es un error de programación y se mostrará en una ventana que ofrezca información adecuada al respecto (DEFAULT).
* @var string
*/
var $tipo;

	/**
	* error
	*
	* Constructor de la clase, es el que mantiene el rastro de los errores, garantizando que se puede seguir el error hasta el origen
	*
	* @param lugar STRING Archivo, clase, funcion donde se general el error.
	* @param error STRING breve explicación del error
	* @param origen STRING Archivo y funcion de origen del error ANTERIOR (en caso de ser una cadena)
	* @param error_original OBJETO ERROR con el objeto error generado por la otra función
	* @param tipo STRING indica el tipo de error y eso permite actuar en consecuencia:
	*					USUARIO: Este error se mostrará como parte de la ejecucion del programa por ejemplo "login o clave incorrectos".
	*					SISTEMA: Este es un error de programación y se mostrará en una ventana que ofrezca información al programador.
	*
	*/
	
	function error($lugar,$error,$error_original=null,$tipo=null)
	{
echo "<br>ERROR MAAAALO<br> -->".$lugar."<br>".$error;
}
/*			$this->lugar=$lugar;
			$this->error=$error;
			if (isset($error_original)) $this->error_original=$error_original;
			if (isset($tipo)) $this->tipo=$tipo;
			$this->objeto_tipo_error=TRUE;
	}
	
*/	
	/**
	* debug
	*
	* Muestra los valores del obejto en pantalla
	*
	* @param todo BOOLEAN -> si TRUE entonces hace debug al objeto error_original si lo hubiera
	*/
	function debug($todo=null)
	{
		$out = "<br></br>Lugar -->".$this->lugar;
		$out .= "<br></br>Error -->".$this->error;
		$out .= "<br></br>Objeto tipo error ->".$this->objeto_tipo_error;
		if ( ($todo==TRUE) && ($this->error_original)) 
		{
			$out .= "<br></br> Error original =================================";
			$out .= $this->error_original->debug();
		}
		echo $out;
	}
	
	function show()
	{
		//echo "<script type='text/javascript'> window.location='error.php".$this->lugar."'</script>";
echo "problemas";

	}

	function rastrea($cont=null)
	{
		$out = "&Lugar".$cont."=".$this->lugar;
		$out .= "&Error".$cont."=".$this->error;
		if ( is_object($this->error_original ) ) 
		{
			$cont++;
			$out .= $this->error_original->rastrea($cont);
			//echo "<br></br> ERROR NUM ".$cont."--->".$this->error_original->__toString($cont);
		}
		 //return $this->debug(TRUE);
		 return "?errores=".$cont.$out;
	}

}



?>
