<!DOCTYPE html>
<html lang="pt-br">
<?php
session_start();
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Unp - Inicio</title>
  <link rel="shortcut icon" type="imagex/png" href="./ui/img/logo-icon.png">
  <link rel="stylesheet" type="text/css" href="./ui/static/style.css">
  <link rel="stylesheet" type="text/css" href="./ui/static/indexcss.css">
  <link rel="stylesheet" type="text/css" href="./ui/static/searchui.css">
  <link rel="stylesheet" type="text/css" href="./ui/static/subforum.css">
  <link rel="stylesheet" type="text/css" href="./ui/static/footer.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="./ui/static/modal.css">
  <link rel="stylesheet" type="text/css" href="./ui/static/newscarousel.css">
  <script src="https://kit.fontawesome.com/cbe388e870.js" crossorigin="anonymous" defer></script>
  <script type="text/javascript" src="./ui/js/scripts.js" defer></script>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"
    defer></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"
    defer></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"
    defer></script>
</head>

<body>
  <div class="principal">
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
          <a href="./web/news.php"><i class="fa-regular fa-newspaper"></i></a>
        </div>
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
    <!-- Botão para acionar modal -->
    <button type="button" class="btn btn-primary topic-start" data-toggle="modal" data-target="#mod">
      <i class="fa-solid fa-plus"></i> Topico
    </button>
    <!-- Modal -->
    <div class="modal fade" id="mod" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Título do modal</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>insira as coisas aqui</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-primary">Salvar mudanças</button>
          </div>
        </div>
      </div>
    </div>

    <hr class="style1">
    <div class="slider">
      <div class="slides">
        <!-- Botoes -->
        <input type="radio" name="radio-btn" id="radio1">
        <input type="radio" name="radio-btn" id="radio2">
        <input type="radio" name="radio-btn" id="radio3">

        <!-- Imagens -->
        <div class="slide first">
          <img src="https://wallpapers.com/images/hd/full-hd-background-pyhnoors5l16248a.jpg" alt="" alt="imagem1">
        </div>
        <div class="slide second">
          <img src="https://i.pinimg.com/originals/c3/a5/b3/c3a5b332f9716abb1c67da38a12595e8.jpg" alt="" alt="imagem2">
        </div>
        <div class="slide second">
          <img
            src="https://wallpapers.com/images/hd/1920x1080-full-hd-nature-green-trees-and-gloomy-sky-5xolo1k9urujho0v.jpg"
            alt="" alt="imagem3">
        </div>

        <div class="nav-auto">
          <div class="auto-btn1"></div>
          <div class="auto-btn2"></div>
          <div class="auto-btn3"></div>
        </div>
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



        <script>
          document.querySelectorAll('.slider img').forEach(img => {
            img.addEventListener('click', function () {
              const newsId = this.getAttribute('data-news-id');
              fetchNewsContent(newsId);
            });
          });

          const modal = document.getElementById("newsModal");
          const span = document.getElementsByClassName("close")[0];

          span.onclick = function () {
            modal.style.display = "none";
          }

          window.onclick = function (event) {
            if (event.target == modal) {
              modal.style.display = "none";
            }
          }

          function fetchNewsContent(newsId) {
            // Simulate fetching news content based on newsId
            const newsContent = `Content for news ID: ${newsId}`;
            document.getElementById("modal-body").innerHTML = newsContent;
            modal.style.display = "block";
          }
        </script>
      </div>
</body>


</html>