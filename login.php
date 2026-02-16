<?php


//session_start();
//require_once 'config.php';
//require_once 'classes/Auth.php';

//$auth = new Auth($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if ($auth->login($_POST['email'], $_POST['password'])) {
    header('Location: index.php');
    exit;
  } else {
    header('Location: login.php');
    exit;
  }
}


?> 



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/login.css">
  <!-- CSS do Bootstrap -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <title>Login - Assumpção Desenvolvimento</title>
</head>

<body>

  <div class="container">
    <form id="form" method="post">

      <h2>LOGIN</h2><br />

      <?php if (!empty($_SESSION['erro'])): ?>
        <?= $_SESSION['erro']; ?>
        <?php unset($_SESSION['erro']); ?>
      <?php endif; ?>

      <label>E-mail</label>
      <input type="email" name="email" id="" placeholder="Seu e-mail" value="<?= htmlspecialchars($_SESSION['email'] ?? '') ?>">

      <label>Senha</label>
      <input type="password" name="password" placeholder="Sua senha">

      <a class="showPassword" id="click" href="">Mostrar senha</a>

      <input type="submit" value="Entrar">

      <a href="#" class="update-password">Esqueceu a senha?</a>

    </form>
  </div>

  <!-- JS do Bootstrap -->
  <script src="bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
