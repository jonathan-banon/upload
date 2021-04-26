<?php
if ($_SERVER ['REQUEST_METHOD'] === 'POST') {
    $uploadDir = 'img/';
// le nom de fichier sur le serveur est celui du nom d'origine du fichier sur le poste du client (mais d'autre stratégies de nommage sont possibles)
    $uploadFile = $uploadDir . basename($_FILES['avatar']['name']);
// Je récupère l'extension du fichier
    $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
    $extensions_ok = ['jpg','png','webp'];
    $maxFileSize = 1000000;
// test
    if(!in_array($extension, $extensions_ok )) {
        $error[] = 'Please choose an image with the good type !';
    }
    if(file_exists($_FILES['avatar']['name']) && file_exists($_FILES['avatar']['name']) > $maxFileSize) {
        $errors[] = "Your file must weigh under 1M !";
    }
    // on déplace le fichier temporaire vers le nouvel emplacement sur le serveur. Ca y est, le fichier est uploadé
    move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile);
}

?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <link rel="stylesheet" href="card.css">
        <title>Document</title>
    </head>
    <body>
        <form method="post" enctype="multipart/form-data">
            <label for="avatar">Upload an profile image :</label>
            <input type="file" name="avatar" id="avatar" required/>
            <br>
            <label for="firstname">Firstname :</label>
            <input type="text" name="firstname" id="firstname" required/>
            <br>
            <label for="lastname">Lastname :</label>
            <input type="text" name="lastname" id="lastname" required/>
            <button>Send</button>
        </form>
        <div class="container d-flex flex-column mt-5 w-100 ">
            <div class="d-flex justify-content-end rounded-top w-100" id="row_01">
                <p class="h1 m-3 " id="h1-card">TAXICAB <br> LICENSE</p>
            </div>
            <div class="d-flex flex-row w-100" id="row_02">
                <div class="w-50">
                    <?php ?>
                    <img class="img-fluid rounded border border-dark m-2" src="img/<?=isset($_FILES['avatar']) ? $_FILES['avatar']['name'] : 'homer.png' ?>" alt="img_test">
                </div>
                <div class="d-flex flex-column align-content-between m-3 w-50">
                    <div class="d-flex justify-content-end">
                        <p class="h1">
                            <?=  $_POST['firstname']?>
                            <br>
                            <?=  $_POST['lastname'] ?>
                        </p>
                    </div>
                    <div class="d-flex justify-content-end flex-row">
                        <div >
                            <img class="img-fluid h-100" src="img/badge.png" alt="">
                        </div>
                        <div class="d-flex  align-items-end">
                            <img class="img-fluid h-75" src="img/sign.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    </body>
</html>