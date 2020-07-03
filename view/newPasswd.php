<?php
    $v->layout("homeTheme");
?>

<center><div class='formRecover'><form action=<?= url("recuperar/validado/$user/$token/sucesso"); ?> method='POST'>
    <span class='erro'><?php if(isset($erroRecuperacao))echo $erroRecuperacao; ?></span>
    <h1>Recuperar senha</h1>
    <h3>Escolha sua nova senha</h3>
    <input type='password' name='passwdRecover' placeholder='Senha '/>
    <input type='password' name='passwdRecoverConfirmation' placeholder='Confirme a senha '/>
    <button type='submit' class='cadastroButton'>Recuperar</Button>
</form>
</div></center>