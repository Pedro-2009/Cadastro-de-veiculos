<?php

/** CONFIGURAÇÕES DE BANCO DE DADOS **/
define('DB_NAME', 'senac_crud_login');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');

/**
 * CONFIGURAÇÕES GERAIS
 * Separação de caminhos físicos (PATH) e caminhos web (URL)
 */

/** CAMINHOS FÍSICOS (no servidor) **/
if (!defined('ABSPATH')) {
    define('ABSPATH', dirname(__FILE__) . '/'); // Raiz do projeto no servidor
}
define('CONFIGAPI', ABSPATH . 'config.php');
define('DBAPI', ABSPATH . 'inc/database.php');
define('HELPERS_PATH', ABSPATH . 'inc/globalFunctions.php');
define('COMPONENTS_PATH', ABSPATH . 'components/');
define('MODULES_PATH', ABSPATH . 'modules/');
define('PUBLIC_PATH', ABSPATH . 'public/');
define('CSS_PATH', PUBLIC_PATH . 'css/');
define('JS_PATH', PUBLIC_PATH . 'js/');
define('IMG_PATH', PUBLIC_PATH . 'images/');
define('UPLOADS_PATH', PUBLIC_PATH . 'uploads/');

/** caminhos dos templates de header e footer **/ 
define('HEADER_TEMPLATE', ABSPATH . 'inc/header.php'); 
define('FOOTER_TEMPLATE', ABSPATH . 'inc/footer.php');

/** URL BASE (para uso no navegador) **/
if (!defined('BASEURL')) {
    define('BASEURL', '/Cadastro-de-veiculos/Cadastro-de-veiculos/crud_login/'); // Ajuste se o projeto estiver em outra pasta
}

define('MODULES_URL', BASEURL . 'modules/');
define('COMPONENTS_URL', BASEURL . 'components/');
define('PUBLIC_URL', BASEURL . 'public/');
define('CSS_URL', PUBLIC_URL . 'css/');
define('JS_URL', PUBLIC_URL . 'js/');
define('IMG_URL', PUBLIC_URL . 'images/');
define('UPLOADS_URL', PUBLIC_URL . 'uploads/');
define('LOGIN_URL', BASEURL . 'login.php');