<?php
session_start();
if ($_SERVER['REQUEST_METHOD']=== 'POST') {
    $usuarios = simplexml_load_file("usuarios.xml");
    foreach ($usuarios->usuario as $u) {
        if ($u->email == $_POST['email'] && $u->senha == md5($_POST['senha'])) {
            $_SESSION['usuario'] = (string)$u->nome;
            echo "<p style='color:#174a7e;'><strong>Login realizado com sucesso!</strong> <a href='criar_topico.php'>Criar tópico</a></p>";
            exit;
        }
    }
    echo "<p style='color:#b42318;'><strong>Login inválido.</strong></p>";
} else {
?>
    <style>
        body { background:#eef5fc; color:#24364b; font-family:Arial,sans-serif; }
        form { max-width:340px; margin:40px auto; padding:24px; background:#fff; border:1px solid #c8def2; border-radius:10px; }
        h2 { color:#174a7e; }
        label { display:block; margin-top:14px; }
        input { box-sizing:border-box; width:100%; margin-top:5px; padding:9px; border:1px solid #9bbbd9; border-radius:5px; }
        button { margin-top:18px; padding:10px 16px; color:#fff; background:#1769aa; border:0; border-radius:5px; cursor:pointer; }
        button:hover { background:#0f4f85; }
    </style>
    <form method="post">
        <h2><strong>Entrar na conta</strong></h2>
        <label for="email"><strong>E-mail</strong></label>
        <input id="email" type="email" name="email" required>
        <label for="senha"><strong>Senha</strong></label>
        <input id="senha" type="password" name="senha" required>
        <button type="submit"><strong>Entrar</strong></button>
    </form>
<?php } ?>