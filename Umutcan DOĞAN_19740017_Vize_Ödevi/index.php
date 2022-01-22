<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <style>
          body {
            background-color: #EEF5F9;
            margin-top: 20px;
            display: flex;
            justify-content: center;
          }
          .cnt{
            width: 100%;
          }
          .plus{
            height: 30px;
            width: 30px;
            border-radius: 50%;
            background-color: #007bff;
            display: inline-block;
            line-height: 25px;
            font-weight: bold;
            color: #fff;
            font-size: 28px;
          }
          .plus:hover{
            background-color: #0065D1;
            cursor: pointer;
          }
        </style>
    <title>Umutcan DOĞAN - 19740017</title>
</head>

<body>
  <div class="cnt row">
      <div class="col-lg-5">
        <div class="card card-outline-info">
          <div class="alert alert-primary">
            <strong>YEMEK TARİFİ EKLEME FORMU</strong> 
          </div>
          <div class="card-body">
            <form action="kayit.php" method="post" class="form-body">                             
              <div class="form-group">
                  <label>Yemek Adı</label>
                  <input type="text" name="yemek_adi" class="form-control" placeholder="Yemek adını giriniz..." required>
              </div>
              <div class="row" id="list">
                <small class="form-text text-muted col-md-12 mb-2">Aşağıdaki kutucuklara malzemeleri giriniz...</small>
                <div class=" col-md-6 form-group">
                    <label>Ölçü</label>
                    <input type="text" name="olcu[]" class="form-control" placeholder="100gr / 1 Yemek Kaşığı..." required>
                </div>
                <div class=" col-md-6 form-group">
                  <label>Malzeme Adı</label>
                  <input type="text" name="malzeme_adi[]" class="form-control" placeholder="Malzeme adını giriniz..." required>
                </div>

                <div class="col-md-6 form-group">
                    <input type="text" name="olcu[]" class="form-control" placeholder="100gr / 1 Yemek Kaşığı..." required>
                </div>
                <div class=" col-md-6 form-group">
                  <input type="text" name="malzeme_adi[]" class="form-control" placeholder="Malzeme adını giriniz..." required>
                </div>
                
              </div>
              <div class="col-md-12 text-center">
                <span class="plus" onclick="malzemeekle()">+</span>
              </div>
              <div class="form-group">
                <label>Yemek Tarifi</label>
                <textarea class="form-control" rows="6" name="yemek_tarifi" required></textarea>
              </div>
              <button type="submit" class="btn btn-primary mt-3"> Kaydet</button>
            </form>
          </div>
        </div>
      </div>

      <div class="col-lg-7">
        <div class="card card-outline-info">
          <div class="alert alert-primary">
            <strong>YEMEK TARİFLERİ</strong> 
          </div>
          <div class="card-body">
          <div class="accordion" id="accordionExample">

          <?php

          //!--------------------------------------------------------------------------------------------------------------------- menemen_tarifi.php dosyasında tarif ekleme ve görüntüleme mantığı anlatıldı

          $dir = opendir("tarifler");//?------------------------------------------------------------------------------------------ klasör açıldı
          $x = 0;//?-------------------------------------------------------------------------------------------------------------- bootstrap collapse idleri için değişken oluşturuldu
          while (($dosya = readdir($dir)) !== false){//?-------------------------------------------------------------------------- klasör okunup döngüye atandı
            if(! is_dir($dosya)){//?---------------------------------------------------------------------------------------------- döngüdeki dizin olmayan değerler seçildi
              include ('tarifler/'.$dosya);//?------------------------------------------------------------------------------------ dosyalar include ile dahil edildi
                echo '            <div class="card">
                <div class="card-header" id="headingThree">
                  <h5 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse'.$x.'">     <!-- collapse için benzersiz id değişkeni -->
                      '.$yemek_adi.'                                                                                               <!-- include ile sayfaya dahil edilen yemek adı değişkeni yazıldı -->
                    </button>
                  </h5>
                </div>
                <div id="collapse'.$x.'" class="collapse">                                                                         <!-- collapse için benzersiz id değişkeni -->
                  <div class="card-body">';
                  foreach($malzeme_listesi as $malzeme){//?----------------------------------------------------------------------- foreach ile malzeme listesi dizisi malzeme değişkenine atandı
                      echo '<li>'.$malzeme.'</li>';//?---------------------------------------------------------------------------- malzeme değişkeni li etiketleri ile yazıldı
                  }
                   echo'<hr>
                   <p>'.$tarif.'</p>                                                                                               <!-- include ile sayfaya dahil edilen tarif değişkeni yazıldı -->
                   </div>
                </div>
              </div>';
              $x++;//?------------------------------------------------------------------------------------------------------------ idlerin benzersiz olabilmesi için x değişkeni her döngüde bir artırıldı
             }
          }
          closedir($dir);//?------------------------------------------------------------------------------------------------------ klasör kapatıldı
          ?>



          </div>
          </div>
        </div>
      </div>
  </div>
  <script>
    function malzemeekle() {
      var div = document.createElement("DIV");
      div.setAttribute("class", "col-md-6 form-group"); 
      var input = document.createElement("INPUT");
      input.setAttribute("name", "olcu[]"); 
      input.setAttribute("class", "form-control");
      input.setAttribute("placeholder", "100gr / 1 Yemek Kaşığı...");
      div.appendChild(input);
      document.getElementById("list").appendChild(div);
      
      var div1 = document.createElement("DIV");
      div1.setAttribute("class", "col-md-6 form-group"); 
      var input = document.createElement("INPUT");
      input.setAttribute("name", "malzeme_adi[]"); 
      input.setAttribute("class", "form-control");
      input.setAttribute("placeholder", "Malzeme adını giriniz...");
      div1.appendChild(input);
      document.getElementById("list").appendChild(div1);
    }
  </script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>