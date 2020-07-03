<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel='stylesheet' href=<?=url("view/assets/style.css")?>>
    <link rel="icon" href=<?=url("view/assets/images/favicon.ico")?>>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.1/css/all.css" integrity="sha384-xxzQGERXS00kBmZW/6qxqJPyxW3UR0BPsL4c8ILaIWXva5kFi7TxkIIaMiKtqV1Q" crossorigin="anonymous">
</head>
<body>
    <nav class='main_nav'>
        <ul>
        <a href=<?=url()?>><div>
                <h1 class='logo'></h1>
            </div></a>
            <li class='exitButton'><a href=<?=url("dashboard/sair")?>>SAIR</a></li>
            <li><a href=<?=url("sobre")?>>SOBRE</a></li>
            <li><a href=<?=url("comofunciona")?>>COMO FUNCIONA?</a></li>
            <li><a href=<?=url("dashboard/sortear")?>>SORTEAR</a></li>
            <li><a href=<?=url()?>>INÍCIO</a></li>
        </ul>
    </nav>

    <div class='leftPanel'>
    <ul>
        <a href=<?= url("dashboard/configuracoes") ?>><li class='nomePanel'><?php echo $nome_user ?></a></li>
        <hr>
        <a href=<?=url("dashboard")?>><li class='menuOptions'><i class="fas fa-users" id='icon'></i><div class='option'>Sorteios</a></div></li>
        <a href=<?= url("dashboard/configuracoes") ?>><li class='menuOptions'><i class="fas fa-cog" id='icon'></i><div class='option'>Opções</a></div></li>
    </ul>
    </div>

    <main class='main_content' id ='dashboard'>
        <?= $v->section("content"); ?>
    </main>

    <footer class='main_footer'>
    </footer>

    <script src=<?=url("script/jquery-3.5.1.min.js")?>></script>
    <script src=<?=url("script/jquery.maskMoney.min.js")?>></script>
    <?= $v->section("script"); ?>

    
</body>
</html>