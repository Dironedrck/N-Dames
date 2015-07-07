<!DOCTYPE html>
<?php include ('dames.class.php'); ?>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <meta charset="utf-8">
        <title>N Dames</title>
		<link href="style.css" rel="stylesheet">

	</head>
	
	<body>
	<?php
		$n = isset($_GET['n']) ? $_GET['n'] : 3;
		$startX = 0;
		$startY = isset($_GET['y']) ? $_GET['y'] : 0;
		$start = array('x'=>$startX, 'y'=>$startY);
		$d = new NDames($n, $start);
		$dames = $d->run();
		//echo'<pre>'; print_r($dames); echo'</pre>';
	?>
	
	<?php if($dames){ $d = 0; ?>

		<table id="chess_board" cellpadding="0" cellspacing="0">
			<?php for($i=0 ; $i<$n ; $i++){ ?>
			<tr>
				<?php for($j=0 ; $j<$n ; $j++){ ?>
					<td>
						<?php if(isset($dames[$d]) && $dames[$d]['x'] == $i && $dames[$d]['y'] == $j){ ?>
							<a href="#" class="king black">&#9819;</a>
						<?php $d++; } ?>
					</td>
				<?php } ?>
			</tr>
			<?php } ?>
		</table>

	<?php } ?>

<!-- 
&#9812; = ?
&#9813; = ?
&#9814; = ?
&#9815; = ?
&#9816; = ?
 = ?
&#9818; = ?
&#9819; = ?
&#9820; = ?
&#9821; = ?
&#9822; = ?
 = ?
-->
		
	</body>
</html>