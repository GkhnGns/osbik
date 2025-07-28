# osbik

Gelismis Insan Kaynaklari Yazilimi

Bu proje, PHP ile yazilmis basit bir Insan Kaynaklari (IK) uygulamasidir. Calisan, firma, ilan ve basvuru kayitlarini dosya tabanli olarak tutar. Ornek olarak genel basvuru raporu olusturulabilir.

## Calistirma

1. PHP 7 veya uzeri bir surumun yüklü olduğundan emin olun.
2. Depo klasorunde `php -S localhost:8000` komutunu calistirin.
3. Tarayicinizdan `http://localhost:8000/index.php`, `report.php` ya da `giris.php` adreslerini ziyaret edin.

Veriler `*.json` dosyalarinda saklanir ve ornek veriler depo icerisinde mevcuttur.

## Veritabani

Is arayan kullanicilarin kaydi MySQL veritabani uzerinden yapilir. `db.php` dosyasinda asagidaki baglanti bilgileri kullanilmistir:

- veritabani: `gokh3319_osbik`
- kullanici: `gokh3319_osbikuser`
- parola: `3[6.QujZcN&!vAIK3[6.QujZcN&!vAIK&!vAIK3[6.Quj`

Uygulamayi calistirmadan once bu veritabani ve `users` tablosunun olusturulmus oldugundan emin olun.
