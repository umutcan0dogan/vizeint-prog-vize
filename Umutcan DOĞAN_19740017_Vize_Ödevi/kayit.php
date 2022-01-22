<?php
    //! daha önce bir proje için yazdığım trim fonkiyonu örneğim.
    function replace($text) {
        $text = trim($text);
        $search = array('Ç','ç','Ğ','ğ','ı','İ','Ö','ö','Ş','ş','Ü','ü',' ');
        $replace = array('C','c','G','g','i','I','O','o','S','s','U','u','_');
        $new_text = str_replace($search,$replace,$text);
        return $new_text;
    } 
 $yemek_adi = $_POST['yemek_adi'];//?---------------------------------------------------------------------------------------------------------- formdan gelen yemek adı
 $dosya_adi = strtolower(replace($yemek_adi)).'.php';//?--------------------------------------------------------------------------------------- dosya adında kullanmak için trimlenmiş ve küçük harfe dönüştürülmüş yemek adı
 $olcu = $_POST['olcu'];//?-------------------------------------------------------------------------------------------------------------------- formdan gelen ölçü dizisi
 $malzeme_adi = $_POST['malzeme_adi'];//?------------------------------------------------------------------------------------------------------ formdan gelen malzeme adı dizisi
 $tarif = $_POST['yemek_tarifi'];//?----------------------------------------------------------------------------------------------------------- formdan gelen yemek tarifi

    $malzeme = array_combine($olcu,$malzeme_adi);//?------------------------------------------------------------------------------------------- ölçü dizisi ve malzeme adı dizisi array combine ile anahtar ve içerik olarak birleştirildi
    foreach ($malzeme as $olcu => $malzeme){//?------------------------------------------------------------------------------------------------ foreach ile anahtar ölçü değişkenine, içerik ise malzeme değişkenine yazıldı
        if(!isset($malzeme_listesi)){//?------------------------------------------------------------------------------------------------------- malzeme listesi adında bir değişken var mı kontrol edildi    
            $malzeme_listesi = '\''.$olcu.' '.$malzeme.'\'';//?-------------------------------------------------------------------------------- malzeme listesi değişkeni fwrite ile yazılabilecek şekilde bir array yapısına eşitlendi
        }else{                                                  
            $malzeme_listesi = $malzeme_listesi.',\''.$olcu.' '.$malzeme.'\'';//?-------------------------------------------------------------- malzeme listesi değişkeni oluşturulduğu için yeni malzeme eklendi
        }
    }
    if(file_exists('tarifler/'.$dosya_adi)) {//?----------------------------------------------------------------------------------------------- dosya var mı yok mu kontrol edildi
        echo '<script language="javascript">alert("Bu tarif daha önce eklenmiştir.")</script>';//?--------------------------------------------- tarife göre dosya oluşturulduğu için dosya varsa tarif eklenmiş uyarısı verildi
        header("Refresh:0.1; url=http://localhost");//?---------------------------------------------------------------------------------------- uyarıdan sonra anasayfaya yönlendirildi
     } else {//?------------------------------------------------------------------------------------------------------------------------------- tarif yoksa
        $olustur = touch('tarifler/'.$dosya_adi);//?------------------------------------------------------------------------------------------- touch ile tarifler klasörüne yemek adı ile dosya oluşturuldu   
        if($olustur){//?----------------------------------------------------------------------------------------------------------------------- oluştur olumlu ise
            $dosya = fopen('tarifler/'.$dosya_adi , 'w');//?----------------------------------------------------------------------------------- dosya yazmak için açıldı
            fwrite($dosya, '<?php $yemek_adi=\''.$yemek_adi.'\'; '.'$malzeme_listesi=['.$malzeme_listesi.']; $tarif=\''.$tarif.'\'; ?>');//?--- dosya içine yazılacak değişkenler birleştirildi ve yazıldı
            fclose($dosya);//?----------------------------------------------------------------------------------------------------------------- dosya kapatıldı
            echo '<script language="javascript">alert("Tarifiniz eklenmiştir. Teşekkür ederiz...")</script>';//?------------------------------- işlem olumlu gerçekleştiği için tarif eklenmiştir uyarısı verildi
            header("Refresh:0.1; url=http://localhost");//?------------------------------------------------------------------------------------ uyarıdan sonra anasayfaya yönlendirildi
        }
     }
?>