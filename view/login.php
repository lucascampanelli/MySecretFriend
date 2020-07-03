<?php
    $v->layout("homeTheme");
?>

<center><div class='formLogin'><form action=<?= url("entrar/autenticacao"); ?> method='post'>
    <span class='erro'><?php if(isset($erroLogin))echo $erroLogin; ?></span>
    <h1>Entre na sua conta</h1>
    <h3>E faça o melhor amigo secreto com o pessoal :)</h3>
    <input type='email' name='email' placeholder='E-mail '/>
    <input type='password' name='senha' placeholder='Senha '/>
    <span class='spanForgetPassword' onclick=<?= "window.location='".url("recuperar")."'"; ?>>Esqueci minha senha</span>
    <button type='submit' class='cadastroButton'>Entrar</Button>
</form>
</div></center>