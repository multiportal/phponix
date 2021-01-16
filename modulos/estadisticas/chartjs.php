<?php
if($opc=='semana'){
  if($_POST['sem']){
    $sem=$_POST['sem'];
  }else{
    $fecha=date('Y-m-d');
    $fecha = new DateTime($fecha);
    $semana = $fecha->format('W');
    $sem=$semana;
  }
  $week2 = $sem-1;$k=-3;
  for($i=0; $i<7; $i++){$k++;
    $day_sem.= "'".date('Y-m-d', strtotime('01/00-1 +' . $week2 . ' weeks first day +' . $k . ' day'))."'";
    $day_f=date('Y-m-d', strtotime('01/00-1 +' . $week2 . ' weeks first day +' . $k . ' day'));
	  $sql=mysqli_query($mysqli,"SELECT DISTINCT ip FROM `".$DBprefix."visitas` WHERE fecha LIKE '%".$day_f."%';") or print mysqli_error($mysqli);
	  $num_v=mysqli_num_rows($sql);
	  $data.=$num_v;
	  if($i<6){$day_sem.=', ';$data.=', ';}
  }
  $label=$day_sem;
}else{
  if($_POST['years']){$year=$_POST['years'];}

  $meses = array("Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic");
  $mes_num = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
  for($m=0;$m<=11;$m++){
	  $meses_array.='"'.$meses[$m].'"';
	  if($m<11){$meses_array.=', ';}
  }
  $label=$meses_array;

  for($i=0;$i<=11;$i++){
    $sql_v=mysqli_query($mysqli,"SELECT DISTINCT ip FROM `".$DBprefix."visitas` WHERE fecha LIKE '%".$year."-".$mes_num[$i]."%';") or print mysqli_error($mysqli);
	  $num_v=mysqli_num_rows($sql_v);
    $data.=$num_v;
    if($i<11){$data.=', ';}
  }

}
$contenido='// JavaScript Document
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */
    //--------------
    //- AREA CHART -
    //--------------
    var areaChartData = {
      labels: ['.$label.'],
      datasets: [
        /*{
          label: "Electronics",
          fillColor: "rgba(210, 214, 222, 1)",
          strokeColor: "rgba(210, 214, 222, 1)",
          pointColor: "rgba(210, 214, 222, 1)",
          pointStrokeColor: "#c1c7d1",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(220,220,220,1)",
          data: [65, 59, 80, 81, 56, 55, 40, 0, 0, 0, 0, 0]
        },*/
        {
          label: "Digital Goods",
		  	  fillColor : "rgba(151,187,205,0.5)",
			    strokeColor : "rgba(151,187,205,0.8)",
			    highlightFill : "rgba(151,187,205,0.75)",
			    highlightStroke : "rgba(151,187,205,1)",
          pointColor: "#3b8bba",
          pointStrokeColor: "rgba(60,141,188,1)",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(60,141,188,1)",
          data: ['.$data.']
        }
      ]
    };

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $("#barChart").get(0).getContext("2d");
    var barChart = new Chart(barChartCanvas);
    var barChartData = areaChartData;
    var barChartOptions = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: true,
      //String - Colour of the grid lines
      scaleGridLineColor: "rgba(0,0,0,.05)",
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - If there is a stroke on each bar
      barShowStroke: true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth: 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing: 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing: 1,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
      //Boolean - whether to make the chart responsive
      responsive: true,
      maintainAspectRatio: true
    };

    barChartOptions.datasetFill = false;
    barChart.Bar(barChartData, barChartOptions);
  });
';
crear_archivo('modulos/'.$mod.'/js/','chartjs.js',$contenido,$path_file);
if(file_exists($path_file)){echo '<script src="'.$page_url.$path_file.'"></script>';}
?>