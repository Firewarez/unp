<?php
session_start();
include('conexao.php');
$auth = false;

if (isset($_SESSION['usuario_id'])) {
    $auth = true;
}

$searchQuery = '';
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $searchQuery = $_GET['search'];
}

$sql = "SELECT * FROM posts p 
        JOIN usuarios u ON p.autor_id = u.id 
        WHERE p.titulo LIKE ? OR p.descricao LIKE ?
        ORDER BY p.data_criacao DESC";

// Prepara a consulta para evitar SQL Injection
$stmt = $conexao->prepare($sql);

//  busca por título ou descrição
$searchTerm = "%$searchQuery%";
$stmt->bind_param("ss", $searchTerm, $searchTerm);

$stmt->execute();
$result = $stmt->get_result();

$titulo = $descricao = '';
$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $autor_id = $_SESSION['usuario_id']; // ID é o codigo de login de cada user
    $login = $_SESSION['usuario_login'];

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
            header("Location: posts.php"); // Redireciona de volta para a página principal
            exit();
        } else {
            $erro = "Erro ao adicionar o post.";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unp - Posts</title>
    <link rel="shortcut icon" type="imagex/png" href="../ui/img/logo-icon-yellow.png">
    <link rel="stylesheet" type="text/css" href="../ui/static/style.css">
    <link rel="stylesheet" type="text/css" href="../ui/static/indexcss.css">
    <link rel="stylesheet" type="text/css" href="../ui/static/searchui.css">
    <link rel="stylesheet" type="text/css" href="../ui/static/subforum.css">
    <link rel="stylesheet" type="text/css" href="../ui/static/footer.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../ui/static/modal.css">
    <script src="https://kit.fontawesome.com/cbe388e870.js" crossorigin="anonymous" defer></script>
    <script type="text/javascript" src="../ui/js/postscript.js" defer></script>
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
    <link rel="stylesheet" type="text/css" href="../ui/static/arrumarA.css">
</head>

<body>
    <div class="principal">
        <div class="barra-navegacao">
            <!-- Navegação -->
            <div class="logo-img">
                <a class="logo-btn" href="../index.php"><img id="logo" src="../ui/img/logo-icon-yellow.png" height="50"
                        width="50"></a>
            </div>
            <div class="search-container">
                <form method="GET" action="posts.php" class="postsearch">
                    <input type="text" id="search" name="search" class="search" placeholder="Pesquisar..."
                        value="<?php echo htmlspecialchars($searchQuery); ?>">
                </form>
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
        <!-- Botão para acionar modal -->
        <button type="button" class="btn btn-primary topic-start" id="modal-btn" data-toggle="modal" data-target="#mod">
            <i class="fa-solid fa-plus"></i> Post
        </button>

        <!-- Modal -->
        <div class="modal fade" id="mod" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
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

        <!-- Exibir posts -->
        <div class="container">
            <div class="navigate">
                <span><a href="../index.php">Home</a> - <a href="#">Forum Geral</a></span>
            </div>
            <?php if ($result->num_rows > 0): ?>
                <div class="posts-table">
                    <div class="table-head">
                        <div class="status">Tipo</div>
                        <div class="objetivos">Conteudo</div>
                        <div class="replies">Respostas</div>
                        <div class="last-reply">Última postagem</div>
                    </div>
                    <?php while ($post = $result->fetch_assoc()): ?>
                        <div class="table-row">
                            <div class="status"><i class="fa fa-book"></i></div>
                            <div class="objetivos">
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
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <p>Nenhum post encontrado.</p>
            <?php endif; ?>
        </div>
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