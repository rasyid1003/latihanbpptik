<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Faris Rasyid</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5
	.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
  <div class="container">
		<h1 class="text-center">Faris Rasyid</h1>
		<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="card">
					<div class="card-header bg-primary text-white text-center">Pendaftaran Rute Penerbangan</div>
					<div class="card-body">
	
        	
        <div class="form-group">
				<label for="nama">Nama Maskapai:</label>
				<input type="text" class="form-control" id="nama" name="nama">
			</div>
			<div class="form-group">
				<label for="nomor">Nomor Pelanggan:</label>
				<input type="text" class="form-control" id="nomor" name="nomor">
			</div>
			<div class="form-group">
				<label for="asal">Bandara Asal:</label>
				<select class="form-control" id="asal" name="asal">
					<option value="CGK">Soekarno-Hatta (CGK)</option>
					<option value="BDO">Husein Sastranegara (BDO)</option>
					<option value="MLG">Abdul Rachman Saleh (MLG)</option>
					<option value="SUB">Juanda (SUB) </option>
				</select>
				</div>
				<div class="form-group">
				<label for="tujuan">Bandara Tujuan:</label>
				<select class="form-control" id="tujuan" name="tujuan">
					<option value="DPS">Ngurah Rai (DPS) </option>
					<option value="UPG">Hasanuddin (UPG)</option>
					<option value="INX">Inanwatan (INX)</option>
					<option value="BTJ">Sultan Iskandarmuda (BTJ)</option>
				</select>
				</div>
			
			<div class="form-group">
				<label for="tiket">Harga tiket:</label>
				<input type="text" class="form-control" id="tiket" name="tiket">
			</div>
			<button type="submit" class="btn btn-success">Submit</button>
		</form>
	</div>

	<?php 
	if ($_SERVER["REQUEST_METHOD"] ==  "POST"){
		$nama = $_POST["nama"];
		$nomor = $_POST["nomor"];
		$asal = $_POST["asal"];
		$tujuan = $_POST["tujuan"];
		$tiket = $_POST["tiket"];

		$tarif_tujuan = array(
			"DPS" => 80000,
			"UPG" => 70000,
			"INX" => 90000,
			"BTJ" => 70000
		);

		$tarif_asal = array(
			"CGK" => 50000,
			"BDO" => 70000,
			"MLG" => 90000,
			"SUB" => 70000
		);
		$hargatiket = $tarif_tujuan[$tujuan] + $tarif_asal[$asal];
		
		// Menghitung total harga
		$total_harga = $hargatiket * $tiket;


		$data = array(
			"nama" => $nama,		
			"nomor" => $nomor,
			"asal" => $asal,
			"tujuan" => $tujuan,
			"tarif_tujuan" => $tarif_tujuan[$tujuan],
			"total_tagihan" => $total_harga
		);
		
		$json_file = "data.json";
		$current_data = file_get_contents($json_file);
		$array_data = json_decode($current_data, true);
		$array_data[] = $data;
		$final_data = json_encode($array_data, JSON_PRETTY_PRINT);
		file_put_contents($json_file, $final_data);
		 
		echo "<div class='container'>";
		echo "<h2>Tagihan Pelanggan</h2>";
		echo "<table class='table'>";
		echo "<tr><td>Nama Pelanggan:</td><td>$nama</td></tr>";
		echo "<tr><td>Nomor Pelanggan:</td><td>$nomor</td></tr>";
		echo "<tr><td>Asal Tujuan:</td><td>$asal</td></tr>";
		echo "<tr><td>Tujuan:</td><td>$tujuan</td></tr>";
		echo "<tr><td>Harga Tiket:</td><td>$tiket</td></tr>";
		echo "<tr><td>Pajak:</td><td>$hargatiket</td></tr>";
		echo "<tr><td>Harga Tiket:</td><td>$total_harga</td></tr>";
		echo "</table>";
		echo "</div>";
	}
	?>
	
    

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>    
