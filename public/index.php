<!DOCTYPE html>
<html lang="en">
<head>
  <title>Search Suggestion</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-primary">
				<div class="panel-heading">Search Suggestion</div>
				<div class="panel-body">
					<form class="form">
						<div class="form-group">
							<input class="form-control" name="q" placeholder="Kata Kunci...">
						</div>
						<div class="form-group">
							<button class="btn btn-primary">Cari</button>
						</div>
					</form>
					<ul class="list-group">
					<?php
					if(isset($_GET['q'])){
						function suggest(){
							$query = $_GET['q'];
							$url = 'https://clients1.google.co.id/complete/search?hl=id&output=toolbar&q='.$query;
							$xml = simplexml_load_file($url) or die("feed not loading");
							$data = [];
							$str_data = '';
							$str = '';
							$suggests = $xml->CompleteSuggestion;
							foreach ($suggests as $suggest) {
								$str_data .= "<li class='list-group-item'>".$suggest->suggestion['data']."</li>";
								echo "<li class='list-group-item'>".$suggest->suggestion['data']."</li>";
								array_push($data, $str.$suggest->suggestion['data']);
								foreach($suggest->suggestion->attributes() as $attribute){
								}
							}
							$results = array('results' => $data );
						}
						suggest();
					}
					?>
					</ul>
				</div>
			</div>
			</div>
		</div>
	</div>
</body>
</html>