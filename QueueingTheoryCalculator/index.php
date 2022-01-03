<?php

if (isset($_POST['hitung'])) {
    $jmlDatang = $_POST['jmlDatang'];
    $jmlDilayani = $_POST['jmlDilayani'];
    $jmlTeller = $_POST['jmlTeller'];

    //PERHITUNGAN P
    $p = $jmlDatang / ($jmlTeller * $jmlDilayani);

    // PERHITUNGAN P0
    $hasil1 = 0;
    $bagi2 = 1;
    for ($i = 0; $i < $jmlTeller; $i++) {
        if ($i <= 0) {
            $a = 1;
        } else {
            for ($j = 0; $j < $i; $j++) {
                $bagi1 = $jmlDatang / $jmlDilayani;
                $bagi2 = $bagi2 * $bagi1;
            }

            $a = (1 / $i) * $bagi2;
            $bagi2 = 1;
        }

        $hasil1 = $hasil1 + $a;
    }

    $jmlbagi2 = 1;
    for ($i = 0; $i < $jmlTeller; $i++) {
        $jmlbagi1 = $jmlDatang / $jmlDilayani;
        $jmlbagi2 = $jmlbagi2 * $jmlbagi1;
    };

    $pnol = 1 / ($hasil1 + (1 / $jmlTeller) * $jmlbagi2 * ($jmlTeller * $jmlDilayani) / (($jmlTeller * $jmlDilayani) - $jmlDatang));

    //PERHITUNGAN Ls
    $jum = 1;
    $jmlT = $jmlTeller;
    for ($i = 0; $i < $jmlT && $jmlTeller > 0; $i++) {
        $jmlT--;
        $jum = $jum * $jmlT;
    }
    $Ls = ((($jmlDatang * $jmlDilayani * $jmlbagi2) / ($jum * ($jmlTeller * $jmlDilayani - $jmlDatang) * ($jmlTeller * $jmlDilayani - $jmlDatang))) * $pnol) + ($jmlDatang / $jmlDilayani);

    //PERHITUNGAN Lq
    $Lq = $Ls - ($jmlDatang / $jmlDilayani);

    //PERHITUNGAN 1/µ
    $µ = 1 / $jmlDilayani;

    //PERHITUNGAN Ws
    $ws = $Ls / $jmlDatang; //dalam Jam
    $wsm = ($Ls / $jmlDatang) * 60; //dalam menit

    //Perhitungan Wq
    $wq = $Lq / $jmlDatang;
    $wqm = ($Lq / $jmlDatang) * 60; //dalam menit
};

?>


<!DOCTYPE html>
<html lang="en">
<style>
    #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #customers td,
    #customers th {
        border: 1px solid #ddd;
        padding: 8px;
        width: 10px;


    }

    #customers tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #customers tr:hover {
        background-color: #ddd;
    }

    #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #04AA6D;
        color: white;

    }
</style>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Metode Antrian</title>
</head>

<body>
    <div class="kotak">
        <h1>Kalkulator Metode Antrian</h1>
        <form method="post" action="index.php">
            <table>
                <tr>
                    <td>Intensitas Kedatangan Pelanggan &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; (λ)</td>
                    <td>:</td>
                    <td><input class="form" type="text" name="jmlDatang" required></td>
                </tr>
                <tr>
                    <td>Tingkat Pelayanan rata-rata &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; (µ) </td>
                    <td>:</td>
                    <td><input class="form" type="text" name="jmlDilayani" required></td>
                </tr>
                <tr>
                    <td>Jumlah channel pelayanan &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; (M)</td>
                    <td>:</td>
                    <td><input class="form" type="text" name="jmlTeller" required></td>
                </tr>
                <td> <br /> <br />
                    <input type="submit" class="tombol_submit" name="hitung" value="Hitung">
                    <br /> <br />
                    <input type="reset" class="tombol_reset" name="reset" value="Reset">
                </td>
            </table>
        </form>
    </div>
    <div class="kotak">
        <h3>Hasil :</h3>
        <table id="customers">
            <tr>
                <th>Tingkat kegunaan fasilitas pelayanan (P)</th>
                <td>:</td>
            </tr>
            <tr>
                <?php if (isset($_POST['hitung'])) { ?>
                    <td><input type="text" name="intLayanan" value="<?php echo $p; ?>"></td>
                <?php } ?>
            </tr>
            <tr>
                <th> Probabilitas tidak ada individu dalam sistem (P0)</th>
                <td>:</td>
            </tr>
            <tr>
                <?php if (isset($_POST['hitung'])) { ?>
                    <td><input type="text" name="intLayanan" value="<?php echo $pnol; ?>"></td>
                <?php } ?>
            </tr>
            <tr>
                <th>Menghitung jumlah rata-rata nasabah dalam sistem (Ls)</th>
                <td>:</td>
            </tr>
            <tr>
                <?php if (isset($_POST['hitung'])) { ?>
                    <td><input type="text" name="intLayanan" value="<?php echo $Ls; ?>"></td>
                <?php } ?>
            </tr>
            <tr>
                <th>Menghitung jumlah rata-rata nasabah dalam antrian (Lq)</th>
                <td>:</td>
            </tr>
            <tr>
                <?php if (isset($_POST['hitung'])) { ?>
                    <td><input type="text" name="intLayanan" value="<?php echo $Lq; ?>"></td>
                <?php } ?>
            </tr>
            <tr>
                <th> Waktu pelayanan rata-rata (1/µ)</th>
                <td>:</td>
            </tr>
            <tr>
                <?php if (isset($_POST['hitung'])) { ?>
                    <td><input type="text" name="intLayanan" value="<?php echo $µ; ?>"></td>
                <?php } ?>
            </tr>
            <tr>
                <th>Menghitung jumlah rata-rata waktu tunggu nasabah dalam sistem (Ws)</th>
                <td>:</td>
            </tr>
            <tr>
                <?php if (isset($_POST['hitung'])) { ?>
                    <td><input type="text" name="intLayanan" value="<?php echo $ws; ?>"></td>
                    <td>
                        <p>jam</p>
                    </td>
                    <td><input type="text" name="intLayanan" value="<?php echo $wsm; ?>"></td>
                    <td>
                        <p>menit</p>
                    </td>
                <?php } ?>
            </tr>
            <tr>
                <th>Menghitung jumlah rata-rata waktu tunggu nasabah dalam antrian (Wq)</th>
                <td>:</td>
                <?php if (isset($_POST['hitung'])) { ?>
                    <td><input type="text" name="intLayanan" value="<?php echo $wq; ?>"></td>
                    <td>
                        <p>jam</p>
                    </td>
                    <td><input type="text" name="intLayanan" value="<?php echo $wqm; ?>"></td>
                    <td>
                        <p>menit</p>
                    </td>
                <?php } ?>
            </tr>
        </table>
    </div>
</body>

</html>