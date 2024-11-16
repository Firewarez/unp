<!DOCTYPE html>
<html lang="pt-br">
<?php

include('conexao.php');

$log_erro = '';
$senha_erro = '';
$sucesso = '';

$sql = "CREATE TABLE IF NOT EXISTS usuarios (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  user VARCHAR(255) NOT NULL UNIQUE,
  senha VARCHAR(255) NOT NULL
)";

if (mysqli_query($conexao, $sql)) {
  // Tabela criada com sucesso ou já existe
} else {
  echo "Erro ao criar a tabela: " . mysqli_error($conexao);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Recebe os dados do formulário
  $login = mysqli_real_escape_string($conexao, $_POST['nome']);
  $senha = $_POST['senha'];

  // Validação da senha
  if (strlen($senha) < 8) {
    $senha_erro = "A senha deve ter pelo menos 8 caracteres.";
  } else {
    // Criptografando a senha
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // Verificando se o e-mail já está cadastrado
    $sql = "SELECT * FROM usuarios WHERE user = '$login'";
    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($resultado) > 0) {
      $log_erro = "Este usuario já está registrado.";
    } else {
      // Inserindo o novo usuário no banco de dados
      $sql = "INSERT INTO usuarios (user, senha) VALUES ('$login', '$senha_hash')";

      if (mysqli_query($conexao, $sql)) {
        // Se o cadastro for bem-sucedido, exibe a mensagem de sucesso e redireciona para o login
        $sucesso = "Usuário registrado com sucesso! Você será redirecionado para a página de login.";
        // Redireciona para a página de login
        header("Location: logar.php");
        exit;  // Garantir que o código abaixo não seja executado
      }
    }
  }
}

?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Unp - Registre-se</title>
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
        <a class="logo-btn" href="../index.php"><img id="logo" src="../ui/img/logo-icon.png" height="50" width="50"></a>
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
              <li class="usr-stl"><a href="./web/perfil.php">Perfil</a></li>
              <li class="usr-stl"><a href="./web/logout.php">Sair</a></li>
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
        <h2>Register</h2>
        <?php if ($sucesso): ?>
          <p style="color: green;"><?php echo $sucesso; ?></p>
        <?php endif; ?>
        <div class="txt-field">
          <label>Usuario:</label>
          <input type="text" id="nome" name="nome" value="<?php echo isset($_POST['nome']) ? $_POST['nome'] : ''; ?>"
            placeholder="Usuario" required>
        </div>
        <?php if ($log_erro): ?>
          <p style="color: red;"><?php echo $log_erro; ?></p>
        <?php endif; ?>

        <div class="password-container txt-field">
          <label>Senha:</label>
          <input type="password" class="password-box" id="senha" name="senha" placeholder="senha" required>
          <i class="fa-regular fa-eye HideBt" id="PsBtn" onclick="PasswordHidden()"></i>
        </div>
        <?php if ($senha_erro): ?>
          <p style="color: red;"><?php echo $senha_erro; ?></p>
        <?php endif; ?>
        <button type="submit">Entrar</button>
        <div class="sigin-link">
          Já possui conta? <a href="logar.php">Faça Login</a>
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