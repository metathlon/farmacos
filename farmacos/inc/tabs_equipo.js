// Declaro un array en el cual los indices son los ID's de los DIVS que funcionan como pestaña y los valores son los identificadores de las secciones a cargar
var tabsId=new Array();
tabsId['tab1']='tabDg';
tabsId['tab2']='tabDd';
tabsId['tab3']='tabDs';
tabsId['tab4']='tabDh';
tabsId['tab5']='tabDm';


// Declaro el ID del DIV que actuará como contenedor de los datos recibidos
var contenedor='tabDf';


function cargaContenido()
{
	/* Recorro las pestañas para dejar en estado "apagado" a todas menos la que se ha clickeado. Teniendo en cuenta que solo puede haber una pestaña "encendida"
	a la vez resultaría mas óptimo hacer un while hasta encontrar a esa pestaña, cambiarle el estilo y luego salir, pero, creanme, se complicaría un poco el
	ejemplo y no es mi intención complicarlos */
	for(key in tabsId)
	{
		// Obtengo el elemento
		elemento=document.getElementById(key);
		seccion=tabsId[elemento.id];
		capa_eq=document.getElementById(seccion);
		//capa_eq.style.visibility='hidden';
		capa_eq.style.display='none';
		// Si es la pestaña activa
		if(elemento.className=='tabOn')
		{
			// Cambio el estado de la pestaña a inactivo 
			elemento.className='tabOff';
			//capa_eq.style.visibility='hidden';
		}
	}
	// Cambio el estado de la pestaña que se ha clickeado a activo
	this.className='tabOn';
	seccion=tabsId[this.id];
	capa_eq=document.getElementById(seccion);
	//capa_eq.style.visibility='visible';
	capa_eq.style.display='block';
}

function mouseSobre()
{
	// Si el evento no se produjo en la pestaña seleccionada...
	if(this.className!='tabOn')
	{
		// Cambio el color de fondo de la pestaña
		this.className='tabHover';
	}
}

function mouseFuera()
{
	// Si el evento no se produjo en la pestaña seleccionada...
	if(this.className!='tabOn')
	{
		// Cambio el color de fondo de la pestaña
		this.className='tabOff';
	}
}

onload=function()
{
	for(key in tabsId)
	{
		// Voy obteniendo los ID's de los elementos declarados en el array que representan a las pestañas
		elemento=document.getElementById(key);
		//alert (elemento.id);
		// Asigno que al hacer click en una pestaña se llame a la funcion cargaContenido
		elemento.onclick=cargaContenido;
		/* El cambio de estilo es en 2 funciones diferentes debido a la incompatibilidad del string de backgroundColor devuelto por Mozilla e IE.
		Se podría pasar de rgb(xxx, xxx, xxx) a formato #xxxxxx pero complicaría innecesariamente el ejemplo */
		elemento.onmouseover=mouseSobre;
		elemento.onmouseout=mouseFuera;
	}
	// Obtengo la capa contenedora de datos
	tabContenedor=document.getElementById(contenedor);

}
function objetoAjax(){
var xmlhttp=false;
try {
xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
} catch (e) {
try {
xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
} catch (E) {
xmlhttp = false;
}
}

if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
xmlhttp = new XMLHttpRequest();
}
return xmlhttp;
}

function lookup(inputString,nDestino,iDestino) {
		//alert(inputString);
		theObject = document.getElementById('comp_1');
		if(inputString.length == 0) {
			// Hide the suggestion box.
		theObject.style.visibility='hidden';
		} else {
			urlDestino="lx_empresas.php?nDestino=" + nDestino + "&iDestino=" + iDestino;
			ajax=objetoAjax();
        	ajax.open("POST", urlDestino,true);
			ajax.onreadystatechange=function() {
					if (ajax.readyState==4) {
					theObject.innerHTML = ajax.responseText
					}
			}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("p_letra="+inputString)
		//theObject.style.visibility='visible';
		theObject.style.visibility='visible';
		} 
}
function actualiza_tiempos() {
		//alert(inputString);
		theObject = document.getElementById('ctiempos');
		/*
		urlDestino="lx_tiempos.php?nDestino=" + nDestino + "&iDestino=" + iDestino;
		ajax=objetoAjax();
        ajax.open("POST", urlDestino,true);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==4) {
			theObject.innerHTML = ajax.responseText
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		*/
		//ajax.send("p_letra="+inputString)
			
		
}