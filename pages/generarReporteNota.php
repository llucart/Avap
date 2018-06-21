<?php require_once '../controllers/usuario/check.php'; ?>
<?php require_once '../controllers/usuario/isPreDir.php'; ?>
<?php require_once 'layout/head.php'; ?>
<?php require_once 'layout/nav.php'; ?>

<div id="grafico1"></div>

<?php require_once 'layout/footer.php'; ?>

<script type="text/javascript">
	window.addEventListener('DOMContentLoaded', notaEntrega, false);
	function notaEntrega(){
		$.ajax({
	        url: "../controllers/notaEntrega/generar.php",
	        type: "get",
	        success: function (response) {
	           console.log(response); 
	           dibuja(JSON.parse(response));               
	        },
	        error: function(jqXHR, textStatus, errorThrown) {
	           console.log(textStatus, errorThrown);
	        }

	    });
	}

	function dibuja(data){
			var enviados = [];
			var recibidos = [];
			var extraviados = [];
			var devueltos = [];
            var anio = [];
            var mes = [];
            var costoE = [];
            var costoR = [];
            var costoEx = [];
            var costoD = [];
            var costot = [];

            for(var i=0; i<data.length; i++){             
              enviados.push(data[i].enviados);
              recibidos.push(data[i].recibidos);
              extraviados.push(data[i].extraviados);
              devueltos.push(data[i].devueltos);
              anio.push(data[i].anio);
          	  mes.push(data[i].mes);
          	  costoE.push(data[i].costoE);
          	  costoR.push(data[i].costoR);
          	  costoEx.push(data[i].costoEx);
          	  costoD.push(data[i].costoD);
          	  costot.push(data[i].costot);
            }
            
			Highcharts.chart('grafico1', {
			chart:{
				type:'column', //column, spline, areaspline, line, area, arearange
				animation: Highcharts.svg,
				 marginRight: 0,
	                plotShadow: false,
	                options3d: {
	                    enabled: true,
	                    alpha: 13,
	                    beta: 0,
	                    viewDistance: 25
	                }
			},

			title :{
					text: 'Envios del ' + anio[0]
			}, 
			credits: { 
          		enabled: false 
      		},
		    xAxis: {
		        categories: mes,
		        crosshair: true,
                reversed: false,
                maxPadding: 0.05,
                startOnTick: true,
                showFirstLabel: true,
                endOnTick: true,
                showLastLabel: true
		    },
		    yAxis: {
	            title: {
	                text: 'Datos'
	            },
	             labels: {
			           formatter: function () {
			                return this.value + ' ';
			            }
			        }
		    	
	        },
	        plotOptions: {
	        	series:{ //line, column y el mejor series
				    dataLabels:{
				    	enabled: true,
				    	format: '{point.y:.f}' //format: '{point.y}%' o '{point.y:.f}%'
				    },
				    enableMouseTracking:true
	        	}
	        },
	        tooltip:{
                shared: true,
                enabled: true
			},
		    series: [{
		    	name: 'devueltos',
		    	data: devueltos
		    },
		    {
		    	name: 'extraviados',
		    	data: extraviados
		    },
			{
		    	name: 'recibidos',
		    	data: recibidos
		    },
		    {
		    	name: 'enviados',
		    	data: enviados
		    }
		    ],
		    responsive:{
		    	rules:[{
		    		condition:{
		    			maxWidth: 500
		    		},
		    		chartOptions:{
		    			legend:{
		    				aling: 'center',
		    				verticalAling: 'bottom',
		    				layoud: 'horizontal'
		    			}
		    		}
		    	}]
		    }
		});
}
</script>