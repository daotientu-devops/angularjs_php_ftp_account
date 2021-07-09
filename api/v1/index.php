<?php
require '.././libs/Slim/Slim.php';
require_once 'dbHelper.php';
require_once 'passwordHash.php';

\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();
$app = \Slim\Slim::getInstance();
$db = new dbHelper();

/**
 * Database Helper Function templates
 */
/*
 * http://localhost/ftp_account/api/v1/accounts
 */

// Session
$app->get('/session', function() {
    global $db;
    $session = $db->getSession();
    $response["id"] = $session['id'];
    $response["email"] = $session['email'];
    $response["name"] = $session['name'];
    echoResponse(200, $session);
});

$app->post('/login', function() use ($app) {
    global $db;
    $r = json_decode($app->request->getBody());
    // $db->verifyRequiredParams(array('email', 'password'), $r->user);
    $password = $r->user->password;
    $email = $r->user->email;
    $user = $db->getOneRecord("SELECT id, name, password, email, created_at FROM users_auth WHERE email='$email'");

    $response = array();
    if ($user != NULL) {
        if (passwordHash::check_password($user['password'], $password)) {
            $response['status'] = "success";
            $response['message'] = 'Logged in successfully.';
            $response['name'] = $user['name'];
            $response['id'] = $user['id'];
            $response['email'] = $user['email'];
            $response['createdAt'] = $user['created_at'];
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['id'] = $user['id'];
            $_SESSION['email'] = $email;
            $_SESSION['name'] = $user['name'];
        } else {
            $response['status'] = "error";
            $response['message'] = 'Login failed. Incorrect credentials';
        }
    } else {
        $response['status'] = "error";
        $response['message'] = 'No such user is registered';
    }
    echoResponse(200, $response);
});

// Register
$app->post('/register', function() use ($app) {
    global $db;
    $response = array();
    $r = json_decode($app->request->getBody());
    // $db->verifyRequiredParams(array('email', 'name', 'password'), $r->user);
    $name = $r->user->name;
    $email = $r->user->email;
    $password = $r->user->password;
    $isUserExists = $db->getOneRecord("SELECT 1 FROM users_auth WHERE email='$email'");
    if (!$isUserExists) {
        $r->user->password = passwordHash::hash($password);
        $table_name = "users_auth";
        $column_names = array('name', 'email', 'password');
        $result = $db->insertIntoTable($r->user, $column_names, $table_name);
        if ($result != NULL) {
            $response["status"] = "success";
            $response["message"] = "User account created successfully";
            $response["id"] = $result;
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['id'] = $response['id'];
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
        } else {
            $response["status"] = "error";
            $response["message"] = "Failed to create user. Please try again";
        }
    } else {
        $response["status"] = "error";
        $response["message"] = "An user with the provided email exists!";
    }
    echoResponse(200, $response);
});

// Logout
$app->get('/logout', function() {
    global $db;
    $session = $db->destroySession();
    $response["status"] = 'info';
    $response["message"] = 'Logged out successfully';
    echoResponse(200, $response);
});

// Accounts
$app->get('/accounts', function() {
    global $db;
    $rows = $db->select("accounts", "id, name_p, folder, url, ip_address, dba, email, username, password, datetime, note", array()); // array() => một mớ điều kiện
    echoResponse(200, $rows); // echo ra dữ liệu
});

$app->post('/accounts', function() use ($app) { echo 'test@123';
    $data = json_decode($app->request->getBody()); print_r($data);
    $mandatory = array('name_p');
    global $db;
    $rows = $db->insert("accounts", $data, $mandatory);
    if($rows["status"] == "success") {
        $rows["message"] = "Account added successfully.";
    }
    echoResponse(200, $rows);
});

$app->put('/accounts/:id', function($id) use ($app) {
    $data = json_decode($app->request->getBody());
    $condition = array('id' => $id);
    $mandatory = array();
    global $db;
    $rows = $db->update("accounts", $data, $condition, $mandatory);
    if($rows["status"] == "success") {
        $rows["message"] = "Account information updated successfully.";
    }
    echoResponse(200, $rows);
});

$app->delete('/accounts/:id', function($id) {
    global $db;
    $rows = $db->delete("accounts", array('id' => $id));
    if ($rows["status"] == "success") {
        $rows["message"] = "Account removed successfully.";
    }
    echoResponse(200, $rows);
});

function echoResponse($status_code, $response) {
    global $app;
    $app->status($status_code);
    $app->contentType('application/json');
    echo json_encode($response, JSON_NUMERIC_CHECK);
}

$app->run();
?>