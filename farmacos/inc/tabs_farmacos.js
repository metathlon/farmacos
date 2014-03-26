// Declaro un array en el cual los indices son los ID's de los DIVS que funcionan como pesta�a y los valores son los identificadores de las secciones a cargar
var tabsId=new Array();
tabsId['tab1']='tabCont1';
tabsId['tab2']='tabCont2';
tabsId['tab3']='tabCont3';
tabsId['tab4']='tabCont4';
tabsId['tab5']='tabCont5';


// Declaro el ID del DIV que actuar� como contenedor de los datos recibidos
var contenedor='tabDf';


function cargaContenido()
{
	/* Recorro las pesta�as para dejar en estado "apagado" a todas menos la que se ha clickeado. Teniendo en cuenta que solo puede haber una pesta�a "encendida"
	a la vez resultar�a mas �ptimo hacer un while hasta encontrar a esa pesta�a, cambiarle el estilo y luego salir, pero, creanme, se complicar�a un poco el
	ejemplo y no es mi intenci�n complicarlos */
	for(key in tabsId)
	{
		// Obtengo el elemento
		elemento=document.getElementById(key);
		seccion=tabsId[elemento.id];
		capa_eq=document.getElementById(seccion);
		//capa_eq.style.visibility='hidden';
		capa_eq.style.display='none';
		// Si es la pesta�a activa
		if(elemento.className=='tabOn')
		{
			// Cambio el estado de la pesta�a a inactivo 
			elemento.className='tabOff';
			//capa_eq.style.visibility='hidden';
		}
	}
	// Cambio el estado de la pesta�a que se ha clickeado a activo
	this.className='tabOn';
	seccion=tabsId[this.id];
	capa_eq=document.getElementById(seccion);
	//capa_eq.style.visibility='visible';
	capa_eq.style.display='block';
}

function mouseSobre()
{
	// Si el evento no se produjo en la pesta�a seleccionada...
	if(this.className!='tabOn')
	{
		// Cambio el color de fondo de la pesta�a
		this.className='tabHover';
	}
}

function mouseFuera()
{
	// Si el evento no se produjo en la pesta�a seleccionada...
	if(this.className!='tabOn')
	{
		// Cambio el color de fondo de la pesta�a
		this.className='tabOff';
	}
}

onload=function()
{
	for(key in tabsId)
	{
		// Voy obteniendo los ID's de los elementos declarados en el array que representan a las pesta�as
		elemento=document.getElementById(key);
		//alert (elemento.id);
		// Asigno que al hacer click en una pesta�a se llame a la funcion cargaContenido
		elemento.onclick=cargaContenido;
		/* El cambio de estilo es en 2 funciones diferentes debido a la incompatibilidad del string de backgroundColor devuelto por Mozilla e IE.
		Se podr�a pasar de rgb(xxx, xxx, xxx) a formato #xxxxxx pero complicar�a innecesariamente el ejemplo */
		elemento.onmouseover=mouseSobre;
		elemento.onmouseout=mouseFuera;
	}
	// Obtengo la capa contenedora de datos
	tabContenedor=document.getElementById(contenedor);

}

