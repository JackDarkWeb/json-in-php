<?php
if(!empty($_POST['id'])){

    $id = $_POST['id'];
    $all_messages = file_get_contents('messages.json');
    $all_messages = json_decode($all_messages, true);

    $data = [];
    for($i = 0; $i < count($all_messages); $i++){

        if($all_messages[$i]['id'] !== $id)
        $data[] = $all_messages[$i];
    }

    $data = json_encode($data);
    file_put_contents('messages.json', $data);
    $success = 'true';

    echo json_encode($success);
}

