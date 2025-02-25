<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    
    <link rel="stylesheet" href="../css/defaultStyles.css">
    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="../css/user.css">
    
    <title>Projeto CAENS - FEED</title>
</head>

<body>
    <header>
        <div class="logo">
            <a href="#"><img src="../src-images/logo_ifba_branco.png" alt="Instituto Federal Bahia"></a>
        </div>

        <nav>
            <button id="todos">TODOS</button>    
            <button id="achados">ACHADOS</button>
            <button id="perdidos">PERDIDOS</button>
            <button id="perdidos">REQUEST</button>
            <form id="logout" action="../php/logout.php" method="post">
                <a href="#"> <input type="submit" value="LOGOUT" id="logout"> </a>
            </form>
            <div class="user-info">
                <i class="fas fa-user"></i>
                <span>
                    <?php
                        session_start();
                        include '../php/funcoes_produtos.php';
                        echo 'Usuário: ' . htmlspecialchars($_SESSION['nome']);
                    ?>
                </span>
            </div>

        </nav>



    </header>   

    <main>
        <!-- Formulário de publicação -->
        <section class="post-section">
            <form action="../php/create_formulario.php" method="POST" id="internoBranco">
                <h2>COMPARTILHE AQUI:</h2>
                <input id="descricao" placeholder="Descreva o item perdido..." type="text" name="descricao" required>
                <input type="date" name="dataHora" id="dataHora" required>
                <select name="tipo" id="tipo" required>
                    <option value="1">Achado</option>
                    <option value="2">Perdido</option>
                </select>
                <button class="postButton" type="submit" name="create">ENVIAR</button>
            </form>
        </section>

        <!-- Produtos cadastrados -->
        <section class="produtos-cadastrados">
    <h2 id="titulo_produtos_cadastrados">PRODUTOS</h2>
    <div class="feed"> <!-- Container do feed -->

        <?php
        $tipo_consulta = $tipo_consulta ?? 3;
        $result = get_produtos($tipo_consulta);   

        foreach ($result as $linha) {
            $tipoTexto = match ($linha["tipo"]) {
                1 => 'Achado',
                2 => 'Perdido',
                default => 'Desconhecido',
            };

            echo '<div class="post">';
            echo '<p><strong>Descrição:</strong> ' . htmlspecialchars($linha["descricao"]) . '</p>';
            echo '<p><strong>Data e Hora:</strong> ' . htmlspecialchars($linha["dataHora"]) . '</p>';
            echo '<p class="tipo-item"><strong>Tipo:</strong> ' . $tipoTexto . '</p>';
            echo '</div>';
        }   
        ?>
    </div>
</section>

    </main>
    
    <script src= "../javascript/home.js"></script>
</body>

</html>
