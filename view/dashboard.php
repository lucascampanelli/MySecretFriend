<?php
    $v->layout("dashboardTheme");
?>

<div class='Panel'>
    <h1 class='sectionTitle'>Dashboard</h1>
    <center><div class='cardRaffles'>
       <h3 class='subtitles'>Meus sorteios</h3><center>
       <?php
        if(isset($grupo)):
            foreach($grupo as $sorteio):
                ?>
                    <div class='grupo' onclick=<?= "window.location='".url("dashboard/grupo/".$sorteio->cod_grupo)."'";?>>
                        <h2><?= $sorteio->nome_grupo; ?></h2>
                        <?= $sorteio->desc_grupo; ?>
                    </div>
                <?php
            endforeach;
        else:
            ?>
            Aqui aparecerá todos os seus grupos e sorteios
        </center>
        <?php
        endif;
       ?>
    </div>
    <div class='cardRaffles'>
        <h3 class='subtitles'>Que tal sorteiar um novo amigo secreto?</h3>
            <center><button class='loginButton' onclick=<?= "window.location='".url("dashboard/sortear")."'"; ?>><div class='buttonText'><p>Criar</p></div><i class="fas fa-plus" id='iconButton'></i><center></button>
    </div>
    <div class='cardRaffles'>
        <h3 class='subtitles'>Foi convidado para um grupo?</h3>
        <form action=<?=url("dashboard/entrar");?> method='POST'>
            <span class='erro'><?php if(isset($falhaEntrar))echo $falhaEntrar; ?></span>
            <input type='text' name='groupIdentification' class='groupIdentificationSignin' placeholder='Código do grupo'/><div class='underlineField'></div>
            <center><button class='loginButton' onclick=<?= "window.location='".url("dashboard/sortear")."'"; ?>><div class='buttonText'><p>Entrar</p></div><i class="fas fa-sign-in-alt" id='iconButton'></i></i><center></button>
        </form>
    </div>
    </center>
</div>