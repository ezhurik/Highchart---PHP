<!DOCTYPE html>
<html>
<head>
	<title>High Chart</title>
	
	<script type="text/javascript" src="<?= base_url('js/moment.js'); ?>" ></script>
	<script type="text/javascript" src="<?= base_url('js/twix.js'); ?>"></script>
	<script src="<?= base_url('js/highcharts.js'); ?>" ></script>
	<script src="<?= base_url('js/exporting.js'); ?>" ></script>
	<script type="text/javascript">

		var beforethirtyDays = new Date(new Date().setDate(new Date().getDate() - 30));
		var currentDate = new Date(new Date().setDate(new Date().getDate()));
		var itr = moment.twix(moment(beforethirtyDays).format("YYYY-MM-DD"),moment(currentDate).format("YYYY-MM-DD")).iterate("days");
		var range=[];
		while(itr.hasNext()){
			range.push(moment(itr.next()).format("MMM Do"))
		}
	</script>
</head>
<body>

	<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto">

	</div>


</body>
</html>


<?php 
$chartStr="";
$counter=1;
foreach($dailyReports as $row)
{
	if($counter ==1)
	{
		$chartStr .=$row;
	}
	else
	{
		$chartStr .=",".$row;
	}
	$counter++;
}

?>

<script type="text/javascript">

	Highcharts.chart('container', {
		chart: {
			type: 'line'
		},
		title: {
			text: 'Previous 30 Days Sale'
		},
    subtitle: {
      text: 'Reports'
    },
    xAxis: {
    	categories: range
    },
    yAxis: {
    	title: {
    		text: 'Number of Orders'
    	}
    },
    plotOptions: {
    	line: {
    		dataLabels: {
    			enabled: true
    		},
    		enableMouseTracking: false
    	}
    },
    series: [{
    	name: 'Dates',
    	data: [<?= $chartStr ?>]
    }]
});
</script>