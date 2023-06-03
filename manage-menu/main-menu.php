<?php

include_once './../config/database.php';

$sql = "SELECT * FROM menu";
$statement = $pdo->prepare($sql);
$statement->execute();

$items = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include_once "./../partials/header.php" ?>
<h1 class="text-center mt-3">Main Menu</h1>
<a href="create-item.php" class="btn btn-success ms-4">Create Item</a>
<table class="table mt-5 ms-2 me-2">
  <thead>
    <tr class="mt-4">
      <th scope="col">Item no.</th>
      <th scope="col">Menu Item</th>
      <th scope="col">Description</th>
      <th scope="col">Price</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($items as $i => $item) : ?>
      <tr>
        <th scope="row"><?php echo $i + 1 ?></th>
        <td><?php echo $item['title'] ?></td>
        <td class="col-4"><?php echo $item['description'] ?></td>
        <td><?php echo '$' . $item['price'] ?></td>
        <td>
          <a href="edit-item.php?id=<?php echo $item['id']; ?>" class="btn btn-danger">Edit</a>
          <form class="form-delete-item" action="delete-item.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
            <button class="btn btn-secondary" type="submit">Delete</button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>

  </tbody>
</table>
</main>
</body>

</html>