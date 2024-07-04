# PHP Sayfalama Uygulaması README Dosyası

Bu uygulama, veritabanından alınan kayıtları belirli sayfalara bölerek kullanıcıya sunar ve sayfalar arasında gezinme imkanı sağlar.

## Gereksinimler

- PHP 7.0 veya üstü
- MySQL 5.6 veya üstü
- Bir web sunucusu (Apache, Nginx vb.)
- Veritabanı bağlantı bilgileri

## Kurulum

**Veritabanı Bağlantısı**: Veritabanı bağlantısını kurmak için `PDO` kullanılmaktadır. Bağlantı bilgilerini aşağıdaki gibi ayarlayın:
    ```php
    try {
        $VeritabaniBaglantisi = new PDO("mysql:host=localhost;dbname=urun;charset=utf8", "root", "9900");
    } catch (PDOException $Hata) {
        echo "Bağlantı Hatası<br>" . $Hata->getMessage();
        die();
    }
    ```

**Veritabanı Tablosu**: Uygulamanın çalışması için aşağıdaki gibi bir `urun` tablosu oluşturulmalıdır:
    ```sql
    CREATE TABLE `urun` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `urunadi` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
        `urunfiyati` decimal(10,2) NOT NULL,
        `parabirimi` varchar(3) COLLATE utf8_turkish_ci NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;
    ```

**Veri Ekleme**: `urun` tablosuna örnek veriler ekleyin

## Kullanım

**Sayfalama Değeri**: Kullanıcının istediği sayfayı belirlemek için `$_REQUEST["Sayfalama"]` değeri alınır. Eğer bu değer yoksa, varsayılan olarak 1. sayfa gösterilir.
    ```php
    if(isset($_REQUEST["Sayfalama"])){
        $GelenSayfalama = $_REQUEST["Sayfalama"];
    }else{
        $GelenSayfalama = 1;
    }
    ```

**Sayfa Başına Kayıt Sayısı**: Bir sayfada gösterilecek kayıt sayısını belirleyin. Bu örnekte 5 kayıt gösterilmektedir.
    ```php
    $SayfaBasinaGosterilecekKayitSayisi = 5;
    ```

**Toplam Kayıt Sayısı ve Sayfa Sayısı**: Veritabanından toplam kayıt sayısını ve toplam sayfa sayısını hesaplayın.
    ```php
    $ToplamKayitSayisiSorgusu = $VeritabaniBaglantisi->prepare("SELECT * FROM urun");
    $ToplamKayitSayisiSorgusu->execute();
    $ToplamKayitSayisi = $ToplamKayitSayisiSorgusu->rowCount();
    $BulunanSayfaSayisi = ceil($ToplamKayitSayisi/$SayfaBasinaGosterilecekKayitSayisi);
    ```

**Kayıtları Getir ve Göster**: İlgili sayfanın kayıtlarını veritabanından çekin ve tablo şeklinde gösterin.

https://github.com/Deryaglmz/PHP_SayfalamaUygulamasi/assets/129391768/0fecf185-6d07-4c43-972a-f51ac4aa2a6b

