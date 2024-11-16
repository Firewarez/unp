<?php
session_start();
include('conexao.php');
$auth = false;

if (isset($_SESSION['usuario_id'])) {
  $auth = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Unp - Perfil</title>
  <link rel="shortcut icon" type="imagex/png" href="../ui/img/logo-icon.png">
  <link rel="stylesheet" type="text/css" href="../ui/static/style.css">
  <link rel="stylesheet" type="text/css" href="../ui/static/indexcss.css">
  <link rel="stylesheet" type="text/css" href="../ui/static/searchui.css">
  <link rel="stylesheet" type="text/css" href="../ui/static/subforum.css">
  <link rel="stylesheet" type="text/css" href="../ui/static/footer.css">
  <script src="https://kit.fontawesome.com/cbe388e870.js" crossorigin="anonymous" defer></script>
  <script type="text/javascript" src="../ui/js/scripts.js" defer></script>
</head>
<body>
<div class="barra-navegacao">
      <!-- Navegação -->
      <div class="logo-img">
        <a class="logo-btn" href="../index.php"><img id="logo" src="../ui/img/logo-icon-yellow.png" height="50" width="50"></a>
      </div>
      <div class="search-container">
        <input type="text" id="search" class="search" placeholder="Pesquisar...">
        <label for="check" class="btn-search">
          <i class="fa-solid fa-magnifying-glass" style="color: #000000;"></i>
        </label>
        
      </div>

      <!-- User Info main display -->
      <div class="user-info">

        <!-- Check if user is logged then display his login name -->
        <?php if ($auth): ?>
          <div id="user-trigger" class="user-trigger">
            <p class="loginok"><i class="fa-regular fa-user user-icon"></i>
            </p>
            <ul id="user-menu" class="user-menu-config">
              <li><?php echo htmlspecialchars($_SESSION['usuario_login']); ?></li>
              <li class="usr-stl"><a href="./web/perfil.php">Perfil</a></li>
              <li class="usr-stl"><a href="./web/logout.php">Sair</a></li>
            </ul>

          </div>
        <?php else: ?>
          <!-- Guest Login/Register -->
          <div class="login-btn-trigger">
            <a href="./web/logar.php">Entrar</a>
          </div>
        <?php endif; ?>
       
        <div id="menu-trigger" class="menu-trigger">
          <i class="fa-solid fa-gear config-menu"></i>
          <ul id="menu-list" class="menu-menu-config">
            <li class="config-stl">
              <div class="mode-toggle">
                <i id="modeIcon" class="bi bi-toggle-on escuro" onclick="ToggleDarkModeIcon()"></i> Modo Escuro
              </div>
            </li>
            <li class="config-stl">Item 2</li>
            <li class="config-stl">Item 3</li>
          </ul>
        </div>
      </div>

    </div>
</body>
</html>