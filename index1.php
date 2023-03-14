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
					<option value="A">Soekarno-Hatta (CGK)</option>
					<option value="B">Husein Sastranegara (BDO)</option>
					<option value="C">Abdul Rachman Saleh (MLG)</option>
					<option value="D">Juanda (SUB) </option>
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
				<label for="pemakaian">Harga tiket:</label>
				<input type="text" class="form-control" id="pemakaian" name="pemakaian">
			</div>
			<button type="submit" class="btn btn-success">Submit</button>
		</form>
	</div>

	<?php
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
		$nama = $_POST["nama"];
		$nomor = $_POST["nomor"];
		$lokasi = $_POST["lokasi"];
		$asal = $_POST["asal"];
		$pemakaian = $_POST["pemakaian"];

		
		$tarif_tujuan = array(
			"DPS" => 1500,
			"UPG" => 2000,
			"INX" => 2500,
			"BTJ" => 3000
		);

		
		$tarif_pemakaian = $tarif_tujuan[$asal] * $pemakaian;
		$total_tagihan = $tarif_pemakaian + 1195 + 3000 + 4400;

	
		$data = array(
			"nama" => $nama,		"nomor" => $nomor,
            
            "asal" => $asal,
            "pemakaian" => $pemakaian,
            "tarif_pemakaian" => $tarif_pemakaian,
            "total_tagihan" => $total_tagihan
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
        echo "<tr><td>Lokasi:</td><td>$lokasi</td></tr>";
        echo "<tr><td>asal Pemakaian:</td><td>$asal</td></tr>";
        echo "<tr><td>Pemakaian:</td><td>$pemakaian</td></tr>";
        echo "<tr><td>Tarif Pemakaian:</td><td>$tarif_pemakaian</td></tr>";
        echo "<tr><td>Total Tagihan:</td><td>$total_tagihan</td></tr>";
        echo "</table>";
        echo "</div>";
    }
    ?>
    

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>    
