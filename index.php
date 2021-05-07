//Thanks For Fajarullah & Riksa Suviana Rochman
<?php

$con = mysqli_connect('localhost', 'root', '', 'spk');

$bobot = array(0.5, 0.3, 0.2);

//Buat fungsi tampilkan nama
function getName($id) {
   $con = $GLOBALS['con'];
   $q = mysqli_query($con, "SELECT * FROM tbcalon where idCalon = '$id'");
   $d = mysqli_fetch_array($q);
   return $d['nama'];
}

$sql = mysqli_query($con, "SELECT * FROM tbmatrik");

//Buat tabel untuk menampilkan hasil
echo "<H3>Matrik Awal</H3>
<table width=500 style='border:1px; #ddd; solid; border-collapse:collapse' border=1>
<tr>
<td>No</td>
<td>Nama</td>
<td>Pendapatan ORTU</td>
<td>IPK Semester</td>
<td>Jumlah Saudara yang masih sekolah</td>
<td>jumlah poin</td>
</tr>
";
$no = 1;
while ($dt = mysqli_fetch_assoc($sql)) {
$jumlah= ($dt['Kriteria1'])+($dt['Kriteria2'])+($dt['Kriteria3']);
echo "<tr>
<td>$no</td>
<td>".getName($dt['idCalon'])."</td>
<td>$dt[Kriteria1]</td>
<td>$dt[Kriteria2]</td>
<td>$dt[Kriteria3]</td>
<td>$jumlah</td>
</tr>";
$no++;
}
echo "</table>";

 //Lakukan Normalisasi dengan rumus pada langkah 2
 //Cari Max atau min dari tiap kolom Matrik
 $crMax = mysqli_query($con, "SELECT 
      min(Kriteria1) as minK1, 
      max(Kriteria2) as maxK2,
      max(Kriteria3) as maxK3
   FROM tbmatrik");
 $weight = mysqli_fetch_assoc($crMax);

 //Hitung Normalisasi tiap Elemen
 $sql2 = mysqli_query($con, "SELECT * FROM tbmatrik");
 //Buat tabel untuk menampilkan hasil
 echo "<H3>Matrik Normalisasi</H3>
 <table width=500 style='border:1px; #ddd; solid; border-collapse:collapse' border=1>
  <tr>
   <td>No</td>
   <td>Nama</td>
   <td>Pendapatan ORTU</td>
   <td>IPK Semester</td>
   <td>Jumlah Saudara yang masih sekolah</td>
  </tr>
  ";
 $no = 1;
 $normalizedWeight = [];
 while ($dt2 = mysqli_fetch_array($sql2)) {
   $normalized = [
      round($weight['minK1']/$dt2['Kriteria1'], 2),
      round($dt2['Kriteria2']/$weight['maxK2'], 2),
      round($dt2['Kriteria3']/$weight['maxK3'], 2)
   ];
   $normalizedWeight[$dt2['idCalon']] = $normalized;
   echo "<tr>
      <td>$no</td>
      <td>".getName($dt2['idCalon'])."</td>
      <td>".$normalized[0]."</td>
      <td>".$normalized[1]."</td>
      <td>".$normalized[2]."</td>
   </tr>";
   $no++;
 }
 echo "</table>";

 //Proses perangkingan dengan rumus langkah 3
 $sql3 = mysqli_query($con, "SELECT * FROM tbmatrik");
 //Buat tabel untuk menampilkan hasil
 echo "<H3>Perangkingan</H3>
 <table width=500 style='border:1px; #ddd; solid; border-collapse:collapse' border=1>
  <tr>
   <td>no</td>
   <td>Nama</td>
   <td>total poin</td>
   <td>SAW</td>
   <td>ket</td>
  </tr>
  ";

//Kita gunakan rumus (Normalisasi x bobot)
 while ($dt3 = mysqli_fetch_array($sql3)) {
   $jumlah = $dt3['Kriteria1'] + $dt3['Kriteria2'] + $dt3['Kriteria3'];
   $normalized = $normalizedWeight[$dt3['idCalon']];
   $poin = round(
      ($normalized[0]*$bobot[0])+
      ($normalized[1]*$bobot[1])+
      ($normalized[2]*$bobot[2]),
      2
   );


   $data[] = array(
      'nama'=> getName($dt3['idCalon']),
      'jumlah'=> $jumlah,
      'poin'=> $poin
   );
}

//mengurutkan data
foreach ($data as $key => $isi) {
   $nama[$key]=$isi['nama'];
   $jlh[$key]=$isi['jumlah'];
   $poin1[$key]=$isi['poin'];
}
array_multisort($poin1,SORT_DESC,$jlh,SORT_DESC,$data);
$no=1;
$h="juara";
$juara=1;
$hr=1;

foreach ($data as $item) { ?>
<tr>
   <td><?php echo $no ?></td>
   <td><?php echo$item['nama'] ?></td>
   <td><?php echo$item['jumlah'] ?></td>
   <td><?php echo$item['poin'] ?></td>
   <td><?php echo"$h $juara" ?></td>
</tr>

<?php
   $no++;

   if ($no>=4) {
      $h="  ";
      $juara=" ";
   } else {
      $juara++;
   }
}
echo "</table>";

?>