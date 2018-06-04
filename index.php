<?php
  include "db.php";

  $query="select kode_desa,nama_desa from desae group by nama_desa";

	#menampilkan data dengan JSON
		$stmt=$koneksi->prepare($query);
		$stmt->execute();

//		$hasil=$stmt->fetchAll(PDO::FETCH_ASSOC);

    $array = array();
    $i=0;
    while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
      $array[$i]['kode_desa']=$row['kode_desa'];
      $array[$i]['nama_desa']=$row['nama_desa'];
      $array[$i]['alamat_kantor']=$row['alamat_kantor'];
      $array[$i]['telp_kantor']=$row['telp_kantor'];
      $array[$i]['jumlah_penduduk']=$row['jumlah_penduduk'];

      $nama_desa=$row['nama_desa'];
      $query1="select jabatan,nama,tempat_lahir, jenkel, pendidikan_terakhir, sk_lama, sk_baru, kali_jabat from desae where nama_desa='$nama_desa'";
      $stmt1=$koneksi->prepare($query1);
      $stmt1->execute();
        while($row1=$stmt1->fetch(PDO::FETCH_ASSOC)){
          $array[$i]['staff'][]=$row1;
        }
      $i++;
    }

    #Fungsi utk hilangkan null
    function convert_before_json(&$item, $key){
      $item = utf8_encode($item);
    }

    array_walk_recursive($array, "convert_before_json");

		$json=json_encode($array);
		print_r($json);
?>
