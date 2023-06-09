<?php
session_start();
include_once './../config/database.php';

$sql = "SELECT * FROM menu";
$statement = $pdo->prepare($sql);
$statement->execute();

$items = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include_once "./../partials/header.php" ?>
<div class="alert alert-success" role="alert">
  <?php echo $_SESSION['username'] . " is currently logged in." ?>
</div>
<h1 class="text-center mt-3">Main Menu</h1>
<a href="create-item.php" class="btn btn-success ms-4">Create Item</a>
<?php if ($_SESSION['role'] === 'admin') : ?>
  <a href="./../logsys/user-login/admin-login.php" class="btn btn-info float-end me-4">Back to Admin login</a>
<?php endif; ?>
<a href="./../logsys/user-login/logout.php" class="btn btn-warning float-end me-4">Logout</a>
<table class="table mt-5 ms-2 me-2">
  <thead>
    <tr class="mt-4">
      <th scope="col">Item no.</th>
      <th scope="col">Item Image</th>
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
        <td><img style="width: 200px;" src="<?php echo $item['image'] ?>" </td>
        <td><?php echo $item['title'] ?></td>
        <td class="col-4"><?php echo $item['description'] ?></td>
        <td><?php echo '$' . $item['price'] ?></td>
        <td>
          <a href="edit-item.php?id=<?php echo $item['id']; ?>" class="btn btn-danger">Edit</a>
          <form class="form-delete-item" action="delete-item.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
            <button onclick="confirm('Are you sure?')" class="btn btn-secondary" type="submit">Delete</button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>

  </tbody>
</table>
</main>
</body>

</html>