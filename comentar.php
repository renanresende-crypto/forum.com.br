<?php
session_start();
require_once __DIR__ . '/funções.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: listar.php');
    exit;
}

if (!csrfValido($_POST['csrf_token'] ?? null)) {
    encerrarComErro('Formulário expirado. Atualize a página e tente novamente.', 403);
}

$id = obterIndice($_POST['id'] ?? null);
$nome = $_POST['nome'] ?? null;
$mensagem = $_POST['mensagem'] ?? null;

if ($id === null || !is_string($nome) || !is_string($mensagem)) {
    encerrarComErro('Dados do comentário inválidos.');
}

$nome = trim($nome);
$mensagem = trim($mensagem);
if ($nome === '' || $mensagem === '') {
    encerrarComErro('Preencha o nome e o comentário.');
}

try {
    $topicos = carregarXml(ARQUIVO_TOPICOS, 'topicos');
    if (!isset($topicos->topico[$id])) {
        encerrarComErro('Tópico não encontrado.', 404);
    }

    if (!isset($topicos->topico[$id]->comentarios)) {
        $comentarios = $topicos->topico[$id]->addChild('comentarios');
    } else {
        $comentarios = $topicos->topico[$id]->comentarios;
    }

    $comentario = $comentarios->addChild('comentario');
    adicionarTextoXml($comentario, 'nome', $nome);
    adicionarTextoXml($comentario, 'mensagem', $mensagem);
    salvarXml($topicos, ARQUIVO_TOPICOS);

    $_SESSION['mensagem_sucesso'] = 'Comentário enviado com sucesso.';
    header('Location: listar.php');
    exit;
} catch (RuntimeException $excecao) {
    encerrarComErro($excecao->getMessage(), 500);
}
