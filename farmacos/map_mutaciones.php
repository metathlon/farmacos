<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script src="inc/jquery-1.10.2.min.js"></script>
<script src="inc/cytoscape.min.js"></script>
<style>
body { 
  font: 14px helvetica neue, helvetica, arial, sans-serif;
  margin:10;
}
#cy {
  height: 800px;
  width: 800px;
  border:1px solid;
  position: absolute;
  left: 20;
  top: 20;
}
</style>
</head>
<body>
  <div id="cy"></div>
</body>
</html>

<script type="text/javascript">
$('#cy').cytoscape({
  showOverlay: false,
  layout:{ name:'circle' },
  
  
  style: cytoscape.stylesheet()
    .selector('node')
      .css({
        'content': 'data(name)',
        'text-valign': 'center',
        'color': 'white',
        'text-outline-width': 2,
        'text-outline-color': '#888',
    	 'width' :'100',
	 	'height':'50'
	 
	  })
    .selector('edge')
      .css({
        'target-arrow-shape': 'triangle'
      })
    .selector(':selected')
      .css({
        'background-color': 'black',
        'line-color': 'black',
        'target-arrow-color': 'black',
        'source-arrow-color': 'black'
      })
    .selector('.mutclass')
      .css({
        'background-color': 'red',
        'shape' :'hexagon',
     	'width' :'150',
	 	'height':'150'
	  })
    
	
	.selector('.faded')
      .css({
        'opacity': 0.25,
        'text-opacity': 0
      }),
  
  elements: {
    nodes: [
     <?
	 for ($i = 1; $i <= 30; $i++) {
  	 echo "{ data: { id: 'n_".$i."', name: 'Patw".$i."'}},\n";
	 } 	 
	 ?>
	  { 
	  data: { id: 'mut', name: 'ABL' },
	  group: 'nodes',
      position: {
          x: 400,
          y: 400
        },
        classes: 'mutclass',
		selected: true,
        selectable: true,
        locked: true,
		grabbable: true
	  }
     
    ],
   
   
   
   
   
    edges: [
       <?
	 for ($i = 1; $i <= 30; $i++) {
		echo "{ data: { source: 'mut', target: 'n_".$i."'}},\n";
	 } 	 
	 ?>	  
    ]
  },
  
 ready: function(){
    window.cy = this;
 }


});
</script>



