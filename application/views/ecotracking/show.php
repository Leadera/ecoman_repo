<script src="https://code.highcharts.com"></script>
<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
<script type="text/javascript">
	$(function () {
    var seriesOptions = [],
        seriesCounter = 0,
        names = ['AAPL'];

    /**
     * Create the chart when all data is loaded
     * @returns {undefined}
     */
    function createChart() {

        $('#container').highcharts('StockChart', {

            rangeSelector: {
                selected: 4
            },

            yAxis: {
                labels: {
                    formatter: function () {
                        return (this.value > 0 ? ' + ' : '') + this.value + '%';
                    }
                },
                plotLines: [{
                    value: 0,
                    width: 2,
                    color: 'silver'
                }]
            },

            plotOptions: {
                series: {
                    compare: 'percent'
                }
            },

            tooltip: {
                pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.change}%)<br/>',
                valueDecimals: 2
            },

            series: seriesOptions
        });
    }

    $.each(names, function (i, name) {

        $.getJSON('<?php echo base_url(); ?>ecotracking/json/131/1',function (data) {

            seriesOptions[i] = {
                name: name,
                data: data
            };

            // As we're loading the data asynchronously, we don't know what order it will arrive. So
            // we keep a counter and create the chart when all the data is loaded.
            seriesCounter += 1;

            if (seriesCounter === names.length) {
                createChart();
            }
        });
    });
});
</script>

<div id="container" style="height: 400px; min-width: 310px"></div>

<div class="container">
	<p>Dizayn Makina Eco Tracking Page</p>
	<a class="btn btn-info pull-right" href="http://212.156.205.183:8081/olcum/">Instant Tracking Data</a>
	<p>Daily consumption values for Machine 1</p>
	<table class="table table-hover">
		<tr>
			<th>Date</th><th>Power 1</th><th>Power 2</th><th>Power 3</th>
		</tr>
		<?php foreach($veriler as $v): ?>
			<tr>
				<td><?php echo $v['date'] ?></td><td><?php echo $v['powera'] ?> kVa</td><td><?php echo $v['powerb'] ?> kVa</td><td><?php echo $v['powerc'] ?> kVa</td>
			</tr>
		<?php endforeach ?>
	</table>
</div>