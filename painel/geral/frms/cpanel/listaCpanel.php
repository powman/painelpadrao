<!-- Donut -->
<div class="oneThree" style="width:94%; margin: 0 3%;">
    <div class="widget">
        <div class="title"><img src="images/icons/dark/stats.png" alt="" class="titleIcon" /><h6>Espaço de Disco Rígido - <?php echo $aDados['acct']['domain'];?></h6></div>
        <div class="body">
            <h6>
                <strong>Cliente Desde:</strong> <?php echo date('d/m/Y H:i:s', $aDados['acct']['unix_startdate']);?>
            </h6>
            <p>
               <strong>Usuário:</strong> <?php echo $aDados['acct']['user'];?> 
            </p>
            <p>
               <strong>Domínio:</strong> <?php echo $aDados['acct']['domain'];?> 
            </p>
            <p>
               <strong>Email:</strong> <?php echo $aDados['acct']['email'];?> 
            </p>
            <p>
               <strong>Plano:</strong> <?php echo $aDados['acct']['plan'];?> 
            </p>
            <p>
               <strong>IP:</strong> <?php echo $aDados['acct']['ip'];?> 
            </p>
            <p>
               <strong>Número de Ftps:</strong> <?php echo $aDados['acct']['maxftp'] == 'unlimited' ? 'Ilimitado' : $aDados['acct']['maxftp'];?> 
            </p>
            <p>
               <strong>Número de Emails:</strong> <?php echo $aDados['acct']['maxpop'] == 'unlimited' ? 'Ilimitado' : $aDados['acct']['maxpop'];?> 
            </p>
            <p>
               <strong>Número de Banco de Dados:</strong> <?php echo $aDados['acct']['maxsql'] == 'unlimited' ? 'Ilimitado' : $aDados['acct']['maxsql'];?> 
            </p>
            <p>
               <strong>Número de Subdomínios:</strong> <?php echo $aDados['acct']['maxsub'] == 'unlimited' ? 'Ilimitado' : $aDados['acct']['maxsub'];?> 
            </p>
            <p style="color: <?php echo $aDados['acct']['suspended'] ? 'red' : 'green';?>; font-size: 15px;">
               <strong>Status:</strong> <?php echo $aDados['acct']['suspended'] ? 'Suspenso' : 'Ativo';?> 
            </p>
        </div>
    </div>
</div>
<!-- Donut -->
<div class="oneThree" style="width:94%; margin: 0 3%;">
    <div class="widget">
        <div class="title"><img src="images/icons/dark/stats.png" alt="" class="titleIcon" /><h6>Espaço de Disco Rígido - <?php echo $aDados['acct']['domain'];?></h6></div>
        <div class="body"><div class="pie" id="donut"></div></div>
    </div>
</div>

<script>


$(function () {
	var data = [
                { label: "Disco Total <?php echo $objUteis->byte_format(str_replace("M", "", $aDados['acct']['disklimit']));?>" },
	        	{ label: "Disco Restante <?php echo $objUteis->byte_format((str_replace("M", "", $aDados['acct']['disklimit']) - str_replace("M", "", $aDados['acct']['diskused'])));?>", data: <?php echo str_replace("M", "", $aDados['acct']['disklimit']) - str_replace("M", "", $aDados['acct']['diskused'])?> },
	        	{ label: "Disco Usado <?php echo $objUteis->byte_format($aDados['acct']['diskused']);?>", data: <?php echo str_replace("M", "", $aDados['acct']['diskused'])?> }
	];


$.plot($("#donut"), data, 
{
		series: {
			pie: { 
				show: true,
				innerRadius: 0.5,
				radius: 1,
				label: {
					show: false,
					radius: 2/3,
					formatter: function(label, series){
						return '<div style="font-size:11px;text-align:center;padding:4px;color:white;">'+label+'<br/>'+Math.round(series.percent)+'%</div>';
					},
					threshold: 0.1
				}
			}
		},
		legend: {
			show: true,
			noColumns: 1, // number of colums in legend table
			labelFormatter: null, // fn: string -> string
			labelBoxBorderColor: "#000", // border color for the little label boxes
			container: null, // container (as jQuery object) to put legend in, null means default on top of graph
			position: "ne", // position of default legend container within plot
			margin: [5, 10], // distance from grid edge to default legend container within plot
			backgroundColor: "#efefef", // null means auto-detect
			backgroundOpacity: 1 // set to 0 to avoid background
		},
		grid: {
			hoverable: true,
			clickable: true
		},
});
$("#interactive").bind("plothover", pieHover);
$("#interactive").bind("plotclick", pieClick);

});

function pieHover(event, pos, obj) 
{
	if (!obj)
				return;
	percent = parseFloat(obj.series.percent).toFixed(2);
	$("#hover").html('<span style="font-weight: bold; color: '+obj.series.color+'">'+obj.series.label+' ('+percent+'%)</span>');
}
function pieClick(event, pos, obj) 
{
	if (!obj)
				return;
	percent = parseFloat(obj.series.percent).toFixed(2);
	alert(''+obj.series.label+': '+percent+'%');
}
</script>