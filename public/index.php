<!DOCTYPE html>
<html lang="en">
<head>
  <title>Search Suggestion</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="clipboard.js-master/dist/clipboard.min.js"></script>

</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-2">
			<div class="panel panel-primary">
				<div class="panel-heading">Search Suggestion</div>
				<div class="panel-body">
					<form class="form">
						<div class="form-group">
							<input class="form-control" name="q" placeholder="Kata Kunci...">
						</div>
						<div class="form-group">
							<button class="btn btn-primary">Cari</button>
							<button class="btn copy" data-clipboard-target="#foo">Copy All</button>
						</div>
					</form>

					<ul class="list-group" id="foo">
					<?php
						function suggest($q,$add){
							$query = $q.$add;
							$url = 'https://clients1.google.co.id/complete/search?hl=id&output=toolbar&q='.$query;
							$xml = simplexml_load_file($url);
							$jum = 0;
							$arr_data = [];
							$str_data = '';
							if(!is_null($xml)){
								$suggests = $xml->CompleteSuggestion;
								foreach ($suggests as $suggest) {
									$str_data .= "".$suggest->suggestion['data']."<br>";
									$jum++;
								}
							}
							$arr_data[0] = $str_data;
							$arr_data[1] = $jum;
							return $arr_data;
						}
					$jum =0;
					if(isset($_GET['q'])){
						$str_alfa = ' abcdefghijklmnopqrstuvwxyz0987654321';
						$arr_alfa = [];
						$data = [];
						for($i=0;$i<strlen($str_alfa);$i++){
							$arr_alfa[$i] = substr($str_alfa, $i,1);
						}
						foreach($arr_alfa as $al){
							array_push($data,suggest($_GET['q'],' '.$al));
							echo "<h3>".$al."</h3>";
							$arr_data = suggest($_GET['q'],' '.$al);
							echo $arr_data[0];
							$jum += $arr_data[1];
						}
					}
					?>
					</ul>
				</div>
			</div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-primary">
					<div class="panel-heading">Jumlah Keyword Suggestion</div>
					<div class="panel-body">
						<?php
							echo "<h1>".$jum."</h1>";
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
  		new Clipboard('.copy');
  	</script>
</body>
</html>