<?php

/** Remove todas as mensagens armazenadas em uma sessão **/
function clear_messages() {
    if (isset($_SESSION['messages'])) {
        unset($_SESSION['messages']);
        unset($_SESSION['type']);
    }
}

/* Função para verificar o acesso e nível de acesso */
function requireAccess($roles = null) {
    if (!isset($_SESSION['user'])) {
        error_log("requireAccess: usuário não logado, redirecionando para " . LOGIN_URL);
        header('Location: ' . LOGIN_URL);
        exit;
    }

    if ($roles === null || (is_array($roles) && empty($roles))) {
        return; // Acesso liberado para qualquer usuário logado
    }

    $userRole = $_SESSION['user']['access_level'] ?? '';

    if (is_array($roles)) {
        if (!in_array($userRole, $roles)) {
            die("Acesso negado!");
        }
    } else {
        if ($userRole !== $roles) {
            die("Acesso negado!");
        }
    }
}


/* Função para ajustar o formato do telefone */
function formataTelefone($number) {
    // Remove tudo que não for número
    $number = preg_replace('/\D/', '', $number);

    // Verifica o tamanho para definir se é telefone fixo ou celular
    if (strlen($number) === 10) {
        // Formato fixo: (00)0000-0000
        return "(".substr($number, 0, 2).")".substr($number, 2, 4)."-".substr($number, 6, 4);
    } elseif (strlen($number) === 11) {
        // Formato celular: (00)00000-0000
        return "(".substr($number, 0, 2).")".substr($number, 2, 5)."-".substr($number, 7, 4);
    } else {
        // Retorna o número como está se não tiver 10 ou 11 dígitos
        return $number;
    }
}


/* Função para ajustar o formato do CEP */
function formataCEP($number) {
    $number = substr($number,0,2).".".substr($number,2,-3)."-".substr($number,-3);
    return $number;
}

/* Formatar apenas data */
function formatDateForView($date) {
    if (!empty($date) && $date != '0000-00-00') {
        return date('d/m/Y', strtotime($date));
    }
    return '';
}

/* Formatar data e hora */
function formatDateTimeForView($datetime) {
    if (!empty($datetime) && $datetime != '0000-00-00 00:00:00') {
        return date('d/m/Y H:i:s', strtotime($datetime));
    }
    return '';
}
