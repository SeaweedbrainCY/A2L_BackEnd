<?php
$nomSend = $_POST["NomField"];
$prenomSend = $_POST["PrenomField"];
$dateSend = $_POST["DateNaissanceField"];


if(($nomSend != "" && $prenomSend!="" && $dateSend != "") && (preg_match("#[1-31]/[1-12]/[1900-2019]#",$dateSend))){
    //OK on lance l'assaut au serveur
    // Données à envoyer sous la forme d'un array
    // A part l'URL, et éventuellement les options, il n'y aurait que ce tableau à modifier
    $post = array(
    'Nom' => $nomSend + ' ' + $prenomSend,
    'DateNaissance' => $dateSend,
    );
 
    $data = http_build_query($post);
    $content = file_get_contents(
        'http://localhost:8888/infoAdherent.php',
        FALSE,
        stream_context_create(
         array(
              'http' => array(
                 'method' => 'POST',
                    'header' => "Content-type: application/x-www-form-urlencoded\r\nContent-Length: " . strlen($data) . "\r\n",
                    'content' => $data,
                )
            )
     )
    );
    var_dump($content);

} else {
    $url = 'homePageAdherent.php';
$data = array('error' => 'true');
$options = array(
        'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data),
    )
);

$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
//var_dump($result);
}
?>