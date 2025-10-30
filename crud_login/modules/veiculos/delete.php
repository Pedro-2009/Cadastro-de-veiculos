<?php
require_once('functions.php');

// Exclui veículo pelo ID
$id = $_GET['id'] ?? null;

veiculos_delete($id);