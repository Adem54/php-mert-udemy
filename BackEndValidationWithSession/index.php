<?php  session_start(); ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Php mail send</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
   <div class="container">
    <h3 class="text-center mt-5 mb-5">Sending mail with php</h3>     
    <div class="row justify-content-center">
       
                <!-- bootstrap sayfayi 12 parcaya boluyor-->
                <div class="col-md-6">
                    <!-- Bu epostlarin kime gidecegini soylemek icin kullanacagimiz email olacak-->

                    <!-- BIRDE METHODU POST OLSUN KI VERILER GOZUKMEDEN GITSIN..
                    form-action da email i hangi sayfaya gonderecegimizi beliritirz  
                    Post methodunun gonderildiginin gonderilen sayfada ayirt edilmesi icin input lar name alanlari ile gondeirilir
                    bu cok onemlidir
                    BU ARADA BU COK ONEMLIDIR KULLANICI HER ZAMAN DOGRU YONLENDIRILMEDLIDIR
                    Birde bu sayfada biz bootstrap in alert kutularini, success veya error durumunda 
                    kutu mesaj vermek icin kullanilan bootstrap-alerti biz, tum alanlari doldurun veya email gondeirlememe veya 
                    basarili gonderme durumu icin kullanabiliriz
                    -->

                    <?php    
                 
            //php icersinde div veya html kullanirken php taglarini kullandigmiz yerde kapatirz html taglarini kullaniriz ardindan php nin devam ettigi
            //yerde tekrardan php taglarimizi acip kapatarak devam ederiz
            //div icerisindeki veri de send_email sayfasindan gelecek, ve bizim burda html icinde rahatca php kullanma gibi bir ozgurlugumuz ve kolayligimiz var bu 
            //bizi cok rahatlatiyor
            //Eger session da alert diye bir indis var ise yani key var ise o zaman
            if(isset($_SESSION["alert"])){ ?>
            <div class="alert alert-<?php echo $_SESSION["alert"]["type"];?> ">
                   <?php 
                   $alert=$_SESSION["alert"];
                   echo $alert["message"];
                   ?> 
            </div>
            <?php
            //SESSION ILE BIZ BIR KEZ DATA YAZDIRDIMGZ ZAMAN SESSION DA DATA HER ZAMAN GOSTERILIYOR ONDAN DOLAYI BIZIM DATAYI SILMEMIZ GEREKIYOR BUNUN
            //ICNDE BIZIM SESSION IN UNSET ILE RESEET ETMEMIZ GEREKIR..., BU SEKILDE RESET EDERSEK SAYFA YENILENINCE BIZE ARTIK MESAJI GOSTERMEZ
            unset($_SESSION["alert"]);
            ?>
           <?php  } ?>
     
           
            
           
           <!-- //Bir dosya transferi yapilacaksa form elementinin attributunde encription-type i formdata olarak vermemiz gerekir
-->

               <form action="send_email.php" method="post" enctype="multipart/form-data">

                <div class="form-group mb-3">
                    <label class="mb-2 fw-bold " for="to_email">Adress to be sent</label>
                    <input  id="to_email" class="form-control" type="email" required name="to_email">
                </div>
                <div class="form-group mb-3 fw-bold">
                    <label class="mb-2" for="sender">Sender Name</label>
                    <input id="sender" class="form-control" type="text" required name="sender">
                </div>
                <div class="form-group mb-3 fw-bold">
                    <label class="mb-2" for="subject">Subject</label>
                    <input id="subject" class="form-control" type="text" required name="subject">
                </div>
               
                <div class="form-group mb-3 fw-bold">
                    <label class="mb-2" for="message">Message</label>
                    <textarea name="message" id="message" cols="30" rows="10" required class="form-control"></textarea>
                </div>
                <div class="form-group mb-3 fw-bold">
                    <label for="formFile" class="mb-2">Attach File</label>
                    <input class="form-control-file" type="file" id="attachment" name="attachment">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-danger ">Clean Form</button>
               </form>
                </div>
            </div>
   </div>
</body>
</html>