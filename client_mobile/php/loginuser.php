<?php
if (!isset($_POST)) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}

include_once("dbconnect.php");
$email = $_POST['email'];
$password = sha1($_POST['password']);
$sqllogin = "SELECT * FROM tb_client WHERE client_email = '$email' AND client_passw = '$password'";
$result = $conn->query($sqllogin);
$numrow = $result->num_rows;

if ($numrow > 0) {
    while ($row = $result->fetch_assoc()) {
        $client['id'] = $row['client_id'];
        $client['email'] = $row['client_email'];
        $client['name'] = $row['client_name'];
        $client['phoneNo'] = $row['client_phoneNo'];
        $client['address'] = $row['client_address'];
    }
    $response = array('status' => 'success', 'data' => $client);
    sendJsonResponse($response);
} else {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
}

function sendJsonResponse($sentArray)
{
    header('Content-Type: application/json');
    echo json_encode($sentArray);
}

?>