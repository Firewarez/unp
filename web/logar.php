<!DOCTYPE html>
<html lang="pt-br">
<?php
session_start();
include('conexao.php');

$erro = '';

// Verifica se o formulário de login foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Recebe os dados do formulário
  $login = mysqli_real_escape_string($conexao, $_POST['nome']);
  $senha = $_POST['senha'];

  // Consulta para verificar se o usuário existe no banco de dados
  $sql = "SELECT * FROM usuarios WHERE user = '$login'";
  $resultado = mysqli_query($conexao, $sql);

  // Verifica se o usuário foi encontrado
  if (mysqli_num_rows($resultado) == 1) {
    $usuario = mysqli_fetch_assoc($resultado);

    // Verifica se a senha informada corresponde à senha armazenada (usando password_verify)
    if (password_verify($senha, $usuario['senha'])) {
      // Se a senha estiver correta, cria a sessão para o usuário
      $_SESSION['usuario_id'] = $usuario['id'];
      $_SESSION['usuario_login'] = $usuario['user'];

      // Redireciona para a página principal (index.php)
      header("Location: ../index.php");
      exit;  // Para garantir que o código abaixo não seja executado
    } else {
      // Senha incorreta
      $erro = "E-mail ou senha incorretos.";
    }
  } else {
    // Usuário não encontrado
    $erro = "E-mail ou senha incorretos.";
  }
}


?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Unp - Login</title>
  <link rel="shortcut icon" type="imagex/png" href="../ui/img/logo-icon.png">
  <link rel="stylesheet" type="text/css" href="../UI/STATIC/logstyle.css">
  <link rel="stylesheet" type="text/css" href="../ui/static/style.css">
  <link rel="stylesheet" type="text/css" href="../ui/static/searchui.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <script src="https://kit.fontawesome.com/cbe388e870.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="../ui/js/scripts.js"></script>


</head>

<body>
  <div class="main">
    <div class="barra-navegacao">
      <!-- Navegação -->
      <div class="logo-img">
        <a class="logo-btn" href="../index.php"><img id="logo" src="../ui/img/logo-icon-yellow.png" height="50"
            width="50"></a>
      </div>
      <div class="search-container">
        <input type="text" id="search" class="search" placeholder="Pesquisar...">
        <a class="btn-search2"><i class="fa-solid fa-magnifying-glass" style="color: #000000;"></i></a>
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
              <li><a href="./web/perfil.php">Perfil</a></li>
              <li><a href="./web/logout.php">Sair</a></li>
            </ul>

          </div>
        <?php else: ?>
          <!-- Guest Login/Register -->
          <div class="login-btn-trigger">
            <a href="logar.php">Entrar</a>
          </div>
        <?php endif; ?>
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


    <div class="form-container">
      <!-- Formulário de login -->
      <form class="login-form" id="login-form" action="" method="post">
        <div class="sair-btn">
          <i class="fa-solid fa-arrow-left-long sair" onclick="location.href='../index.php';"></i>
        </div>
        <h2>Login</h2>
        <div class="txt-field">
          <label>Usuario:</label>
          <input type="text" id="nome" name="nome" placeholder="Usuario" required>
        </div>

        <div class="password-container txt-field">
          <label>Senha:</label>
          <input type="password" class="password-box" id="senha" name="senha" placeholder="senha" required>
          <i class="fa-regular fa-eye HideBt" id="PsBtn" onclick="PasswordHidden()"></i>
        </div>
        <?php if ($erro): ?>
          <p style="color: red; aligm-itens: center;"><?php echo $erro; ?></p>
        <?php endif; ?>
        <button class="Log-btn" type="submit">Entrar</button>
        <div class="sigin-link">
          Não possui conta? <a href="registro.php">Registre-se</a>
        </div>

      </form>
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

</body>


</html>