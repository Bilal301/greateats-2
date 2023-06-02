<?php
require_once "./../../config/database.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password =  $_POST['password'];
  if (isset($_POST['login'])) {
    $sql = 'SELECT * FROM users WHERE username=:username AND password=:password';
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':username', $username);
    $statement->bindValue(':password', $password);
    $statement->execute();

    $count = $statement->rowCount();
    if ($count > 0) {
      header('location: ./../../manage-menu/main-menu.php');
    }
  }
}
?>


<?php require_once "./../../partials/header.php" ?>
<div class=" container d-flex flex-column align-items-center">
  <img src="./../../assets/img/great-eats-logo.png" class="w-25 mt-5 mb-3" alt="">
  <h2>User Login</h2>
  <form action="" method="POST" class="mt-4 w-75 admin-login">
    <div class="mb-3 col-md-6">
      <label for="username" class="form-label">User Name</label>
      <input type="text" class=" form-control" id="username" name="username" placeholder="Enter your username">
    </div>
    <div class="mb-3 col-md-6">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
    </div>

    <div class="mb-3 col-md-6">
      <input type="submit" name="login" value="Login" class="btn btn-dark w-100">
    </div>
  </form>
</div>
</main>

<footer class="text-center mt-5">
  Copyright &copy; 2023
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>