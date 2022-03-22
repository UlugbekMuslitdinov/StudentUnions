<?php

header('Content-type: application/json');
$data = json_decode( file_get_contents( 'php://input' ), true );

$success = false;

$code = '';
if (isset($data['code'])){
    $code = preg_replace('/\s+/', '', $data['code']);
    if ($code == 'FALL2020Q'){
        // Quarantine
        $success = true;
    }
    else if ($code == 'FALL2020B') {
        // Isolation
        $success = true;
    }
}

$result = [
    'code' => $code,
    'success' => $success
];
echo json_encode($result);