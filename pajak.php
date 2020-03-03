<!DOCTYPE html>
<html>
<body>

<?php

$gajiPerBulan = $_POST["gaji"];
$iuranPensiun = $_POST["iuran"];
$penghasilanBruto = $gajiPerBulan;
$biayaJabatan = $penghasilanBruto * 0.05;
$biayaJabatanMaksimal = 500000;
$ptkpBasis = 54000000;
$statusMenikah = $_POST["nikah"];
$statusBelumMenikah = $_POST["belumnikah"];
$statusWajibPajak;
$ptkpFinal;
$kelipatanPTKP = 4500000;
$penghasilanNetoSebulan;
$penghasilanNetoSetahun;
$penghasilanKenaPajak;
$pajakTerutang;
$pajakTerutangSebulan;

function biayaJabatan(){
    global $gajiPerBulan, $iuranPensiun, $penghasilanBruto, $biayaJabatan, $biayaJabatanMaksimal;
    if($biayaJabatan <= 500000){
        return $biayaJabatan;
    }else{
        return $biayaJabatanMaksimal;
    }
}

function penghasilanTidakKenaPajak(){
    global $ptkpBasis, $kelipatanPTKP, $statusWajibPajak, $status, $ptkpFinal;
    if($statusWajibPajak == $_POST["nikah"]){
        $ptkpFinal = $ptkpBasis + $kelipatanPTKP;
        return $ptkpFinal;
    }else if($statusWajibPajak == $_POST["belumnikah"]){
        $ptkpFinal = $ptkpBasis;
        return $ptkpFinal;
    }
}

function penghasilanNetoSebulan(){
    global $gajiPerBulan, $iuranPensiun, $penghasilanBruto, $biayaJabatan, $biayaJabatanMaksimal,
     $penghasilanNetoSebulan;
        $penghasilanNetoSebulan = $penghasilanBruto - biayaJabatan() - $iuranPensiun;
    return $penghasilanNetoSebulan;
    
}

function penghasilanNetoSetahun(){
    global $gajiPerBulan, $iuranPensiun, $penghasilanBruto, $biayaJabatan, $biayaJabatanMaksimal,
     $penghasilanNetoSebulan,$penghasilanNetoSetahun;
        $penghasilanNetoSetahun = penghasilanNetoSebulan() * 12;
     return $penghasilanNetoSetahun; 
}

function penghasilanKenaPajak() {
    global $gajiPerBulan, $iuranPensiun, $penghasilanBruto, $biayaJabatan, $biayaJabatanMaksimal,
     $penghasilanNetoSebulan,$penghasilanNetoSetahun, $penghasilanKenaPajak;
        $penghasilanKenaPajak = penghasilanNetoSetahun() - penghasilanTidakKenaPajak();
        return $penghasilanKenaPajak;
}

function pajakTerutang(){
    global $gajiPerBulan, $iuranPensiun, $penghasilanBruto, $biayaJabatan, $biayaJabatanMaksimal,
     $penghasilanNetoSebulan,$penghasilanNetoSetahun, $penghasilanKenaPajak, $pajakTerutang;
    $tarif = array

    (
        array(50000000,0.05),
        array(200000000,0.15),
        array(250000000,0.25),
        array(500000000,0.3)
    );   
    if(penghasilanKenaPajak() <= $tarif[0][0]){
        $pajakTerutang = penghasilanKenaPajak() * $tarif[0][1];
        return $pajakTerutang;
    } else if(penghasilanKenaPajak() <= $tarif[2][0]){
        $x = $tarif[0][0] * $tarif [0][1];
        $y = penghasilanKenaPajak() - $tarif[0][0];
        $xy = $y * $tarif[1][1];
        $pajakTerutang = $x + $xy;
        return $pajakTerutang;
    } else if(penghasilanKenaPajak() > $tarif[2][0] && penghasilanKenaPajak() <= 500000000){
        $a = $tarif[0][0] * $tarif[0][1];
        $b = $tarif[1][0] * $tarif[1][1];
        $c = penghasilanKenaPajak() - $tarif[0][0] - $tarif[1][0];
        $d = $c * $tarif[2][1];
        $pajakTerutang = $a + $b + $d;
        return $pajakTerutang;
    } else {
        $k = $tarif[0][0] * $tarif[0][1];
        $l = $tarif[1][0] * $tarif[1][1];
        $m = $tarif[2][0] * $tarif[2][1];
        $n = penghasilanKenaPajak() - $tarif[0][0] - $tarif[1][0] - $tarif[2][0];
        $o = $n * $tarif[3][1];
        $pajakTerutang = $k + $l + $m + $o;
        return $pajakTerutang;
    }   
    
}

function pajakTerutangSebulan(){
    global $pajakTerutangSebulan;
    $pajakTerutangSebulan = pajakTerutang() / 12;
    return $pajakTerutangSebulan;
}


echo "PPh Pasal 21 Bulan Januari Rp.".pajakTerutangSebulan();

?>

</body>
</html>