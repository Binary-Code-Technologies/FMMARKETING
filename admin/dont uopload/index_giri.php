<?php error_reporting(0);                                                                                                   include("../adminsession.php");
$pagename = "index.php";
$module = "Dashboard";
$submodule = "Dashboard";

$curr_date=date('Y-m-d');



$total_order=$cmn->getvalfield($connection,"bills","count(*)","billdate='$curr_date'"); 
//$total_sell=$cmn->getvalfield($connection,"bills","count(*)","billdate='$curr_date'");
$total_pending=$cmn->getvalfield($connection,"bills","count(*)","billdate='$curr_date' && is_completed='0'");
$total_completed=$cmn->getvalfield($connection,"bills","count(*)","billdate='$curr_date' && is_completed='1'");

$total_sell = $cmn->getTotalsell($curr_date);


?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php include("inc/top_files.php"); ?>
</head>

<body>

<div class="mainwrapper">
	
    <!-- START OF LEFT PANEL -->
    <?php include("inc/left_menu.php"); ?>
    
    <!--mainleft-->
    <!-- END OF LEFT PANEL -->
    
    <!-- START OF RIGHT PANEL -->
    
   <div class="rightpanel">
    	<?php include("inc/header.php"); ?>
        
        <div class="maincontent">
        	<div class="contentinner content-dashboard">
            	<div class="alert alert-info">
                	<button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Welcome!</strong> This alert needs your attention, but it's not super important.
                </div><!--alert-->
                
                <div class="row-fluid">
                	<div class="span12">
                    
                    
                    
                      <ul class="widgeticons row-fluid">
                
                        <li class="one_fifth"><a><small>&nbsp;</small><h1><?php echo $total_order; ?></h1><span>Today's Order</span></a></li>
<li class="one_fifth"><a><small>&nbsp;</small>
 <h1 style="color:#F00;"><?php echo $total_pending; ?> </h1>
  <span>Today's Pending</span></a> </li>

<li class="one_fifth"><a><small>&nbsp;</small><h1 style="color:#090;"><?php echo $total_completed; ?></h1><span>Today's Completed</span></a></li>
                           <li class="one_fifth"><a><small>&nbsp;</small><h1><?php echo "Rs.".$total_sell; ?></h1><span>Today's Sell</span></a></li>
                        </ul>
                     
                       
                        
                        <!--widgetcontent-->
                    
                    
                        
                        
                    	
                        
                        <br />
                        
                       <ul class="widgeticons row-fluid" style="display:none">
                        <li class="one_fifth"><a href="master_unit.php"><img src="../img/gemicon/location.png" alt="" /><span>Add Unit</span></a></li>
                        <li class="one_fifth"><a href="master_add_table.php"><img src="../img/gemicon/reports.png" alt="" /><span>Add Table</span></a></li>
             			 <li class="one_fifth"><a href="master_pcat.php"><img src="../img/gemicon/location.png" alt="" ><span>Menu Heading</span></a></li>
                         <li class="one_fifth"><a href="master_product.php"><img src="../img/gemicon/edit.png" ><span>Menu Item</span></a></li>
                        <li class="one_fifth"><a href="in-entry.php"><img src="../img/gemicon/image.png"><span>Bill-Entry</span></a></li>
                        <li class="one_fifth"><a href="expanse.php"><img src="../img/gemicon/edit.png" ><span>Expanse Entry</span></a></li>
                        <li class="one_fifth"><a href="company_setting.php"><img src="../img/gemicon/image.png"><span>Company Setting</span></a></li>
                        <li class="one_fifth"><a href="changepassword.php"><img src="../img/gemicon/settings.png" alt=""><span>Change Password</span></a></li>
                        </ul>
                        <!--widgetcontent-->
                        
                        
                    </div><!--span8-->
                    
                    
                    
                    <!--span4-->
                </div>
                
                <div class="row-fluid" style="display:none">
                	<div class="span12">
                    	<ul class="widgeticons row-fluid">
                        	  <li class="one_fifth"><a href="master_unit.php"><img src="../img/gemicon/location.png" alt="" /><span>Add Unit</span></a></li>
                        <li class="one_fifth"><a href="master_add_table.php"><img src="../img/gemicon/reports.png" alt="" /><span>Add Table</span></a></li>
             			 <li class="one_fifth"><a href="master_pcat.php"><img src="../img/gemicon/location.png" alt="" ><span>Menu Heading</span></a></li>
                         <li class="one_fifth"><a href="master_product.php"><img src="../img/gemicon/edit.png" ><span>Menu Item</span></a></li>
                        <li class="one_fifth"><a href="in-entry.php"><img src="../img/gemicon/image.png"><span>Bill-Entry</span></a></li>
                        <li class="one_fifth"><a href="expanse.php"><img src="../img/gemicon/edit.png" ><span>Expanse Entry</span></a></li>
                        <li class="one_fifth"><a href="company_setting.php"><img src="../img/gemicon/image.png"><span>Company Setting</span></a></li>
                        <li class="one_fifth"><a href="changepassword.php"><img src="../img/gemicon/settings.png" alt=""><span>Change Password</span></a></li>
                        </ul>
                        
                        <br />
                        
                        
                        <!--widgetcontent-->
                        
                        
                        <!--widgetcontent-->
                        
                        
                    </div><!--span8-->
                    <!--span4-->
                </div>
                
                <div class="row-fluid">
                	<div class="span12">
                    	<ul class="widgeticons row-fluid">
                        	  <li class="one_fifth"><a href="master_unit.php"><img src="../img/gemicon/location.png" alt="" /><span>Add Unit</span></a></li>
                        <li class="one_fifth"><a href="master_add_table.php"><img src="../img/gemicon/reports.png" alt="" /><span>Add Table</span></a></li>
             			<li class="one_fifth"><a href="master_pcat.php"><img src="../img/gemicon/location.png" alt="" ><span>Menu Heading</span></a></li>
                        <li class="one_fifth"><a href="master_product.php"><img src="../img/gemicon/edit.png" ><span>Menu Item</span></a></li>
                        <?php $firsttableid = $cmn->getvalfield($connection,"m_table","table_id","1=1 order by table_id limit 0,1"); ?>
                        <li class="one_fifth"><a href="in-entry.php?table_id=<?php echo $firsttableid; ?>"><img src="../img/gemicon/image.png"><span>Bill-Entry</span></a></li>
                        <li class="one_fifth"><a href="expanse.php"><img src="../img/gemicon/edit.png" ><span>Expanse Entry</span></a></li>
                        <li class="one_fifth"><a href="company_setting.php"><img src="../img/gemicon/image.png"><span>Company Setting</span></a></li>
                        <li class="one_fifth"><a href="changepassword.php"><img src="../img/gemicon/settings.png" alt=""><span>Change Password</span></a></li>
                        </ul>
                        
                        <br />
                        
                        
                        <!--widgetcontent-->
                        
                        
                        <!--widgetcontent-->
                        
                        
                    </div><!--span8-->
                    <!--span4-->
                </div><!--row-fluid-->
            </div><!--contentinner-->
        </div><!--maincontent-->
        
    </div>
    <!--mainright-->
    <!-- END OF RIGHT PANEL -->
    
    <div class="clearfix"></div>
     <?php include("inc/footer.php"); ?>
    <!--footer-->

    
</div><!--mainwrapper-->
<script type="text/javascript">
jQuery(document).ready(function(){
								
		// basic chart
		var flash = [[0, 2], [1, 6], [2,3], [3, 8], [4, 5], [5, 13], [6, 8]];
		var html5 = [[0, 5], [1, 4], [2,4], [3, 1], [4, 9], [5, 10], [6, 13]];
			
		function showTooltip(x, y, contents) {
			jQuery('<div id="tooltip" class="tooltipflot">' + contents + '</div>').css( {
				position: 'absolute',
				display: 'none',
				top: y + 5,
				left: x + 5
			}).appendTo("body").fadeIn(200);
		}
	
			
		var plot = jQuery.plot(jQuery("#chartplace2"),
			   [ { data: flash, label: "Flash(x)", color: "#fb6409"}, { data: html5, label: "HTML5(x)", color: "#096afb"} ], {
				   series: {
					   lines: { show: true, fill: true, fillColor: { colors: [ { opacity: 0.05 }, { opacity: 0.15 } ] } },
					   points: { show: true }
				   },
				   legend: { position: 'nw'},
				   grid: { hoverable: true, clickable: true, borderColor: '#ccc', borderWidth: 1, labelMargin: 10 },
				   yaxis: { min: 0, max: 15 }
				 });
		
		var previousPoint = null;
		jQuery("#chartplace2").bind("plothover", function (event, pos, item) {
			jQuery("#x").text(pos.x.toFixed(2));
			jQuery("#y").text(pos.y.toFixed(2));
			
			if(item) {
				if (previousPoint != item.dataIndex) {
					previousPoint = item.dataIndex;
						
					jQuery("#tooltip").remove();
					var x = item.datapoint[0].toFixed(2),
					y = item.datapoint[1].toFixed(2);
						
					showTooltip(item.pageX, item.pageY,
									item.series.label + " of " + x + " = " + y);
				}
			
			} else {
			   jQuery("#tooltip").remove();
			   previousPoint = null;            
			}
		
		});
		
		jQuery("#chartplace2").bind("plotclick", function (event, pos, item) {
			if (item) {
				jQuery("#clickdata").text("You clicked point " + item.dataIndex + " in " + item.series.label + ".");
				plot.highlight(item.series, item.datapoint);
			}
		});


		// bar graph
		var d2 = [];
		for (var i = 0; i <= 10; i += 1)
			d2.push([i, parseInt(Math.random() * 30)]);
			
		var stack = 0, bars = true, lines = false, steps = false;
		jQuery.plot(jQuery("#bargraph2"), [ d2 ], {
			series: {
				stack: stack,
				lines: { show: lines, fill: true, steps: steps },
				bars: { show: bars, barWidth: 0.6 }
			},
			grid: { hoverable: true, clickable: true, borderColor: '#bbb', borderWidth: 1, labelMargin: 10 },
			colors: ["#06c"]
		});
		
		// calendar
		jQuery('#calendar').datepicker();


});
</script>
</body>

</html>

