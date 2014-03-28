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

function cargar_farmacos_pathway(pmt1) {
		//alert(inputString);
		 var nombre_div_path='cpath_' +  pmt1;
		 //theObject = window.opener.document.getElementById('ctoxicidades2');
         theObject2 = window.opener.document.getElementById('cpathways');
		 theObject3=document.getElementById(nombre_div_path);
		 var texto_div='<p class="leyenda">' +  theObject3.innerHTML + '</p>';
		 theObject2.innerHTML = theObject2.innerHTML + texto_div;
		 urlDestino="functions_custom.php?op=cfpw&id_pathway="+ pmt1;
		// urlDestino="lx_fpw.php?id_pathway="+ pmt1;
		ajax=objetoAjax();
        ajax.open("POST", urlDestino,true);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==4) {
			//theObject.innerHTML = ajax.responseText
			mostrar_farmacos_pathway();
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send(null)
}

function mostrar_farmacos_pathway() {
		theObject = window.opener.document.getElementById('ctoxicidades1');   
		urlDestino="lx_fpw.php?cat_farmaco=1"; 
		ajax=objetoAjax();
        ajax.open("POST", urlDestino,true);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==4) {
			theObject.innerHTML = ajax.responseText
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send(null)
		
        theObject2 = window.opener.document.getElementById('ctoxicidades2');   
		urlDestino2="lx_fpw.php?cat_farmaco=2"; 
		ajax2=objetoAjax();
        ajax2.open("POST", urlDestino2,true);
		ajax2.onreadystatechange=function() {
			if (ajax2.readyState==4) {
			theObject2.innerHTML = ajax2.responseText
			}
		}
		ajax2.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax2.send(null)
}

function compara_farmacos_pathway(pmt) {
		theObject = document.getElementById('ccomparar');
		urlDestino="lx_comparar_fpw.php?" + pmt;
		ajax=objetoAjax();
                ajax.open("POST", urlDestino,true);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==4) {
			theObject.innerHTML = ajax.responseText
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send(null)	
}
function actualiza_div_finv(ffda,finv) {
        var div_destino='ctoxicidades2_' + ffda + '_' +  finv;
		theObject = document.getElementById(div_destino);
        urlDestino="lx_tx2.php?id_farmaco="+ finv;
		
		ajax=objetoAjax();
        ajax.open("POST", urlDestino,true);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==4) {
			theObject.innerHTML = ajax.responseText
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("p1")
		//ajax.send("p_letra="+inputString)     
}
function actualiza_div_ffda(ffda,finv) {
        var div_destino='ctoxicidades1_' + ffda + '_' +  finv;
		theObject = document.getElementById(div_destino);
        urlDestino="lx_tx1.php?id_farmaco="+ ffda;
		
		ajax=objetoAjax();
        ajax.open("POST", urlDestino,true);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==4) {
			theObject.innerHTML = ajax.responseText
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("p1")
		//ajax.send("p_letra="+inputString)     
}
function actualiza_div_ffda2(ffda,finv) {
        var div_destino='ctoxicidades1f_' + ffda + '_' +  finv;
		theObject = document.getElementById(div_destino);
        urlDestino="lx_tx1.php?id_farmaco="+ ffda;
		
		ajax=objetoAjax();
        ajax.open("POST", urlDestino,true);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==4) {

			theObject.innerHTML = ajax.responseText
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("p1")
		//ajax.send("p_letra="+inputString)     
}



function actualiza_div_fam(ffda,finv) {
        var div_destino='ctoxicidades2f_' + ffda + '_' +  finv;
		theObject = document.getElementById(div_destino);
		urlDestino="lx_txf2.php?id_categoria_diana="+ finv;
		ajax=objetoAjax();
        ajax.open("POST", urlDestino,true);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==4) {
			theObject.innerHTML = ajax.responseText
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("p1")
		//ajax.send("p_letra="+inputString)     
}
function actualiza_tx1(pmt1) {
		//alert(inputString);
                theObject = document.getElementById('ctoxicidades1');
		theObject2 = document.getElementById('ccomparar');
                theObject2.innerHTML='';
                if (pmt1==0){
                theObject.innerHTML='';
                }else{
                urlDestino="lx_tx1.php?id_farmaco="+ pmt1;
		ajax=objetoAjax();
                ajax.open("POST", urlDestino,true);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==4) {
			theObject.innerHTML = ajax.responseText
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("p1")
		//ajax.send("p_letra="+inputString)
		}	
		
}

function actualiza_tx2(pmt2) {
		//alert(inputString);
                theObject = document.getElementById('ctoxicidades2');
		theObject2 = document.getElementById('ccomparar');
                theObject2.innerHTML='';
                if (pmt2==0){
                theObject.innerHTML='';
                }else{
                urlDestino="lx_tx2.php?id_farmaco="+ pmt2;
		ajax=objetoAjax();
        ajax.open("POST", urlDestino,true);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==4) {
			theObject.innerHTML = ajax.responseText
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("p1")
		//ajax.send("p_letra="+inputString)
                }		
}

function actualiza_txf2(pmt2) {
		//alert(inputString);
                theObject = document.getElementById('ctoxicidades2');
				theObject2 = document.getElementById('ccomparar');
                theObject2.innerHTML='';
                if (pmt2==0){
                theObject.innerHTML='';
                }else{
                urlDestino="lx_txf2.php?id_categoria_diana="+ pmt2;
		ajax=objetoAjax();
        ajax.open("POST", urlDestino,true);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==4) {
			theObject.innerHTML = ajax.responseText
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("p1")
		//ajax.send("p_letra="+inputString)
                }		
}



function actualiza_in1(pmt1) {
                theObject = document.getElementById('ctoxicidades1');
                if (pmt1==0){
                theObject.innerHTML='';
                }else{
                urlDestino="lx_in1.php?id_farmaco="+ pmt1;
		ajax=objetoAjax();
        ajax.open("POST", urlDestino,true);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==4) {
			theObject.innerHTML = ajax.responseText
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("p1")
		//ajax.send("p_letra="+inputString)
                }		
}


function compara(fm1,fm2) {
		//alert(inputString);
                if (fm2==0){
                  alert("Seleccione farmaco");              
                }else{
                theObject = document.getElementById('ccomparar');
		urlDestino="lx_comparar.php?id_farmaco1="+ fm1 + "&id_farmaco2=" + fm2;
		ajax=objetoAjax();
                ajax.open("POST", urlDestino,true);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==4) {
			theObject.innerHTML = ajax.responseText
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("p1")
		//ajax.send("p_letra="+inputString)
                }
}

function compara_familia(fm1,fm2) {
		//alert(inputString);
                if (fm2==0){
                  alert("Seleccione familia");              
                }else{
                theObject = document.getElementById('ccomparar');
		urlDestino="lx_comparar_familia.php?id_farmaco1="+ fm1 + "&id_categoria_diana=" + fm2;
		ajax=objetoAjax();
                ajax.open("POST", urlDestino,true);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==4) {
			theObject.innerHTML = ajax.responseText
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("p1")
		//ajax.send("p_letra="+inputString)
                }
}



function actualiza_txopt2(pmt2) {
		//alert(inputString);
                theObject = document.getElementById('ctoxicidades2');
                if (pmt2==0){
                theObject.innerHTML='';
                }else{
                urlDestino="lx_txopt2.php?id_farmaco="+ pmt2;
		ajax=objetoAjax();
        ajax.open("POST", urlDestino,true);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==4) {
			theObject.innerHTML = ajax.responseText
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send("p1")
		//ajax.send("p_letra="+inputString)
                }		
}

function actualiza_custom(div_origen) {
		//alert(inputString);
                if (div_origen==1){
                theObject = document.getElementById('filtro_n21');
                theObject2 = document.getElementById('ctoxicidades1');
                if(document.getElementById('radio_custom11').checked){
                var pf1e2=1;
                }else{
                var pf1e2=2;      
                }
                var pf1e1=document.getElementById('select_custom1').value;
                 }
                if (div_origen==2){
                theObject = document.getElementById('filtro_n22');
                theObject2 = document.getElementById('ctoxicidades2');
                if(document.getElementById('radio_custom21').checked){
                var pf1e2=1;
                }else{
                var pf1e2=2;      
                }
                var pf1e1=document.getElementById('select_custom2').value;
                }
                
                
                
               
               
                //pf1e2 parametrofiltro1elemento2
                theObject2.innerHTML='';
                if (pf1e1==-1){
                theObject.innerHTML='';
                }else{
              
                urlDestino="lx_filtron2.php?divo=" + div_origen + "&pf1e1="+ pf1e1 + "&pf1e2=" + pf1e2;
               
                //urlDestino="lx_filtron2.php?id_farmaco="+ pmt2;
		ajax=objetoAjax();
                ajax.open("GET", urlDestino,true);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==4) {
			theObject.innerHTML = ajax.responseText
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send(null)
		
                }		
}


function actualiza_nivel3(div_origen) {
		//alert (div_origen);
			  if (div_origen==1){
				var pf1e1=document.getElementById('select_custom1').value;
				var pf2=document.getElementById('select_farm1').value;
                                                if(document.getElementById('radio_custom11').checked){
                                                var pf1e2=1;
                                                }else{
                                                var pf1e2=2;      
                                                }
				theObject = document.getElementById('ctoxicidades1');
				}
				if (div_origen==2){
				var pf1e1=document.getElementById('select_custom2').value;
				var pf2=document.getElementById('select_farm2').value;
					if(document.getElementById('radio_custom21').checked){
                	var pf1e2=1;
                	}else{
                	var pf1e2=2;      
                	}
				theObject = document.getElementById('ctoxicidades2');
				}
			
                		if (pf2==-1){
                theObject.innerHTML='';
				}else if(pf2==0) { 
				theObject.innerHTML="<p>ALL</p>";
				}else{
                urlDestino="lx_filtron3.php?pf1e1="+ pf1e1 + "&pf1e2=" + pf1e2 + "&pf2=" + pf2;
               
                //urlDestino="lx_filtron2.php?id_farmaco="+ pmt2;
		ajax=objetoAjax();
                ajax.open("GET", urlDestino,true);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==4) {
			theObject.innerHTML = ajax.responseText
			}
		}
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		ajax.send(null)
		
                }		

}

