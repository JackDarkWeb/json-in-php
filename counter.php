<?php

function add_view($ip_addr, $article_id){
    $file = 'data/messages.txt';

    $date = time();
    $data = "$ip_addr#$article_id#$date";

    if($id = fopen($file, 'r')){

        while ($line = fgets($id, 100)){
            $tab = explode('#', $line);
            var_dump($tab);
           /* if(in_array($ip_addr, $tab) == false && in_array($article_id, $tab) == false){
                var_dump($tab);
                $action = action($file, $data);
                if($action === 'true'){
                    counter();
                }else{
                    echo $action;
                }
            }*/
        }

        fclose($id);
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