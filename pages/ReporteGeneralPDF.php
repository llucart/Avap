<?php require_once '../controllers/usuario/check.php'; ?>
<?php require_once '../controllers/usuario/isPreDir.php'; ?>
<?php require_once 'layout/head.php'; ?>
<?php require_once 'layout/nav.php'; ?>



<div class="col-xs-8 col-xs-offset-2 col-sm-2 col-sm-offset-3 col-md-4 col-md-offset-0 col-lg-4 col-lg-offset-4">

  <div class="form-group">
    <img src="../public/img/GRAFICOS.jpg">   
	     <a href="./generarReporte" title="Generar estadistica" class="btn btn-danger glyphicon glyphicon-stats"> ESTADISTICA GRAFICA DE FACTURAS</a>	
    </div>
    <div class="form-group">
        <a href="./generarReporteNota" title="Generar estadistica" class="btn btn-warning glyphicon glyphicon-stats"> ESTADISTICA GRAFICA DE ENTREGAS</a>   
    </div>
  
    <div class="form-group"><br>
      <img src="../public/img/PDF.jpg">
        <strong>Reporte por mes: </strong><br>    
        <form method="post" action="../controllers/reportes/reporteGeneral.php">
            <select name="mes" required class="form-control">
              <option value="">Selecciona un mes</option>
              <option value="1">Enero</option>
              <option value="2">Febrero</option>
              <option value="3">Marzo</option>
              <option value="4">Abril</option>
              <option value="5">Mayo</option>
              <option value="6">Junio</option>
              <option value="7">Julio</option>
              <option value="8">Agosto</option>
              <option value="9">Septiembre</option>
              <option value="10">Octubre</option>
              <option value="11">Noviembre</option>
              <option value="12">Diciembre</option>
            </select>

            <select name="anio"  required class="form-control">
              <option value="">Selecciona un año</option>
                  <?php for($i=2011; $i<=date("Y"); $i++){  ?>
                  <option value="<?php echo $i; ?>">
                  <?php echo $i; ?>        
                </option>
                  <?php } ?>
            </select>
           

            <div class="form-group">
                <button type="submit" class="btn btn-primary glyphicon glyphicon-list-alt"></button>
            </div> 
        </form>
        </div> 
        
  </div>

  <div class="col-xs-2 col-sm-2 col-md-8 col-lg-2 pull-left">
    <img src="../public/img/reporte.jpg">
  </div>

<?php require_once 'layout/footer.php'; ?>