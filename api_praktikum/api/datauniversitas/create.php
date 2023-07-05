<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-AllowHeaders, Authorization, X-Requested-With");
include_once '../../config/datauniversitas/database.php';
include_once '../../models/datauniversitas/employees.php';
$database = new Database();
$db = $database->getConnection();
$item = new Employee($db);
$data = json_decode(file_get_contents("php://input"));
$item->kode = $data->kode;
$item->namaprogramstudi = $data->namaprogramstudi;
$item->jenjang = $data->jenjang;
$item->akreditasi = $data->akreditasi;
$item->status = $data->status;

if ($item->createEmployee()) {
    echo json_encode(['message' => 'Employee created successfully.']);
} else {
    echo json_encode(['message' => 'Employee could not be created.']);
}
