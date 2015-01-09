<!-- Donut -->
<div class="oneThree" style="width:94%; margin: 0 3%;">
    <div class="widget">
        <div class="title"><img src="images/icons/dark/stats.png" alt="" class="titleIcon" /><h6>Espaço de Disco Rígido - <?php echo $aDados['acct']['domain'];?></h6></div>
        <div class="body"><div class="pie" id="donut"></div></div>
    </div>
</div>

<div style="width:94%; margin: 0 3%;">
    <div class="widget">
        <div class="title"><img src="images/icons/dark/stats.png" alt="" class="titleIcon" /><h6>Contas de FTP - <?php echo $aDados['acct']['domain'];?></h6></div>
        <div class="body">
            <div style="margin: 5px 0px;">
                <h5>
                   FTP: ftp.<?php echo $aDados['acct']['domain'];?> 
                </h5>
                <h5>
                   PORTA: 21
                </h5>
            </div>
            <table width="100%">
                <tr>
                    <td width="50%">
                       <strong> Usuário</strong>
                    </td>
                    <td width="50%">
                       <strong> Diretório </strong>
                    </td>
                </tr>
                <?php for($i=0;$i<count($aFtps["data"]);$i++):
                $class = ($i%2 == 0)? '#fff': '#ccc';
                ?>
                <tr bgcolor="<?php echo $class;?>">
                    <td width="50%">
                        <?php echo $aFtps["data"][$i]['user'];?>
                    </td>
                    <td width="50%">
                        <?php echo $aFtps["data"][$i]['homedir'];?>
                    </td>
                </tr>
                <?php endfor;?>
            </table>
        </div>
    </div>
</div>

<div style="width:94%; margin: 0 3%;">
    <div class="widget">
        <div class="title"><img src="images/icons/dark/stats.png" alt="" class="titleIcon" /><h6>Emails - <?php echo $aDados['acct']['domain'];?></h6></div>
        <div class="body">
            
            <table width="100%">
                <tr>
                    <td width="25%">
                       <strong> Email</strong>
                    </td>
                    <td width="25%">
                       <strong>Disco Usado</strong>
                    </td>
                    <td width="25%">
                       <strong>Tamanho do Disco</strong>
                    </td>
                    <td width="25%">
                       <strong>Espaço Disponível</strong>
                    </td>
                </tr>
                <?php for($i=0;$i<count($aEmails["data"]);$i++):
                 $class = ($i%2 == 0)? '#fff': '#ccc';
                ?>
                <tr bgcolor="<?php echo $class;?>">
                    <td width="25%">
                        <?php echo $aEmails["data"][$i]['login'];?>
                    </td>
                    <td width="25%">
                        <?php echo $objUteis->byte_format($aEmails["data"][$i]['diskused'] * 1000);?>
                    </td>
                    <td width="25%">
                        <?php echo is_numeric($aEmails["data"][$i]['diskquota']) ? $objUteis->byte_format($aEmails["data"][$i]['diskquota'] * 1000) : $aEmails["data"][$i]['diskquota'];?>
                    </td>
                    <td width="25%">
                    <?php if($aEmails["data"][$i]['diskquota'] && $aEmails["data"][$i]['diskused'] && $aEmails["data"][$i]['diskquota'] != 0 && $aEmails["data"][$i]['diskused'] != 0):?>
                        <?php echo $objUteis->byte_format(($aEmails["data"][$i]['diskquota'] - $aEmails["data"][$i]['diskused'])* 1000);?>
                        <?php endif;?>
                    </td>
                </tr>
                <?php endfor;?>
            </table>
        </div>
    </div>
</div>

<script>


$(function () {
	var data = [
	        	{ label: "Disco Livre <?php echo $objUteis->byte_format($aDados['acct']['disklimit'] * 1000);?>", data: <?php echo str_replace("M", "", $aDados['acct']['disklimit']) - str_replace("M", "", $aDados['acct']['diskused'])?> },
	        	{ label: "Disco Usado <?php echo $objUteis->byte_format($aDados['acct']['diskused'] * 1000);?>", data: <?php echo str_replace("M", "", $aDados['acct']['diskused'])?> }
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