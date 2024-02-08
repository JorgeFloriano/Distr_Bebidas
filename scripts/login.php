<?php 
    //verifica se existe um erro na sessão
    $erro = $_SESSION['error'] ?? null;
    unset($_SESSION['error']);
?>
<form class="center" action="?rota=login_submit" method="post">
    <h1>J.M. Bebidas</h1>
    <label for="txtUsuario" >Login: </label>
    <input type="text" placeholder="Digite o nome" name="text_usuario" id="txtUsuario"required>
    <label for="txtSenha" >Senha:</label>
    <input type="password" placeholder="Digite a Senha" name="text_senha" id="txtSenha"required>
    <div>
        <button name="btn_login" type="submit">Entrar</button>
        <?php if (!empty($erro)): ?> 
            <div id="alert"><?=$erro?></div>
        <?php endif;?>
    </div>
</form>
