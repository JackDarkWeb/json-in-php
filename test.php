<?php
/*if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message'])) {

    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $text = htmlspecialchars($_POST['message']);
    $date = time();

    $message = "$name#$email#$text#$date";

    $file = 'data/messages.txt';
    if(file_exists($file)){
        if($id = fopen($file, 'a')){
            flock($id, 2);
            fwrite($id, $message."\n");
            flock($id, 3);
            fclose($id);
        }else{
            echo "File inaccessible";
        }
    }else{
        $id = fopen($file, 'w');
        fwrite($id, $message."\n");
        fclose($id);
    }

    //var_dump($name);

}else{
    echo 'All fields are required';
}*/


$file = 'data/messages.txt';

if($id = fopen($file, 'r')){
    flock($id, 2);
    while ($line = fgets($id, 100)){
        $tab = explode('#', $line);
        if(in_array('Olga', $tab) && in_array('john@yahoo.fr', $tab)){
            echo 'ok';
        }else{
            echo 'non';
        }
    }
    flock($id, 3);
    fclose($id);
}