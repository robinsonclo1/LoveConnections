<?php
  require '../include/connection.php';
  require '../include/session.php';
  require "../include/topnav.php";
  require_once '../include/uploadHelper.php';
  $title = 'File uploading';
  $msg = UploadHelper::init($conn);
  $imgs = UploadHelper::getImages($conn);
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Change Profile Picture</title>
  </head>

  <body>
  <h1>Change Your Profile Picture</h1>
    <div class="container-fluid">
      <div class="col-md-6 col-md-offset-3">
        <div class="sign-up-box">
          <h1><?=$title?></h1>
          <?php if (!empty($msg)): ?>
            <div class="card warning">
              <p class="section"><?=$msg?></p>
            </div>
            <?php endif; ?>
            <form action="" method="post" enctype="multipart/form-data">
              <fieldset>
                  <input id="upload" type="file" name="upload"/>
                  <label for="upload" class="btn btn-primary">Choose file...</label>
                  <button type="submit" class="btn btn-primary">Upload</button>
              </fieldset>
            </form>
            <?php foreach($imgs as $img): ?>
            <div>
              <img src="getImage.php?id=<?=$img['id']?>" alt="<?=$img['filename']?>" />
            </div>
            <?php endforeach; ?>
        </div>
      </div>
    </div>
  </body>
</html>
