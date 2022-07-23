<?php
header('Access-Control-Allow-Origin: *' );
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Headers: *' );
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
require '../vendor/autoload.php';
require_once 'GFirestore.php';
$app = new \Slim\App;

$app->get('/{user}', function (Request $request, Response $response, array $args) {
    $user=$args['user'];
    $fs=new Firestore( collection: 'users');
    
try{
    $filenum=0;
$array=$fs->getuserfoodtable($user);
foreach($array as $data){
    $filenum+=1;
}
echo json_encode($filenum);
}catch(PDOException $e){
    $data=array("statues"=>"fail");
    echo json_endode($data);
}    
});

$app->post('/{user}/{foodnum}/{foodname}/{foodcpg}/{gram}/{cookm}/{totalc}', function (Request $request, Response $response, array $args) {
    $user=$args['user'];
    $foodnum=$args['foodnum'];
    $foodname=$args['foodname'];
    $foodcpg=$args['foodcpg'];
    $gram=$args['gram'];
    $cookm=$args['cookm'];
    $totalc=$args['totalc'];
    $fs=new Firestore( collection: 'users');
    $data=[
        'CPG'=> $foodcpg,
        'NameOfFood'=>$foodname,
        'TableNo'=>(int)$foodnum,
        'cm'=>$cookm,
        'gram'=>$gram,
        'totalcalorie'=>$totalc
    ];
try{
$array=$fs->adduserfoodtable($user,$foodnum,$data);
}catch(PDOException $e){
    $data=array("statues"=>"fail");
    echo json_endode($data);
}    
});

$app->run();
?>