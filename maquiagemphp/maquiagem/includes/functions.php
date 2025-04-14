<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'data.php';

// Função para verificar login
function checarAutenticacao()
{
    if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
        header('Location: login.php');
        exit;
    }
}

// Função para cadastrar um novo item
function adicionarNovoItem($item)
{
    if (!isset($_SESSION['catalogo_items'])) {
        $_SESSION['catalogo_items'] = [];
    }

    $_SESSION['catalogo_items'][] = $item;
    return true;
}

// Função para sanitizar entrada de dados
function sanitizar($dado)
{
    return htmlspecialchars(stripslashes(trim($dado)));
}

// Retorna todas as categorias disponíveis
function getCategorias()
{
    $itens = getItens();
    $categorias = [];

    foreach ($itens as $item) {
        if (!in_array($item['categoria'], $categorias)) {
            $categorias[] = $item['categoria'];
        }
    }

    return $categorias;
}

function getItens()
{
    global $catalogo_base;
    $itens = $catalogo_base;

    if (isset($_SESSION['catalogo_items']) && is_array($_SESSION['catalogo_items'])) {
        $id_final = max(array_keys($itens));

        foreach ($_SESSION['catalogo_items'] as $produto) {
            $id_final++;
            $itens[$id_final] = $produto;
        }
    }

    return $itens;
}

function getItemById($id)
{
    include('data.php');

    foreach ($itens as $item) {
        if ($item['id'] == $id) {
            return $item;
        }
    }

    return null;
}

function filtrarItensPorCategoria($categoria)
{
    $itens = getItens();
    $resultado = [];

    foreach ($itens as $id => $item) {
        if ($item['categoria'] == $categoria) {
            $resultado[$id] = $item;
        }
    }

    return $resultado;
}
