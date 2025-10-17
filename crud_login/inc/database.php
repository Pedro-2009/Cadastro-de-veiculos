<?php 
mysqli_report(MYSQLI_REPORT_STRICT);

/* Abre conexão com o banco de dados */
function open_database() {
    try {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if ($conn->connect_error) {
            throw new Exception("Erro de conexão: " . $conn->connect_error);
        }
        return $conn;
    } catch (Exception $e) {
        die($e->getMessage());
    }
}

/* Fecha conexão com o banco */
function close_database($conn) {
    try {
        mysqli_close($conn);
    } catch (Exception $e) {
        die($e->getMessage());
    }
}

/* Pesquisa um Registro pelo ID em uma Tabela */
function find( $table = null, $id = null ) {
    $database = open_database();
    $found = null;

    try {
        if ($id) {
            $sql = "SELECT * FROM " . $table . " WHERE id = " . $id;
            $result = $database->query($sql);

            if ($result->num_rows > 0) {
                $found = $result->fetch_assoc();
            }  
        } else {  
            $sql = "SELECT * FROM " . $table;
            $result = $database->query($sql);

            if ($result->num_rows > 0) {
                $found = $result->fetch_all(MYSQLI_ASSOC);
            }
        }
    } catch (Exception $e) {
        $_SESSION['messages'] = $e->GetMessage();
        $_SESSION['type'] = 'danger';
    }
    close_database($database);
    return $found;
}

/* Pesquisa Todos os Registros de uma Tabela */
function find_all( $table ) {
  return find($table);
}

/**
 * Busca todos os registros de uma tabela com JOINs opcionais
 *
 * @param string $table      Tabela principal
 * @param int    $id         ID do registro específico (opcional)
 * @param array  $joins      Array de joins [['table'=>'categories','on'=>'products.category_id = categories.id']]
 * @param string $select     Campos a selecionar, padrão '*'
 * @param string $where      Condição WHERE opcional, ex: "products.active = 1"
 * @param string $order      ORDER BY opcional, ex: "products.name ASC"
 * @return array             Resultados como array associativo
 */
function find_with_joins($table, $id = null, $joins = [], $select = '*') {
    $database = open_database();
    $found = null;

    try {
        // Monta JOINs
        $joinSql = '';
        foreach ($joins as $join) {
            // cada $join é um array: ['table' => 'categories', 'on' => 'products.category_id = categories.id']
            $joinSql .= " LEFT JOIN {$join['table']} ON {$join['on']} ";
        }

        // Monta WHERE
        $whereSql = $id ? " WHERE {$table}.id = {$id}" : '';

        // Monta a query final
        $sql = "SELECT $select FROM $table $joinSql $whereSql";

        $result = $database->query($sql);

        if ($result->num_rows > 0) {
            $found = $id ? $result->fetch_assoc() : $result->fetch_all(MYSQLI_ASSOC);
        }
    } catch (Exception $e) {
        $_SESSION['messages'] = $e->getMessage();
        $_SESSION['type'] = 'danger';
    }

    close_database($database);
    return $found;
}

/**
 * Busca todos os registros de uma tabela com JOINs opcionais
 *
 * @param string $table      Tabela principal
 * @param array  $joins      Array de joins [['table'=>'categories','on'=>'products.category_id = categories.id']]
 * @param string $select     Campos a selecionar, padrão '*'
 * @param string $where      Condição WHERE opcional, ex: "products.active = 1"
 * @param string $order      ORDER BY opcional, ex: "products.name ASC"
 * @return array             Resultados como array associativo
 */
function find_all_with_joins($table, $joins = [], $select = '*', $where = '', $order = '') {
    $database = open_database();
    $found = [];

    try {
        // Monta JOINs
        $joinSql = '';
        foreach ($joins as $join) {
            $joinSql .= " LEFT JOIN {$join['table']} ON {$join['on']} ";
        }

        // Monta WHERE
        $whereSql = $where ? " WHERE $where " : '';

        // Monta ORDER BY
        $orderSql = $order ? " ORDER BY $order " : '';

        // Query final
        $sql = "SELECT $select FROM $table $joinSql $whereSql $orderSql";

        $result = $database->query($sql);

        if ($result->num_rows > 0) {
            $found = $result->fetch_all(MYSQLI_ASSOC);
        }
    } catch (Exception $e) {
        $_SESSION['messages'] = $e->getMessage();
        $_SESSION['type'] = 'danger';
    }

    close_database($database);
    return $found;
}


/* Formata a Data para o formato brasileiro */
function formatDateForMySQL($date) {
    $dateObj = DateTime::createFromFormat('d/m/Y', $date);
    return $dateObj ? $dateObj->format('Y-m-d') : $date;
}

/* Insere um registro no BD */
function save($table = null, $data = null) {
    $database = open_database();

    // Remove campos que não existem na tabela
    if (isset($data['confirm_password'])) {
        unset($data['confirm_password']);
    }

    $columns = [];
    $values = [];

    foreach ($data as $key => $value) {

        if (stripos($key, 'date') !== false && !empty($value)) {
            $value = formatDateForMySQL($value);
        }

        // Escapar valor para evitar problemas de aspas e SQL injection
        $escaped_value = $database->real_escape_string($value);

        $columns[] = trim($key, "'");
        $values[] = "'$escaped_value'";
    }

    $columns_str = implode(',', $columns);
    $values_str = implode(',', $values);

    $sql = "INSERT INTO $table ($columns_str) VALUES ($values_str);";

    // DEBUG
    // echo "<pre>DEBUG SQL: $sql</pre>";
    // die();  

    try {
        $database->query($sql);

        $_SESSION['messages'] = 'Registro cadastrado com sucesso.';
        $_SESSION['type'] = 'success';
    } catch (Exception $e) {
        $_SESSION['messages'] = 'Não foi possível realizar a operação.';
        $_SESSION['type'] = 'danger';
    }
    close_database($database);
}

/* Atualiza um registro em uma tabela, por ID */
function update($table = null, $id = 0, $data = null) {
    $database = open_database();
    $items = null; 

    foreach ($data as $key => $value) {
        if (stripos($key, 'date') !== false && !empty($value)) {
            $value = formatDateForMySQL($value);
        }
        $items .= trim($key, "'") . "='$value',";
    }

    $items = rtrim($items, ',');

    $sql  = "UPDATE " . $table;
    $sql .= " SET $items";
    $sql .= " WHERE id=" . $id . ";";

    try {
        $database->query($sql);
        $_SESSION['messages'] = 'Registro atualizado com sucesso.';
        $_SESSION['type'] = 'success';
        close_database($database);
        return true;  // <-- Retorna true se executou sem exceção
    } catch (Exception $e) {
        $_SESSION['messages'] = 'Não foi possível realizar a operação.';
        $_SESSION['type'] = 'danger';
        close_database($database);
        return false; // <-- Retorna false se houve exceção
    }
}

/* Remove uma linha de uma tabela pelo ID do registro */
function remove( $table = null, $id = null ) {

    $database = open_database();

    try {
        if ($id) {

            $sql = "DELETE FROM " . $table . " WHERE id = " . $id;

            $result = $database->query($sql);

            if ($result = $database->query($sql)) {
                $_SESSION['messages'] = "Registro Removido com Sucesso.";
                $_SESSION['type'] = 'success';
            }

        }

    } catch (Exception $e) {
        $_SESSION['messages'] = $e->GetMessage();
        $_SESSION['type'] = 'danger';
    }
    close_database($database);
}

/* Busca usuário pelo username ou email */
function findUserByLogin($login) {
    $database = open_database();
    $user = null;

    try {
        $sql = "SELECT * FROM users WHERE username = ? OR email = ? LIMIT 1";
        $stmt = $database->prepare($sql);
        $stmt->bind_param('ss', $login, $login);

        // Captura a query para debug
        // $debugQuery = str_replace('?', "'$login'", $sql);
        // error_log("[DEBUG QUERY] " . $debugQuery);

        // Força parar o processo aqui
        // die("DEBUG STOP: " . $debugQuery);

        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
    } catch (Exception $e) {
        $user = null;
    } finally {
        close_database($database);
    }

    return $user;
}
