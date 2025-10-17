<?php 
require_once __DIR__ . '/../../init.php';

$customers = null;
$customer = null;

/* Listagem de Clientes */ 
function index() {
    global $customers;
    $customers = find_all('customers');
//     $products = find_all_with_joins(
//     'products',
//     [
//         ['table' => 'categories', 'on' => 'products.category_id = categories.id'],
//         ['table' => 'brands', 'on' => 'products.brand_id = brands.id'] // novo JOIN
//     ],
//     'products.id, 
//      products.name as product_name, 
//      products.price, 
//      categories.name as category_name, 
//      brands.name as brand_name',  // adiciona o fabricante
//     'products.active = 1',
//     'products.name ASC'
// );
}

/*  Cadastro de Clientes */
function add() {
    if (!empty($_POST['customer'])) {
        $today = date_create('now', new DateTimeZone('America/Sao_Paulo'));
        $customer = $_POST['customer'];
        $customer['created'] = $today->format("Y-m-d H:i:s");

        save('customers', $customer);
        header('location: index.php');
    }
}

/*	Atualizacao/Edicao de Cliente */
function edit() {

    $now = date_create('now', new DateTimeZone('America/Sao_Paulo'));

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        if (isset($_POST['customer'])) {

            $customer = $_POST['customer'];

            update('customers', $id, $customer);
            header('location: index.php');
        } else {
            global $customer;
            $customer = find('customers', $id);
        }  

    } else {
        header('location: index.php');
    }
}

/* Visualização de um Cliente */
function view($id = null) {
    global $customer;

    $customer = find('customers', $id);
}

/* Exclusão de um Cliente */
function delete($id = null) {

    global $customer;

    $customer = remove('customers', $id);

    header('location: index.php');
}