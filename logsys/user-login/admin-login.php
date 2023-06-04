<?php
session_start();
require_once "./../../config/database.php";

$sql = "SELECT * FROM users_temp";
$statement = $pdo->prepare($sql);
$statement->execute();

$users = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include_once "./../../partials/header.php"; ?>
<div class="alert alert-success" role="alert">
  <?php echo $_SESSION['username'] . " is currently logged in." ?>
</div>
<h1 class=" m-4">Admin Login</h1>
<a href="./../../manage-menu/main-menu.php" class="btn btn-secondary ms-3">Go to Menu</a>
<a href="./../../manage-menu/main-menu.php" class="btn btn-success ms-3">Create User</a>
<a href="./logout.php" class="btn btn-warning float-end me-3">Logout</a>

<table class="table mt-5 ms-2 me-2">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Role</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($users as $user) : ?>
      <tr>
        <th scope="row"><?php echo $user['id']; ?></th>
        <td><?php echo $user['username']; ?></td>
        <td><?php echo $user['role']; ?></td>
        <td>
          <form action="delete-user.php" method="post">
            <input type="hidden" name="id" value="<?php echo $user['id'] ?>">
            <button type="submit" class="btn btn-danger">Delete User</button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>