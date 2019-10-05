<?php
//var_dump($_POST);
if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message'])){

    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $text = htmlspecialchars($_POST['message']);

    $message = [];
    $err = [];

    $message['name'] = $name;
    $message['email'] = $email;
    $message['message'] = $text;
    $message['date'] = date('d/m/Y à H:i:s');
    $message['id'] = date("dmYHis");

    // I retrieve all messages json
    $data = file_get_contents('messages.json');

    //I convert the Json into a table so I can add a new mew message
    $data = json_decode($data, true);
    $data[] = $message;

    //Convert back to Json
    $data = json_encode($data);
    file_put_contents('messages.json', $data);

}else{
    $err['error'] = "All fields are required";
}
echo json_encode($err);