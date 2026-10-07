<?php
if ($_SERVER['REQUEST_METHOD']=== 'POST') {
$usuarios = simplexml_load_file("usuarios.xml");
$novo = $usuarios->addChild("usuario");
$novo->addChild("nome", $_POST['nome']);
$novo->addChild("celular", $_POST['celular']);
$novo->addChild("email", $_POST['email']);
$novo->addChild("senha", md5($_POST['senha']));
$usuarios->asXML("usuarios.xml");
echo "<p style='color:#174a7e;'><strong>Usuário cadastrado com sucesso!</strong> <a href='login.php'>Fazer login</a></p>";
} else {
?>
    <style>
        body {
            background-color: #eef5fc;
            color: #24364b;
            font-family: Arial, sans-serif;
        }
        form {
            max-width: 360px;
            margin: 40px auto;
            padding: 24px;
            background-color: #ffffff;
            border: 1px solid #c8def2;
            border-radius: 10px;
        }
        h2 { color: #174a7e; }
        label { display: block; margin-top: 14px; }
        input {
            box-sizing: border-box;
            width: 100%;
            margin-top: 5px;
            padding: 9px;
            border: 1px solid #9bbbd9;
            border-radius: 5px;
        }
        button {
            margin-top: 18px;
            padding: 10px 16px;
            color: #ffffff;
            background-color: #1769aa;
            border: 0;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover { background-color: #0f4f85; }
    </style>
    <form method="post">
        <h2><strong>Crie sua conta</strong></h2>
        <label for="nome"><strong>Nome</strong></label>
        <input id="nome" type="text" name="nome" required>

        <label for="celular"><strong>Celular</strong></label>
        <input id="celular" type="text" name="celular" required>

        <label for="email"><strong>E-mail</strong></label>
        <input id="email" type="email" name="email" required>

        <label for="senha"><strong>Senha</strong></label>
        <input id="senha" type="password" name="senha" required>

        <button type="submit"><strong>Cadastrar</strong></button>
    </form>
<?php } ?>