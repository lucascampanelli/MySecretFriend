<?php
    $v->layout("dashboardTheme");
?>

<div class='Panel'>
    <h1 class='sectionTitle'>Meus sorteios</h1>
    <center><div class='grupo'>
        <?php 
            foreach($grupo as $info): 
                if($info->cod_grupo == $id_grupo): 
                    $dateNow = new DateTime();
                    $dateRaffle = new DateTime($info->data_sorteio);
                    $difference = $dateRaffle->diff($dateNow);
                    if ($difference->days >= 10):
                        ?>
                        <span class='dateOccurrenceFar'>
                        <?php
                        echo $dateRaffle->format('d/m/Y');
                    elseif ($difference->days >= 5 && $difference->days < 10):
                        ?>
                        <span class='dateOccurrenceHalf'>
                        <?php
                        echo $dateRaffle->format('d/m/Y');
                    elseif ($difference->days < 5):
                        ?>
                        <span class='dateOccurrenceNear'>
                        <?php
                        echo $dateRaffle->format('d/m/Y');
                    endif;
                endif; 
            endforeach; 
        ?>
    </span>
    <h3 class='groupName'>
    <?php
        foreach($grupo as $info):
            if($info->cod_grupo == $id_grupo):
                echo $info->nome_grupo;
            endif;
        endforeach; 
    ?>
    </h3>
    <p class='descGrupo'>
    <?php 
        foreach($grupo as $info): 
            if($info->cod_grupo == $id_grupo): 
                echo $info->desc_grupo; 
            endif; 
        endforeach; 
    ?>
    </p>
    <div class='divPrices'>
    <span>Preço mínimo:
    <?php 
        foreach($grupo as $info): 
            if($info->cod_grupo == $id_grupo): 
                echo $info->preco_min;
            endif; 
        endforeach; 
    ?> ~
    </span>
    <span>Preço máximo:
    <?php 
        foreach($grupo as $info): 
            if($info->cod_grupo == $id_grupo): 
                echo $info->preco_max;
            endif; 
        endforeach; 
    ?>
    </span>
    </div>
    <span class='friendSpan'>Seu amigo é:</span>
    <span class='friend'>
    <?php 
        foreach($grupo as $info): 
            if($info->cod_grupo == $id_grupo): 
                foreach($amigo as $meuAmigo):
                    if($meuAmigo->email_user1 == $email):
                        echo $meuAmigo->nome_user2;
                    endif;
                endforeach;
            endif; 
        endforeach; 
    ?>
    </span>
    </div></center>
</div>