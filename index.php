<?php
try {
    $VeritabaniBaglantisi = new PDO("mysql:host=localhost;dbname=urun;charset=utf8", "root", "9900");
} catch (PDOException $Hata) {
    echo "Bağlantı Hatası<br>" . $Hata->getMessage();
    die();
}

if(isset($_REQUEST["Sayfalama"])){
    $GelenSayfalama = $_REQUEST["Sayfalama"];
}else{
    $GelenSayfalama = 1;
}

$SayfalamaIcinSolVeSagButonSayisi =  2;
$SayfaBasinaGosterilecekKayitSayisi = 5;
$ToplamKayitSayisiSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM urun");
$ToplamKayitSayisiSorgusu->execute();
$ToplamKayitSayisi = $ToplamKayitSayisiSorgusu->rowCount();
$SayfalamayaBaslanacakKayitSayisi = ($GelenSayfalama*$SayfaBasinaGosterilecekKayitSayisi)-$SayfaBasinaGosterilecekKayitSayisi;
$BulunanSayfaSayisi = ceil($ToplamKayitSayisi/$SayfaBasinaGosterilecekKayitSayisi);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .SayfalamaAalnaiKapsayicisi{
            display: block;
            height: auto;
            width: 100%;
            margin: 0;
            padding: 10px 0 10px 0;
            border: none;
            outline: 0;
            text-align: center;
            text-decoration: none;
        }
        .SayfalamaAlaniIcinMetinAlaniKapsayicisi{
            display: block;
            height: auto;
            width: 100%;
            margin: 0;
            padding: 5px 0 5px 0;
            border: none;
            outline: 0;
            text-align: center;
            text-decoration: none;
        }
        .SayfalamaAlaniIcinNumaralandirmaAlaniKapsayicisi{
            display: block;
            height: auto;
            width: 100%;
            margin: 0;
            padding: 5px 0 5px 0;
            border: none;
            outline: 0;
            text-align: center;
            text-decoration: none;
        }
        .Pasif{
            display: inline-block;
            height: 20px;
            width: auto;
            margin: 0;
            padding: 0;
            padding: 5px 7.5px;
            background: #FFFFFF;
            border: none;
            border: 1px solid #DADADA;
            outline: none;
            color: #646464;
            font-size: 14px;
            font-style: normal;
            font-variant: normal;
            font-weight: normal;
            line-height: 20px;
            text-align: center;
            text-decoration: none;
        }

        .Pasif a:link, a:visited , a:hover, a:active{
            text-decoration: none;
            color: #646464;
        }
        .Aktif{
            display: inline-block;
            height: 20px;
            width: auto;
            margin: 0;
            padding: 0;
            padding: 5px 7.5px;
            background: #F6F6F6;
            border: none;
            border: 1px solid #DADADA;
            outline: none;
            color: #646464;
            font-size: 14px;
            font-style: normal;
            font-variant: normal;
            font-weight: bold;
            line-height: 20px;
            text-align: center;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <table width="500" align="center" border="0" cellpadding="0" cellspacing="0">
    <?php
    $UrunSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM urun ORDER BY id ASC LIMIT $SayfalamayaBaslanacakKayitSayisi ,$SayfaBasinaGosterilecekKayitSayisi");
    $UrunSorgusu->execute();
    $UrunSorgusuKayitSayisi = $UrunSorgusu->rowCount();
    $UrunSorgusuKayitlari = $UrunSorgusu->fetchAll(PDO::FETCH_ASSOC);
            
    foreach ($UrunSorgusuKayitlari as $Kayitlar){
        echo "<tr height='30'>";
        echo "<td width='25' align='left'>" . $Kayitlar["id"] . "</td>";
        echo "<td width='375' align='left'>" . $Kayitlar["urunadi"] . "</td>";
        echo "<td width='100' align='right'>" . $Kayitlar["urunfiyati"] . " " . $Kayitlar["parabirimi"] . "</td>";
        echo "</tr>";
    }
    ?>
    </table>

    <div class="SayfalamaAalnaiKapsayicisi">
        <div class="SayfalamaAlaniIcinMetinAlaniKapsayicisi">
            Toplam <?php echo $BulunanSayfaSayisi;?> sayfada <?php echo $ToplamKayitSayisi;?> adet kayıt bulunmaktadır.
        </div>

        <div class="SayfalamaAlaniIcinNumaralandirmaAlaniKapsayicisi">
        <?php 
        if($GelenSayfalama>1){
            echo "<span class='Pasif'><a href='index.php?Sayfalama=1'><<</a></span>";
            $SayfalamaIcinSayfaDegeriniBirGeriAl = $GelenSayfalama-1;
            echo "<span class='Pasif'><a href='index.php?Sayfalama=" . $SayfalamaIcinSayfaDegeriniBirGeriAl . "'><</a></span>";
        }

        for($SayfalamaIcinSayfaIndexDegeri=$GelenSayfalama-$SayfalamaIcinSolVeSagButonSayisi; $SayfalamaIcinSayfaIndexDegeri<=$GelenSayfalama+$SayfalamaIcinSolVeSagButonSayisi;$SayfalamaIcinSayfaIndexDegeri++){
            if(($SayfalamaIcinSayfaIndexDegeri>0) and ($SayfalamaIcinSayfaIndexDegeri<=$BulunanSayfaSayisi)){
                if($GelenSayfalama==$SayfalamaIcinSayfaIndexDegeri){
                    echo "<span class='Aktif'>" . $SayfalamaIcinSayfaIndexDegeri. "</span>";
                }else{
            echo "<span class='Pasif'><a href='index.php?Sayfalama=" . $SayfalamaIcinSayfaIndexDegeri . "'>" . $SayfalamaIcinSayfaIndexDegeri . "</a></span>";
                }
            }
        }

        if($GelenSayfalama!=$BulunanSayfaSayisi){
            $SayfalamaIcinSayfaDegeriniBirGeriAl = $GelenSayfalama+1;
            echo "<span class='Pasif'><a href='index.php?Sayfalama=" . $SayfalamaIcinSayfaDegeriniBirGeriAl . "'>></a></span>";
            echo "<span class='Pasif'><a href='index.php?Sayfalama=" . $BulunanSayfaSayisi . "'>>></a></span>";
        }
        ?>
        </div>
    </div>
</body>
</html>
<?php
    $VeritabaniBaglantisi = null;
?>
