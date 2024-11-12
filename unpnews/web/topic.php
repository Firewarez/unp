<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unp - New topic</title>
    <link rel="shortcut icon" type="imagex/png" href="../ui/img/logo-icon.png">
    <link rel="stylesheet" type="text/css" href="../ui/static/style.css">
    <link rel="stylesheet" type="text/css" href="../ui/static/searchui.css">
    <link rel="stylesheet" type="text/css" href="../ui/static/subforum.css">
    <script src="https://kit.fontawesome.com/cbe388e870.js" crossorigin="anonymous"></script>
    <script src=".ui/js/search.js"></script>
</head>

<body>
    <div class="main">
        <div class="barra-navegacao">
            <!-- Navegação -->
            <div class="logo-img">
                <a class="logo-btn" href="../index.php"><img id="logo" src="./ui/img/logo-icon.png" height="50"
                        width="50"></a>
            </div>
            <div class="search-container">
                <input type="text" id="search" class="search" placeholder="Pesquisar...">
                <label for="check" class="btn-search">
                    <i class="fa-solid fa-magnifying-glass" style="color: #000000;"></i>
                </label>
            </div>
        </div>

        <div class="input-type-topic">
            <form class="topic-type">
                <select name="subjects" class="subjects" required>
                    <option value="">Selecione um tópico</option>
                    <option value="general">Geral</option>
                    <option value="Cursos">Programação</option>
                </select>
            </form>
        </div>
    </div>
</body>

</html>