<!DOCTYPE html>
<html lang="pt-br">
<?php
session_start();
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Unp - Forum</title>
  <link rel="shortcut icon" type="imagex/png" href="../ui/img/logo-icon.png">
  <link rel="stylesheet" type="text/css" href="../ui/static/style.css">
  <link rel="stylesheet" type="text/css" href="../ui/static/searchui.css">
  <link rel="stylesheet" type="text/css" href="../ui/static/subforum.css">
  <script src="https://kit.fontawesome.com/cbe388e870.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="./ui/js/scripts.js"></script>
</head>

<body>
  <div class="main">
    <div class="barra-navegacao">
      <!-- Navegação -->
      <div class="logo-img">
        <a class="logo-btn" href="index.php"><img id="logo" src="./ui/img/logo-icon.png" height="50" width="50"></a>
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
        <?php if (isset($_SESSION['nome'])): ?>
          <div id="user-trigger" class="user-trigger">
            <p class="loginok"><i class="fa-regular fa-user user-icon"></i>
            </p>
            <ul id="user-menu" class="user-menu-config">
              <li><?php echo htmlspecialchars($_SESSION['nome']); ?></li>
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
        <div class="news-btn">
          <a href="../index.php"><i class="fa-brands fa-wpforms"></i></a>
        </div>
        <div id="menu-trigger" class="menu-trigger">
          <i class="fa-solid fa-gear config-menu"></i>
          <ul id="menu-list" class="menu-menu-config">
            <li class="config-stl">Item 1</li>
            <li class="config-stl">Item 2</li>
            <li class="config-stl">Item 3</li>
          </ul>
        </div>
      </div>

    </div>
    <div class="topic-start">
      <div class="topic-btn">
        <p><i class="fa-solid fa-plus"></i> Topic</p>
      </div>
    </div>


    <!-- Main Content -->
    <div class="container">
      <!-- Forum main content container -->
      <div class="subforum">
        <div class="subforum-title">
          <h1>General info</h1> <!-- Forum main row -->
        </div>
        <div class="subforum-row"> <!-- Subforum Linha -->
          <div class="subforum-icon subforum-column center">
            <i class="fa-solid fa-circle-info"></i>
          </div>
          <div class="subforum-desc subforum-column"> <!-- Forum row 1 colum 2 -->
            <h2><a class="forumLink" href="#">Description title</a></h2>
            <p>General information about the forum.</p>
          </div>
          <div class="subforum-stats subforum-column">
            <span>XX Posts | XX Topics</span>
          </div>
          <div class="subforum-info subforum-column">
            <b><a class="forumLink" href="#">Last Post </a> by <a class="forumLink" href="#">User</a></b>
            <br>
            on <small>30 Oct 2024</small>
          </div>
          <!-- More forum -->
        </div>
      </div>
      <!-- Discussion Forum column -->
      <div class="subforum">
        <div class="subforum-title">
          <h1>Discussion topics</h1> <!-- Forum main row -->
        </div>
        <div class="subforum-row"> <!-- Subforum Linha -->
          <div class="subforum-icon subforum-column center">
            <i class="fa-solid fa-circle-info"></i>
          </div>
          <div class="subforum-desc subforum-column"> <!-- Forum row 1 colum 2 -->
            <h2><a class="forumLink" href="#">Description title</a></h2>
            <p>General information about the forum.</p>
          </div>
          <div class="subforum-stats subforum-column">
            <span>XX Posts | XX Topics</span>
          </div>
          <div class="subforum-info subforum-column">
            <b><a class="forumLink" href="#">Last Post </a> by <a class="forumLink" href="#">User</a></b>
            <br>
            on <small>30 Oct 2024</small>
          </div>
        </div>
        <!-- More forum row -->
        <div class="subforum-row"> <!-- Subforum Linha -->
          <div class="subforum-icon subforum-column center">
            <i class="fa-solid fa-circle-info"></i>
          </div>
          <div class="subforum-desc subforum-column"> <!-- Forum row 1 colum 2 -->
            <h2><a class="forumLink" href="#">Description title</a></h2>
            <p>General information about the forum.</p>
          </div>
          <div class="subforum-stats subforum-column">
            <span>XX Posts | XX Topics</span>
          </div>
          <div class="subforum-info subforum-column">
            <b><a class="forumLink" href="#">Last Post </a> by <a class="forumLink" href="#">User</a></b>
            <br>
            on <small>30 Oct 2024</small>
          </div>
        </div>
        <!-- More forum row -->
        <div class="subforum-row"> <!-- Subforum Linha -->
          <div class="subforum-icon subforum-column center">
            <i class="fa-solid fa-circle-info"></i>
          </div>
          <div class="subforum-desc subforum-column"> <!-- Forum row 1 colum 2 -->
            <h2><a class="forumLink" href="#">Description title</a></h2>
            <p>General information about the forum.</p>
          </div>
          <div class="subforum-stats subforum-column">
            <span>XX Posts | XX Topics</span>
          </div>
          <div class="subforum-info subforum-column">
            <b><a class="forumLink" href="#">Last Post </a> by <a class="forumLink" href="#">User</a></b>
            <br>
            on <small>30 Oct 2024</small>
          </div>
          <!-- FAQ forum column -->
        </div>
        <div class="subforum">
          <div class="subforum-title">
            <h1>Unipe FAQs topics</h1> <!-- Forum main row -->
          </div>
          <div class="subforum-row"> <!-- Subforum Linha -->
            <div class="subforum-icon subforum-column center">
              <i class="fa-solid fa-circle-info"></i>
            </div>
            <div class="subforum-desc subforum-column"> <!-- Forum row 1 colum 2 -->
              <h2><a class="forumLink" href="#">Description title</a></h2>
              <p>General information about the forum.</p>
            </div>
            <div class="subforum-stats subforum-column">
              <span>XX Posts | XX Topics</span>
            </div>
            <div class="subforum-info subforum-column">
              <b><a class="forumLink" href="#">Last Post </a> by <a class="forumLink" href="#">User</a></b>
              <br>
              on <small>30 Oct 2024</small>
            </div>
          </div>

        </div>


        <!-- Check de erro de login -->
        <?php
        if (isset($_SESSION['erro'])) {
          if ($_SESSION['erro'] == 1) {
            echo "<p>Usuário ou senha inválidos.</p>";
          } elseif ($_SESSION['erro'] == 2) {
            echo "<p>Por favor, faça login para acessar o conteúdo.</p>";
          } else {
            echo "<p>Erro desconhecido.</p>";
          }
        }
        ?>
      </div>
    </div>
  </div>
</body>


</html>