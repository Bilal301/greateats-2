<?php

$title = $description = $price = "";
$titleErr = $priceErr = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  require_once "./../config/database.php";
  if (isset($_POST['create-item'])) {
    if (empty($_POST['title'])) {
      $titleErr = 'item name is required';
    } else {
      $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    if ($_POST['description']) {
      $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    if (empty($_POST['price'])) {
      $priceErr = 'item name is required';
    } else {
      $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
    }
    $imagesDir = './../assets/img/menu-images';
    if (!is_dir($imagesDir)) {
      mkdir($imagesDir);
    }
    $imagePath = "";
    if (empty($titleErr) && empty($priceErr)) {
      $image = $_FILES['filename'] ?? null;
      if ($image && $image['tmp_name']) {
        $imagePath = $imagesDir . "/" . randomStrings(8) . "/" . $image['name'];
        mkdir(dirname($imagePath));

        move_uploaded_file($image['tmp_name'], $imagePath);
      }


      $sql = 'INSERT INTO menu (image,title,description,price) VALUES (:image,:title, :description, :price)';
      $statement = $pdo->prepare($sql);
      $statement->bindValue(':image', $imagePath);
      $statement->bindValue(':title', $title);
      $statement->bindValue(':description', $description);
      $statement->bindValue(':price', $price);
      $statement->execute();

      header('Location: main-menu.php');
    }
  }
}

function randomStrings($n)
{
  $char = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $str = '';

  for ($i = 0; $i < $n; $i++) {
    $index = rand(0, strlen($char) - 1);
    $str .= $char[$index];
  }
  return $str;
}


?>

<?php include_once "./../partials/header.php" ?>
<div class="mt-4 w-100 admin-login">
  <h1 class=" m-4">Create Item</h1>
  <form class=" m-4 col-md-6" method="POST" enctype="multipart/form-data">
    <input type="file" class="form-control" id="myFile" name="filename">

    <div class="mb-3">
      <label for="title" class="form-label">Create Item</label>
      <input type="text" class="form-control <?php echo $titleErr ? 'is-invalid' : null ?>" id="title" name="title" value="<?php echo $title ?>">
      <div class="invalid-feedback">
        <?php echo $titleErr ?>
      </div>
    </div>
    <div class="mb-3">
      <label for="description" class="form-label">Description</label>
      <input type="text" class="form-control" id="description" name="description" value="<?php echo $description; ?>">
    </div>
    <div class="mb-3">
      <label for="price" class="form-label">Price</label>
      <input type="number" step="0.01" class="form-control <?php echo $priceErr ? 'is-invalid' : null ?>" id="price" name="price" value="<?php echo $price; ?>">
      <div class="invalid-feedback">
        <?php echo $priceErr; ?>
      </div>
    </div>

    <button type="submit" name="create-item" class="btn btn-primary">Create Item</button>


</div>
</form>
</main>
</body>

</html>