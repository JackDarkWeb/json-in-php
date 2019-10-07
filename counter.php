<?php

function add_view($ip_addr, $article_id){
    $row = row($ip_addr);
    $t = time();
    if($row === 0){
        insert($ip_addr, $article_id, $t);
        counter();;
    }
}

function action($file, $data):string {

    $str = '';
    if(file_exists($file)){

        if($id = fopen($file, 'a')){
            flock($id, 2);
            fwrite($id, $data."\n");
            flock($id, 3);
            fclose($id);

            $str =  "true";
        }else{
            $str =  "Please, try again later";
        }
    }else{
        $id = fopen($file, 'w');
        flock($id, 2);
        fwrite($id, $data."\n");
    }
    return $str;
}

function number_views():string{
    $file = 'data/counter.txt';
    return file_get_contents($file);
}

function counter(){
    $file = 'data/counter.txt';
    $counter = 1;
    if(file_exists($file)){
        $counter = (int)file_get_contents($file);
        $counter++;
        file_put_contents($file, $counter);
    }
    file_put_contents($file, $counter);
}

function row($ip_addr){

    $db = new PDO('mysql:host=localhost; dbname=counters; charset=utf8', 'root', '');
    $get = $db->prepare('SELECT * FROM users WHERE ip = ?');
    $get->execute(array($ip_addr));
    $row  = $get->rowCount();
    return $row;
}
function insert($ip_addr, $article_id, $t){

    $db = new PDO('mysql:host=localhost; dbname=counters; charset=utf8', 'root', '');
    $get = $db->prepare("INSERT INTO  users(ip, article_id, temps) VALUES(?,?,?)");
    $get->execute(array($ip_addr, $article_id, $t));
}