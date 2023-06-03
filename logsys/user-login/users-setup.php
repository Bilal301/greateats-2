<?php

session_start();

if (isset($_POST['login'])) {
  require_once "./../../config/database.php";
  $username = $password = $email = $nameErr = $emailErr = $passErr = '';
  $message = '';
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (empty($_POST['username'])) {
      $nameErr = 'username is required';
    } else {
      $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    if (empty($_POST['password'])) {
      $passErr = 'password is required';
    } else {
      $password = md5($_POST['password']);
    }

    if (!empty($_POST['admin'])) {
      $role = 'admin';
    } else {
      $role = 'user';
    }

    if (empty($nameErr) && empty($passErr)) {
      if (isset($_POST['login'])) {
        $sql = 'INSERT INTO users_temp (username,password,role)
         VALUES (:username,:password,:role)';

        $statement = $pdo->prepare($sql);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $password);
        $statement->bindValue(':role', $role);
        $statement->execute();


        $message = 'New user created';
      } else {
        $message = 'An Error occured';
      }
    }
  }
}







?>


<?php require_once "./../../partials/header.php" ?>
<?php if (!empty($message)) : ?>
  <div class="alert <?php echo ($message === 'New user created') ? 'alert-success' : 'alert-danger'; ?>" role="alert">
    <?php echo $message; ?>
  </div>
<?php endif; ?>
<div class=" container d-flex flex-column align-items-center">
  <img src="./../../assets/img/great-eats-logo.png" class="w-25 mt-5 mb-3" alt="">
  <h2>Add User</h2>
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" class="mt-4 w-75 admin-login">
    <div class="mb-3 col-md-6">
      <label for="username" class="form-label">User Name</label>
      <input type="text" class=" form-control <?php echo $nameErr ? 'is-invalid' : null ?>" id="username" name="username" placeholder="Enter your username">
      <div class="invalid-feedback">
        <?php echo $nameErr; ?>
      </div>
    </div>

    <div class="mb-3 col-md-6">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control <?php echo $passErr ? 'is-invalid' : null ?>" id="password" name="password" placeholder="Enter your password">
      <div class="invalid-feedback">
        <?php echo $passErr; ?>
      </div>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="admin" name="admin" id="admin">
      <label class="form-check-label" for="admin">
        Admin
      </label>
    </div>


    <div class="mt-4 mb-3 col-md-6">
      <input type="submit" name="login" value="Add User" class="btn btn-dark w-100">
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