<!DOCTYPE html>
<html>
<head>
    <title>Perhitungan PPh pasal 21 </title>
    </head>
<body>
    <form action="pajak.php" method="post">
        Hitung:
        <br>
        Gaji Bulanan= <input type="text" name="gaji"> 
        <br> 
        Iuran Pensiun = <input type="text" name="iuran"> 
        <br>
        <label for="status">Status(Menikah/Belum Menikah)= </label> 
        <input name ="status" type="radio" value="nikah"> Menikah
        <input name ="status" type="radio" value="belumnikah">Belum Menikah
        <br>
        <button type="submit" name="submit">Lihat</button> 
    </form>
</body>
</html>