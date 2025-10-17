<?php
// Inicia a sessão — deve ser a primeira coisa no script
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Caminho absoluto do arquivo de configuração
require_once __DIR__ . '/config.php';

// Aqui poderia ter a conexão com banco
require_once(DBAPI);

// Funções globais
require_once(HELPERS_PATH);