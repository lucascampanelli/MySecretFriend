<?php $v->layout("dashboardTheme"); 
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__."\..");
    $dotenv->load();
?>

<div class='Panel'>
    <h1 class='sectionTitle'>Sorteio</h1>
    <center><div class='cardRaffles'>
        <form action=<?= url("dashboard/criar"); ?> method='POST'>
            <span class='erro'><?php if(isset($erroCriacao))echo $erroCriacao; ?></span>
            <h1>Criando um grupo</h1>
            <h3>Fale um pouco sobre o seu grupo para sortear</h3>
            <input type='text' name='nome_grupo' placeholder='Dê um nome para o seu grupo'>
            <input type='text' name='desc_grupo' placeholder='Descreva o seu grupo'>
            <h3 id='label'>Quando será o sorteio?</h3>
            <input type='date' name='data_sorteio' placeholder='Quando será o sorteio?'>
            <h3 id='label'>Qual o preço mínimo para o sorteio?</h3>
            <input type='text' name='preco_min' placeholder='R$ 0,00' data-prefix='R$ ' data-affixes-stay="true" data-thousands="." data-decimal="," id='preco_min' maxlength='11'>
            <h3 id='label'>Qual o preço máximo para o sorteio?</h3>
            <input type='text' name='preco_max' placeholder='R$ 0,00' data-prefix='R$ ' data-affixes-stay="true" data-thousands="." data-decimal="," id='preco_max' maxlength='15'>
            <h3 class='friendsAddSpan'>Agora insira os seus amigos ao grupo</h3>
            <div class='create'>Adicionar pessoa</div>
            <div class='remove'>Remover pessoa</div>
            <input type='hidden' class='qnt_pessoas' name='qnt_pessoas' value=0>
            <button type='submit' class='buttonCreate'>Criar</button>
        </form>
    </div></center>
</div>

<?php $v->start("script"); ?>
    <script>
        $(document).ready(function(){
        $("#preco_min").maskMoney();
        $("#preco_max").maskMoney();
        $(".remove").hide();
        var $qnt = 0;
        var $alert = false;

        $(".remove").click(function(){
            $(".pessoa"+$qnt).remove();
            $(".email"+$qnt).remove();
            $(".linha"+$qnt).remove();
            $qnt--;
            $(".qnt_pessoas").replaceWith("<input type='hidden' class='qnt_pessoas' name='qnt_pessoas' value="+$qnt+">");
            if($qnt == 0){
                $(".remove").hide();
            }
        });

        $(".create").click(function(){
            $qnt++;
            if($qnt <= 100){
                if($qnt == 1){
                    $(".remove").show();
                }
                $(".qnt_pessoas").replaceWith("<input type='hidden' class='qnt_pessoas' name='qnt_pessoas' value="+$qnt+">");
                $(".remove").before("<input type='text' class='pessoa"+$qnt+"' name='pessoa[]' placeholder='Qual o nome da "+$qnt+"° pessoa?'>");
                $(".remove").before("<input type='email' class='email"+$qnt+"' name='email[]' placeholder='Qual o email da "+$qnt+"° pessoa?'>");
                $(".remove").before("<hr class='linha"+$qnt+"'>");
            }
            else{
                $alert = true;
            }


            if($alert == false && $qnt > 99){
                $(".create").after("<h3 class='limitAlert'>O limite de 100 pessoas para o sorteio foi atingido :(</h3>");
                $alert = true;
            }
        });
        });
    </script>
<?php $v->end(); ?>