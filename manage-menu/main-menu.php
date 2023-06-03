<?php
include_once './../config/database.php';

$sql = "SELECT * FROM menu";
$statement = $pdo->prepare($sql);
$statement->execute();

$items = $statement->fetchAll(PDO::FETCH_ASSOC);
var_dump($items);

?>

<?php include_once "./../partials/header.php" ?>
<h1 class="text-center mt-3">Main Menu</h1>
</body>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Item no.</th>
      <th scope="col">Menu Item</th>
      <th scope="col">Description</th>
      <th scope="col">Price</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <?php foreach ($items as $i => $item) : ?>
        <th scope="row"><?php echo $i + 1 ?></th>
        <td><?php echo $item['title'] ?></td>
        <td><?php $item['description'] ?></td>
        <td><?php $item['price'] ?></td>
      <?php endforeach; ?>
    </tr>

  </tbody>
</table>






</main>

</html>