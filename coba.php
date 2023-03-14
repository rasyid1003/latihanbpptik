<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST">
        <label>Nama Pembeli:</label>
        <input type="text" name="nama_pembeli"><br>
    
        <label>Nama Buah:   </label>
        <select name="nama_buah">
            <option value="Durian">Durian</option>
            <option value="Mangga">Mangga</option>
            <option value="Rambutan">Rambutan</option>
            <option value="Kelengkeng">Kelengkeng</option>
            <option value="Apel">Apel</option>
        </select><br>
    
        <label>Jumlah Beli: </label>
        <input type="number" name="jumlah_beli"><br>
    
        <input type="submit" value="Submit">
    </form>
    <br><br>
    <table style="width:100%" border="1">
      <tr>
        <th>Durian</th>
        <th>Mangga</th>
        <th>Rambutan</th>
        <th>Kelengkeng</th>
        <th>Apel</th>
      </tr>
      <tr>
        <td>20000</td>
        <td>15000</td>
        <td>10000</td>
        <td>25000</td>
        <td>30000</td>
      </tr>
    </table>
</body>
</html>
<br><br><br><br><br>
<?php
// Tampilkan data dari file JSON
$file_json = 'data/data.json';
$data_json = file_get_contents($file_json);
$data_array = json_decode($data_json, true);

// Tampilkan data dalam bentuk tabel
if (!empty($data_array)) {
    echo '<table style="width:100%" border="1">';
    echo '<tr>
            <th>Nama Pembeli</th>
            <th>Nama Buah</th>
            <th>Jumlah Beli</th>
            <th>Harga Buah</th>
            <th>Total Pembayaran</th>
            </tr>';
    foreach ($data_array as $data) {
        echo '<tr>';
        echo '<td>'.$data['nama_pembeli'].'</td>';
        echo '<td>'.$data['nama_buah'].'</td>';
        echo '<td>'.$data['jumlah_beli'].'</td>';
        echo '<td>Rp. '.$data['harga_buah'].'</td>';
        echo '<td>Rp '.$data['total_pembayaran'].'</td>';
        echo '</tr>';
    }

    echo '</table>';
}
?>
<?php
// Fungsi untuk menghitung total pembayaran
function hitungTotal($harga, $jumlah) {
    return $harga * $jumlah;
}

// Array untuk memilih nama buah dan harganya
$daftar_buah = array(
    'Durian' => 20000,
    'Mangga' => 15000,
    'Rambutan' => 10000,
    'Kelengkeng' => 25000,
    'Apel' => 30000
);

// Jika pengguna mengirimkan form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_pembeli = $_POST['nama_pembeli'];
    $nama_buah = $_POST['nama_buah'];
    $jumlah_beli = $_POST['jumlah_beli'];
    $harga_buah = $daftar_buah[$nama_buah];
    $total_pembayaran = hitungTotal($harga_buah, $jumlah_beli);

    // Data yang akan disimpan ke dalam file JSON
    $data = array(
        'nama_pembeli' => $nama_pembeli,
        'nama_buah' => $nama_buah,
        'jumlah_beli' => $jumlah_beli,
        'harga_buah' => $harga_buah,
        'total_pembayaran' => $total_pembayaran
    );

    // Baca data dari file JSON
    $file_json = 'data/data.json';
    $data_json = file_get_contents($file_json);
    $data_array = json_decode($data_json, true);

    // Tambahkan data baru ke dalam array
    $data_array[] = $data;

    // Simpan data ke dalam file JSON
    $data_json = json_encode($data_array, JSON_PRETTY_PRINT);
    file_put_contents($file_json, $data_json);
}
?>




