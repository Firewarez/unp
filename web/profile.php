<?php
session_start();
include('conexao.php');
$auth = false;

if (!isset($_SESSION['usuario_id'])) {
  header('Location: logar.php');
  exit;
}

if (isset($_SESSION['usuario_id'])) {
  $auth = true;
}



$usuario_id = $_SESSION['usuario_id'];
$query = "SELECT p.*, u.user AS user FROM posts p
          JOIN usuarios u ON p.autor_id = u.id
          WHERE p.autor_id = ?";
          
$stmt = $conexao->prepare($query);
$stmt->bind_param("i", $usuario_id); // "i" indica que é um parâmetro inteiro
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Unp - Perfil</title>
  <link rel="shortcut icon" type="imagex/png" href="../ui/img/logo-icon-yellow.png">
  <link rel="stylesheet" type="text/css" href="../ui/static/style.css">
  <link rel="stylesheet" type="text/css" href="../ui/static/indexcss.css">
  <link rel="stylesheet" type="text/css" href="../ui/static/searchui.css">
  <link rel="stylesheet" type="text/css" href="../ui/static/subforum.css">
  <link rel="stylesheet" type="text/css" href="../ui/static/footer.css">
  <link rel="stylesheet" type="text/css" href="../ui/static/pfp.css">
  <script src="https://kit.fontawesome.com/cbe388e870.js" crossorigin="anonymous" defer></script>
  <script type="text/javascript" src="../ui/js/scripts.js" defer></script>
</head>

<body>
  <div class="inicio">
    <div class="barra-navegacao">
      <!-- Navegação -->
      <div class="logo-img">
        <a class="logo-btn" href="../index.php"><img id="logo" src="../ui/img/logo-icon-yellow.png" height="50"
            width="50"></a>
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
              <li class="usr-stl"><a href="profile.php">Perfil</a></li>
              <li class="usr-stl"><a href="logout.php">Sair</a></li>
            </ul>

          </div>
        <?php else: ?>
          <!-- Guest Login/Register -->
          <div class="login-btn-trigger">
            <a href="logar.php">Entrar</a>
          </div>
        <?php endif; ?>

      </div>
    </div>
    <div class="profile-info">
      <div class="profile-img">
        <i class="fa-regular fa-user-circle user-icon" style="color: black;"></i>
      </div>
      <div class="profile-data">
        <h2>Usuario <?php echo htmlspecialchars($_SESSION['usuario_login']); ?></h2>
      </div>

      <div class="profile-posts">
        <h2 style="background-color: #1f2933; padding: 5px;">Seus posts</h2>
        <?php
        // Exibe os posts do usuário
        if ($result->num_rows > 0) {
          while ($post = $result->fetch_assoc()) {
            ?>
            <div class="table-coluna">
              <div class="conteudo">
                <strong><a style="color: yellow;"
                    href="post.php?id=<?php echo $post['id']; ?>"><?php echo htmlspecialchars($post['titulo']); ?></a></strong>
                <br>
                <span><?php echo nl2br(htmlspecialchars($post['descricao'])); ?></span><br> <span>Iniciado por
                  <b><a
                      href="perfil.php?id=<?php echo $post['autor_id']; ?>"><?php echo htmlspecialchars($post['user']); ?></a></b></span>
              </div>
              <div class="replies">0 resposta <br> 0 views</div>
              <div class="last-reply">
                <?php echo date("M d", strtotime($post['data_criacao']));
                echo " as ";
                echo date("H:i", strtotime($post['data_criacao'])); ?>
                <br> Por <b><a
                    href="perfil.php?id=<?php echo $post['autor_id']; ?>"><?php echo htmlspecialchars($post['user']); ?></a></b>
              </div>
            </div>
            <hr>
            <?php
          }
        } else {
          echo "<p>Você ainda não fez nenhum post.</p>";
        }
        ?>
      </div>
    </div>
  </div>
  <footer>
    <div class="footer-content">
      <div class="descriptionfooter">
        <p>UNP Forum é um site de forum para alunos da UNP compartilharem informações e discutirem sobre diversos
          assuntos.</p>
      </div>
      <div class="contact">
        <a href="danielcostacarvalhomartins06@gmail.com">Email ✉ </a>
      </div>
    </div>
  </footer>
</body>

</html>