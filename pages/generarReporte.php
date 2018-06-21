<?php require_once '../controllers/usuario/check.php'; ?>
<?php require_once '../controllers/usuario/isPreDir.php'; ?>
<?php require_once 'layout/head.php'; ?>
<?php require_once 'layout/nav.php'; ?>

<div id="grafico"></div>

<?php require_once 'layout/footer.php'; ?>

<script type="text/javascript">
	window.addEventListener('DOMContentLoaded', factura, false);
	function factura(){
		$.ajax({
	        url: "../controllers/facturas/generar.php",
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
			var pagadas = [];
			var nopagadas = [];
            var anuladas = [];
            var anio = [];
            var mes = [];
            var totalp = [];
            var totalnp = [];
            var totala = [];

            for(var i=0; i<data.length; i++){             
              pagadas.push(data[i].pagadas);
              nopagadas.push(data[i].nopagadas);
              anuladas.push(data[i].anuladas);
              anio.push(data[i].anio);
          	  mes.push(data[i].mes);
          	  totalp.push(data[i].totalp);
          	  totalnp.push(data[i].totalnp);
          	  totala.push(data[i].totala);
            }
            
			Highcharts.chart('grafico', {
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
					text: 'Facturas del ' + anio[0]
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
		    	name: 'Anuladas',
		        data: totala
		    },
		    {
		    	name: 'No Pagadas',
		    	data: totalnp
		    },
			{
		    	name: 'Pagadas',
		    	data: totalp
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