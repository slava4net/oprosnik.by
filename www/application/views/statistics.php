<?php
//var_dump($data['surveys'][0]);
// $survey = array("id" => 1,
						// "question" => "Question by test for this survey",
						// "answers" => array("Answer 1" => "10", 
													// "Answer 2" => "110", 
													// "Answer 3" => "120", 
													// "Answer 4" => "0", 
													// "Answer 5" => "15", 
													// "Answer 6" => "103", 
													// "Answer 7" => "55"

						// )
// );

// $color = array('#FF0F00', '#FF6600','#FF9E01','#FCD202','#F8FF01','#B0DE09','#B0DE10','#B0DE11','#B0DE12','#FF6600','#FF9E01','#FCD202','#B0DE09','#FF0F00','#F8FF01', );

// if(isset($survey['answers']) AND count($survey['answers']) != 0){
	// $i = 0;
	// foreach($survey['answers'] as $question => $count){
		// $dataj .= '
		// {
			 // "answer": "'.$question.'",
			 // "count": '.$count.',
			 // "color": "'.$color[$i].'"
		 // },';
		// $i++;
	// }
// }
?>
<!DOCTYPE html> 
<html>
	<head>
	<title>STATISTICS</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script language="javascript" type="text/javascript" src="../../js/jquery-1.7.1.min.js"></script>
	<script language="javascript" type="text/javascript" src="../../js/jquery.colorPicker.js"/></script>
	<script language="javascript" type="text/javascript" src="../../js/js.js"/></script>
	
	<!----------------------------------- graphics -->
	
	<script src="../../js/amcharts/amcharts.js" type="text/javascript"></script> 
	<script src="../../js/amcharts/serial.js" type="text/javascript"></script> 
	<script src="../../js/amcharts/pie.js"></script>
	<link rel="stylesheet" href="../../js/amcharts/style.css" type="text/css">
	
	<!----------------------------------- graphics //-->

	<link href="../../css/one.css" type="text/css" rel="stylesheet" title="style" media="all" />
	<link href="../../css/colorPicker.css" type="text/css" rel="stylesheet" title="style" media="all" />
	</head>
	<body>
		<script type='text/javascript'>
			function del(id){
				window.location.href = '/main/delete?del='+id;
			}
			function edit(id){
				window.location.href = '/create_surv/edit_surv?id='+id;
			}
			function get(id){
				window.location.href="/main?id="+id;
			}
		</script>
		<div class="main">
			<div class="header">
				<!-- <div class="preview"><a href="#">Preview fullsize (1080x1920)</a></div> -->
				<!--<div class="create-new"><a href="#">Create a new surwey</a></div>-->
				<div class="create-new">
				<form action='/create_surv' method='POST'>
					<input type='submit' value='Create a new Survey'>
				</form>
				</div>
				<div class="title">Statistics</div>
				<div class="authorisation"><div class="name"><?php if(isset($_SESSION['user_name'])) echo $_SESSION['user_name'];?></div><a href="/auth/logout">Logout</a><div class="clear"></div></div>
				<div class="clear"></div>
			</div>
			
			<div class="s-left">
				<?php
				if(isset($data['surveys'])){
					echo "<h2>Sureveys:</h2>";
					echo "<div class='menu-list'>";
						if(!empty($data['surveys'])){
							foreach($data['surveys'] as $sur){
								// стили для кнопок по умолчанию, если прячем, указываем display: none
								$draft_style = '';
								$edit_style = '';
								$trash_style = '';
								// если этот опрос сейчас не активен
								if($sur['activeb']=='0'){
									$draft_style = ' style="display: none;"';
									$edit_style = ' style="display: none;"';
									$trash_style = ' style="display: none;"';
									$style='';
								}else{
									$draft_style = ' style="display: none;"';
									$style = 'style="background-color: gray;"';
								}
								// если этот опрос это драфт
								$is_draft = false;
								if($sur['active']=='0'){
									$draft_style = '';
									$edit_style = ' style="display: none;"';
									$trash_style = ' style="display: none;"';
									$func = 'edit('.$sur['id'].');';
								}else{
									$func = 'get('.$sur['id'].')';
								}
								if(!$sur['name']){
									$sur['name'] = '<i>empty surname</i>';
								}
								$add = '<form action="/main/delete" method="POST">
										<input type="hidden" name="id" value="'.$sur['id'].'">
										<div class="all-string active">
											<div class="cpanel">
												<div class="draft"'.$draft_style.' onclick="edit('.$sur['id'].');"></div><div class="edit"'.$edit_style.' onclick="edit('.$sur['id'].');"></div><div class="trash"'.$trash_style.' onclick="del('.$sur['id'].');"></div><div class="clear"></div>
											</div>
											<div class="txt" onclick="'.$func.';" '.$style.'><a href="#">'.$sur['name'].'</a></div><div class="clear"></div>
										</div>
										</form>';
								echo $add;
							}
						}else{
							echo "<h3>У вас нет опросов.</br>Вы можете <a href='create_surv'>создать</a> опрос</h3>";
						}
						echo "</div>";
					}else{
						echo "<h3>У вас пока нет опросов</br>вы можете <a href='/create_surv'>создать опрос</a></h3>";
					}
					?>
			</div>
			<div class="s-right">
				<div class="content">
					<div class="table">
						<?php if(isset($data['answers']) AND count($data['answers']) != 0){
									if(isset($data['quest_text'],$data['answers']) && !empty($data['quest_text'])){
										$quest= trim(strip_tags($data['quest_text']));
									}else{
										$quest = 'Empty name for this question';
									}
									// echo $dataquest_text
									echo '<div class="surwey-name">'.$quest.'</div>
									<table>';
									echo "<tr><td colspan='2'>ANSWER</td><td>QTY</td></tr>";
									$sum=0;
									foreach($data['answers'] as $answ){
										$sum+=$answ['count'];
										echo ('<tr><td class="colorpick"><div style="background-color:'.$answ['color'].';"></div></td><td class="answer">'.strip_tags($answ['answer']).'</td><td>'.$answ['count'].'</td></tr>');
									}
									echo "<tr><td></td><td>TOTAL</td><td>".$sum."</td></tr>";
								}												
								echo "</table>";
					?>
					</div>
<script type="text/javascript">
	var dataj = <?php if($data['survey']) echo $data['survey'];?>;
	if(dataj){
		var pieChart = AmCharts.makeChart("pieChart", {
			"type": "pie",	
			"labelText": "[[percents]]%",
			"theme": "none",
			"radius": 100,
			"labelRadius": 2,
			/*"pieX": 0,*/
			"pieY": 150,
			// "legend": {
				// "markerType": "circle",
				// "position": "left",
				// "marginRight": 0,		
				// "autoMargins": false,
			// },
			"dataProvider": dataj,
			"valueField": "count",
			"startDuration": 0,
			"titleField": "answer",
			"balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
			"colorField": "color",
		});				
					
		var barChart = AmCharts.makeChart("barChart", {
			"type": "serial",
			"theme": "light",
			"pathToImages":"/lib/3/images/",
			"dataProvider": dataj,
			"valueAxes": [{
				"axisAlpha": 0,
				"position": "left",
		//"title": "Cont from answer"
			}],
			"startDuration": 0,
			"graphs": [{
				"balloonText": "<b>[[category]]: [[value]]</b>",
				"labelText": "[[value]]",
				"colorField": "color",
				"fillAlphas": 0.9,
				"lineAlpha": 0.2,
				"type": "column",
				"valueField": "count"
			}],

			"chartCursor": {
				"categoryBalloonEnabled": false,
				"cursorAlpha": 0,
				"zoomable": false
			},
			"categoryField": "answer",		
			"categoryAxis": {
				"gridPosition": "start",
				"labelRotation": 45,
				"labelsEnabled": false,
			},
		});
	}
</script>
					<div id="pieChart" class="pie"></div>
					<!-- hide link by chart-->
					<div class="hide-link"><a href='http://<?php if($_SERVER['SERVER_NAME']) echo $_SERVER['SERVER_NAME'];?>'></a></div>
					<!-- -------------------- -->
					<div id="barChart" class="bar"></div>	
					<form id="export" action="/export/" method="POST">
						<input type="hidden" name="id" value="<?php echo $data['id_sel'];?>">
						<input style="display:none;" type="submit" value="EXPORT">
					</form>
					<a href="#S" class="export-once" onclick="document.getElementById('export').submit()">Export to .xls</a>
					
					<div class="surwey-link"><?php
						if(isset($data['surwey_link'])){
							$link = $data['surwey_link'];
							echo "You link for this survey: <a href='$link'>$link</a>";
						}?>
					</div>
					<div class="clear"></div>
				</div>
			</div>			
			<div class="clear"></div>
		</div>
	</body>
	<!--убираем отображение рекламы на графиках-->
	<script type='text/javascript'>
		// function del_(){
			// if(document.getElementById('barChart').firstChild!=null){
				// document.getElementById('barChart').firstChild.firstChild.lastChild.style.display = 'none';
				// document.getElementById('pieChart').firstChild.firstChild.lastChild.style.display = 'none';
			// }
		// }
		// setTimeout(del_(),1000);
	</script>
</html>