<?php

error_reporting(1);

require "function.php";

$spotify = new spotify();


echo "LIST TOOLS\n";
echo "[1] GET TOKEN\n";
echo "[2] FOLLOW ARTIST\n";
echo "[3] FOLLOW PLAYLIST\n";
echo "[4] FOLLOW USER\n";
echo "[5] REFRESH TOKEN\n";
echo "[6] CHECKER AKUN\n";
echo "Select tools: ";
$opsi = trim(fgets(STDIN));

if($opsi == 1){
	echo "[1] GET TOKEN\n";
    echo "file : ";
$file = file(trim(fgets(STDIN)));
echo "delim : ";
$delim = trim(fgets(STDIN));

foreach($file as $data){
    $empas = explode($delim, $data);
    $email = trim($empas[0]);
    $pass = trim($empas[1]);
    $cookie = $spotify->getCookies();
    $login = $spotify->tryLogin($cookie, $email, $pass);
    $token = $spotify->getToken($login[1]); 
    $json = json_decode($token[1], true);

$token = $json['accessToken'];

print_r("$token \n");
fwrite(fopen('tok.txt', 'a'), "$token \n");
//print_r($spotify->followArtist($token, $ids, true));


    }
}

//print_r($spotify->followArtist($token, $ids));

if($opsi == 2){
	echo "[2] FOLLOW ARTIST\n";
    echo "file : ";
    $file = file(trim(fgets(STDIN)));
    echo "ids : ";
    $ids = trim(fgets(STDIN));

    
    foreach($file as $data){
      $token = trim($data);
      $foll = $spotify->followArtist($token, $ids);
    
    print_r("$foll\n");
    }
    
}

if($opsi == 3){
	echo "[3] FOLLOW PLAYLIST\n";
    echo "file : ";
    $file = file(trim(fgets(STDIN)));
    echo "playlist_id : ";
    $playlist_id = trim(fgets(STDIN));

    foreach($file as $data){
        $token = trim($data);
        $foll = $spotify->followPlaylist($token, $playlist_id);
      
      print_r("$foll\n");
      }

}

if($opsi == 4){
	echo "[4] FOLLOW USER\n";
    echo "file : ";
    $file = file(trim(fgets(STDIN)));
    echo "target : ";
    $ids = trim(fgets(STDIN));

    
    foreach($file as $data){
      $token = trim($data);
      $foll = $spotify->followUser($token, $ids);
    
    print_r("$foll\n");
    }
    
}

if($opsi == 5){
	echo "[5] REFRESH TOKEN\n";
    echo "file : ";
    $file = file(trim(fgets(STDIN)));

    
    foreach($file as $data){
    $cookie = trim($data);
    $token = $spotify->refreshToken($cookie);
    

print_r("$token \n");

//fwrite(fopen('cookie.txt', 'a'), "$cookie \n");
//fwrite(fopen('azz.txt', 'a'), "$token \n");

    }
}

?>