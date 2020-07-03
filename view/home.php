<?php

    use Source\Models\User;

    $v->layout("homeTheme"); 

    $user = new user();
    /*if($user->find()->fetch()){
        echo "tem usuario!";
    }
    else{
        echo "não tem usuário!";
    }*/
?>


<center><div class='formCadastro'><form action=<?= url("cadastro"); ?> method='post'>
    <span class='erro'><?php if(isset($erroCadastro))echo $erroCadastro; ?></span>
    <h1>Cadastre-se</h1>
    <h3>Apenas esses dados e você sorteia com a galera :)</h3>
    <input type='text' name='nome' placeholder='Insira seu nome '/>
    <input type='text' name='sobrenome' placeholder='Insira seu sobrenome '/>
    <input type='email' name='email' placeholder='Insira seu e-mail '/>
    <input type='password' name='senha' placeholder='Insira sua senha '/>
    <input type='password' name='senhaConfirm' placeholder='Confirme sua senha '/>
    <button type='submit' class='cadastroButton'>Cadastrar</Button>
    <hr>
    <h4>Já se cadastrou? Faça login!</h4>
</form>
    <a href=<?= url("entrar"); ?>><button class='loginButton'>Entrar</button></a>
</div></center>


<?php $v->start("script"); ?>
<?php $v->end(); ?>