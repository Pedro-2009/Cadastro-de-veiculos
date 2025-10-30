<?php
require_once('functions.php');

$id = $_GET['id'] ?? null;

// Chama a função de exclusão exclusiva do módulo
delete_manutencao($id);