<?php
require_once "./../config/database.php";
$id = $_GET['id'] ?? null;


if (!$id) {
  header('Location: main-menu.php');
}

$sql = "SELECT * FROM menu WHERE id = :id";
$statement = $pdo->prepare($sql);
$statement->bindValue(':id', $id);
$statement->execute();
$items = $statement->fetch(PDO::FETCH_ASSOC);


if (isset($_POST['edit-item'])) {
  $title = $description = $price = "";
  $titleErr = $priceErr = "";
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

  if (empty($titleErr) && empty($priceErr)) {
    $sql = 'UPDATE menu SET title=:title,description=:description,price=:price WHERE id = :id';
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':description', $description);
    $statement->bindValue(':price', $price);
    $statement->bindValue(':id', $id);
    $statement->execute();

    header('Location: main-menu.php');
  }
}
?>

<?php include_once "./../partials/header.php" ?>
<div class="mt-4 w-100 admin-login">
  <h1 class=" m-4">Edit Item</h1>
  <form class=" m-4 col-md-6" method="POST">
    <div class="mb-3">
      <label for="title" class="form-label">Item Name</label>
      <input type="text" class="form-control <?php echo $titleErr ? 'is-invalid' : null ?>" id="title" name="title" value="<?php echo $items['title']; ?>">
      <div class="invalid-feedback">
        <?php echo $titleErr ?>
      </div>
    </div>
    <div class="mb-3">
      <label for="description" class="form-label">Description</label>
      <input type="text" class="form-control" id="description" name="description" value="<?php echo $items['description']; ?>">
    </div>
    <div class="mb-3">
      <label for="price" class="form-label">Price</label>
      <input type="number" step="0.01" class="form-control <?php echo $priceErr ? 'is-invalid' : null ?>" id="price" name="price" value="<?php echo $items['price']; ?>">
      <div class="invalid-feedback">
        <?php echo $priceErr; ?>
      </div>
    </div>

    <button type="submit" name="edit-item" class="btn btn-primary">Edit</button>


</div>
</form>
</main>
</body>

</html>