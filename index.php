<?php
session_start();
include('./web/conexao.php');
$auth = false;

if (isset($_SESSION['usuario_id'])) {
  $auth = true;
}

$titulo = $descricao = '';
$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Receber dados do formulário
  $titulo = $_POST['titulo'];
  $descricao = $_POST['descricao'];
  $autor_id = $_SESSION['usuario_id']; // ID do autor é o usuário logado

  // Validar se os campos estão preenchidos
  if (empty($titulo) || empty($descricao)) {
    $erro = "Título e descrição são obrigatórios!";
  } else {
    // Inserir no banco de dados
    $sql = "INSERT INTO posts (titulo, descricao, autor_id, data_criacao) 
              VALUES (?, ?, ?, NOW())";

    $stmt = $conexao->prepare($sql);
    $stmt->bind_param('ssi', $titulo, $descricao, $autor_id);

    if ($stmt->execute()) {
      header("Location: index.php"); // Redireciona de volta para a página principal
      exit();
    } else {
      $erro = "Erro ao adicionar o post.";
    }
  }
}

$sql = "SELECT COUNT(*) as total_posts FROM posts";
$result = $conexao->query($sql);

// Verifica se a consulta retornou resultados
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_posts = $row['total_posts'];
} else {
    $total_posts = 0;
}

$sql_last_post = "SELECT p.data_criacao, u.user
                  FROM posts p 
                  JOIN usuarios u ON p.autor_id = u.id 
                  ORDER BY p.data_criacao DESC 
                  LIMIT 1";
$result_last_post = $conexao->query($sql_last_post);

// Verifica se a consulta retornou resultados
if ($result_last_post->num_rows > 0) {
    $row_last_post = $result_last_post->fetch_assoc();
    $last_post_date = $row_last_post['data_criacao'];
    $last_post_user = $row_last_post['user'];
} else {
    $last_post_date = 'N/A';
    $last_post_user = 'N/A';
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Unp - Inicio</title>
  <link rel="shortcut icon" type="imagex/png" href="./ui/img/logo-icon-yellow.png">
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
  <script type="text/javascript" src="./ui/js/news.js" defer></script>
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
  <script>
    const isAuthenticated = <?php echo json_encode($auth); ?>;
  </script>
  <link rel="stylesheet" type="text/css" href="./ui/static/arrumarA.css">
</head>

<body>
  <div class="principal">
    <div class="barra-navegacao">
      <!-- Navegação -->
      <div class="logo-img">
        <a class="logo-btn" href="index.php"><img id="logo" src="./ui/img/logo-icon-yellow.png" height="50"
            width="50"></a>
      </div>
      <div class="search-container">
        <input type="text" id="search" class="search" placeholder="Pesquisar...">
        <a class="btn-search"><i class="fa-solid fa-magnifying-glass" style="color: #000000;"></i></a>

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
              <li class="usr-stl"><a href="./web/profile.php">Perfil</a></li>
              <li class="usr-stl"><a href="./web/logout.php">Sair</a></li>
            </ul>

          </div>
        <?php else: ?>
          <!-- Guest Login/Register -->
          <div class="login-btn-trigger">
            <a href="./web/logar.php">Entrar</a>
          </div>
        <?php endif; ?>
      </div>



    </div>
    <div id="search-results" class="search-results"></div>
    <!-- Botão para acionar modal -->
    <button type="button" class="btn btn-primary topic-start" id="modal-btn" data-toggle="modal" data-target="#mod">
      <i class="fa-solid fa-plus"></i> Post
    </button>

    <!-- Modal -->
    <div class="modal fade" id="mod" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Criação de Post</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <?php if ($erro): ?>
              <div class="alert alert-danger">
                <?php echo $erro; ?>
              </div>
            <?php endif; ?>

            <form method="POST" action="#">
              <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" id="titulo" name="titulo" class="form-control"
                  value="<?php echo htmlspecialchars($titulo); ?>" required>
              </div>

              <div class="form-group">
                <label for="descricao">Descrição</label>
                <textarea id="descricao" name="descricao" class="form-control" rows="4"
                  required><?php echo htmlspecialchars($descricao); ?></textarea>
              </div>

              <button type="submit" class="btn btn-primary">Adicionar Post</button>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          </div>
        </div>
      </div>
    </div>
<br>
    <div class="slider">
      <div class="slides">
        <!-- Botoes -->
        <input type="radio" name="radio-btn" id="radio1">
        <input type="radio" name="radio-btn" id="radio2">
        <input type="radio" name="radio-btn" id="radio3">

        <!-- Imagens -->
        <div class="slide first">
          <img src="ui/img/not1.png" alt="Noticia 1">
        </div>
        <div class="slide second">
          <img src="ui/img/not2.png" alt="Noticia 2">
        </div>
        <div class="slide tird">
          <img src="ui/img/not3.png" alt="Noticia 3">
        </div>

        <div class="nav-auto">
          <div class="auto-btn1"></div>
          <div class="auto-btn2"></div>
          <div class="auto-btn3"></div>
        </div>
      </div>

      <div class="manual-navigation">
        <label for="radio1" class="manual-btn"></label>
        <label for="radio2" class="manual-btn"></label>
        <label for="radio3" class="manual-btn"></label>
      </div>


    </div>
    <hr class="slash-3">
    <!-- Main Content -->
    <div class="container">
      <!-- Forum main content container -->
      <div class="subforum">
        <div class="subforum-title">
          <h1>Informações gerais</h1> <!-- Forum main row -->
        </div>
        <div class="subforum-row"> <!-- Subforum Linha -->
          <div class="subforum-icon subforum-column center">
            <i class="fa-solid fa-circle-info"></i>
          </div>
          <div class="subforum-desc subforum-column news-column"> <!-- Forum row 1 colum 2 -->
            <h2><a class="forumLink" href="https://novoportal.cruzeirodosul.edu.br/home/6">Oportunidade única!</a></h2>
            <p>Atencipe a rematricula e pague em parcelas que cabem no seu bolso. <b style="color: yellow;">Novembro</b> e <b style="color: yellow;">Dezembro</b> +
              <b style="color: yellow;"> Rematricula de 2025.1</b> em até 6x no cartão, sem juros. Área do Aluno > Financeiro > Combo
              Rematrícula 2025.1
            </p>
          </div>

          <!-- More forum -->
        </div>
      </div>
      <!-- Discussion Forum column -->
      <div class="subforum">
        <div class="subforum-title">
          <h1>Topicos sobre cursos</h1> <!-- Forum main row -->
        </div>
        <div class="subforum-row"> <!-- Subforum Linha -->
          <div class="subforum-icon subforum-column center">
            <i class="fa-solid fa-book"></i>
          </div>
          <div class="subforum-desc subforum-column"> <!-- Forum row 1 colum 2 -->
            <h2><a class="forumLink" href="web/posts.php">Info - TI</a></h2>
            <p>Informações e perguntas relacionadas aos cursos de TI.</p>
          </div>
          <div class="subforum-stats subforum-column">
            <span><?php echo $total_posts; ?> Posts</span>
          </div>
          <div class="subforum-info subforum-column">
            <b><a class="forumLink" href="#">Ultima postagem </a> por <a class="forumLink" href="web/profile.php"><?php echo $last_post_user; ?></a></b>
            <br>
            em <small><?php echo $last_post_date; ?></small>
          </div>
        </div>
        <!-- More forum row -->
        <div class="subforum-row"> <!-- Subforum Linha -->
          <div class="subforum-icon subforum-column center">
            <i class="fa-solid fa-book"></i>
          </div>
          <div class="subforum-desc subforum-column"> <!-- Forum row 1 colum 2 -->
            <h2><a class="forumLink" href="web/posts.php">Info - Direito</a></h2>
            <p>Informações e perguntas relacionadas aos cursos de Direito.</p>
          </div>
          <div class="subforum-stats subforum-column">
            <span><?php echo $total_posts; ?> Posts</span>
          </div>
          <div class="subforum-info subforum-column">
            <b><a class="forumLink" href="#">Ultima postagem </a> por <a class="forumLink" href="web/profile.php"><?php echo $last_post_user; ?></a></b>
            <br>
            em <small><?php echo $last_post_date; ?></small>
          </div>
        </div>
        <!-- More forum row -->
        <div class="subforum-row"> <!-- Subforum Linha -->
          <div class="subforum-icon subforum-column center">
            <i class="fa-solid fa-book"></i>
          </div>
          <div class="subforum-desc subforum-column"> <!-- Forum row 1 colum 2 -->
            <h2><a class="forumLink" href="web/posts.php">Info - Saude</a></h2>
            <p>Informações e perguntas relacionadas aos cursos de Saude.</p>
          </div>
          <div class="subforum-stats subforum-column">
            <span><?php echo $total_posts; ?> Posts</span>
          </div>
          <div class="subforum-info subforum-column">
            <b><a class="forumLink" href="#">Ultima postagem </a> por <a class="forumLink" href="web/profile.php"><?php echo $last_post_user; ?></a></b>
            <br>
            em <small><?php echo $last_post_date; ?></small>
          </div>
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

    <script>
      document.getElementById('search').addEventListener('input', function () {
        const query = this.value.toLowerCase(); // Captura o que foi digitado
        const searchResultsContainer = document.getElementById('search-results');

        if (query === '') {
          searchResultsContainer.style.display = 'none';
          return; // Não continua a execução do código
        }

        // Lista de tópicos do fórum, você pode usar PHP para gerar isso dinamicamente do banco de dados
        const forums = [
          {
            title: 'Info - TI',
            description: 'Informações e perguntas relacionadas aos cursos de TI.',
            url: 'web/posts.php'  // URL da página específica do fórum de TI
          },
          {
            title: 'Info - Direito',
            description: 'Informações e perguntas relacionadas aos cursos de Direito.',
            url: 'web/posts.php'  // URL da página específica do fórum de Direito
          },
          {
            title: 'Info - Saúde',
            description: 'Informações e perguntas relacionadas aos cursos de Saúde.',
            url: 'web/posts.php'  // URL da página específica do fórum de Saúde
          },
          {
            title: 'Info - Marketing',
            description: 'Discussões sobre estratégias de marketing.',
            url: 'web/posts.php'  // URL da página específica do fórum de Marketing
          }
        ];

        // Filtra os itens com base na busca
        const filteredForums = forums.filter(forum =>
          forum.title.toLowerCase().includes(query) ||
          forum.description.toLowerCase().includes(query)
        );

        // Limpa os resultados anteriores
        searchResultsContainer.innerHTML = '';

        // Exibe os resultados
        if (filteredForums.length > 0) {
          filteredForums.forEach(forum => {
            const resultItem = document.createElement('div');
            resultItem.classList.add('search-item');

            // Criar o link de redirecionamento
            const link = document.createElement('a');
            link.href = forum.url;  // Link para a página do fórum
            link.innerHTML = `<strong>${forum.title}</strong><br><small>${forum.description}</small>`;
            resultItem.appendChild(link);

            // Adiciona o item ao container de resultados
            searchResultsContainer.appendChild(resultItem);
          });

          // Exibe a caixa de resultados
          searchResultsContainer.style.display = 'block';
        } else {
          // Se não houver resultados, esconde a caixa
          searchResultsContainer.style.display = 'none';
        }
      });
    </script>

    <footer>
      <div class="footer-content">
        <div class="descriptionfooter">
          <p>UNP Forum é um site de forum para alunos da UNP compartilharem informações e discutirem sobre diversos assuntos.</p>
        </div>
          <div class="contact">
            <a href="danielcostacarvalhomartins06@gmail.com">Email ✉ </a>
          </div>
      </div>
    </footer>
  </div>
</body>


</html>