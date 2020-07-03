<?php
    $v->layout("homeTheme");
?>

<center><div class='formRecover'><form action=<?= url("recuperar/solicitacao"); ?> method='POST'>
    <span class='erro'><?php if(isset($erroRecuperacao))echo $erroRecuperacao; ?></span>
    <h1>Recuperar senha</h1>
    <h3>Informe o e-mail da conta que você deseja recuperar</h3>
    <input type='email' name='emailRecover' placeholder='E-mail '/>
    <input type='hidden' name='formRecoverPasswd' value=<?= sha1(uniqid(mt_rand(0, 7), true)) ?>/>
    <button type='submit' class='cadastroButton'>Recuperar</Button>
</form>
</div></center>