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

$app->get('/{user}/{foodnum}', function (Request $request, Response $response, array $args) {
    $user=$args['user'];
    $foodnum=$args['foodnum'];
    $fs=new Firestore( collection: 'users');
    
try{
$data=$fs->getuserfood($user,$foodnum);
echo json_encode($data);
}catch(PDOException $e){
    $data=array("statues"=>"fail");
    echo json_endode($data);
}    
});

$app->get('/{user}/table', function (Request $request, Response $response, array $args) {
    $user=$args['user'];
    $fs=new Firestore( collection: 'users');
    
try{
    $filenum=[];
$array=$fs->getuserfoodtable($user);
foreach($array as $data){
    array_push($filenum,$data->data());
}
echo json_encode($filenum);
}catch(PDOException $e){
    $data=array("statues"=>"fail");
    echo json_endode($data);
}    
});

$app->put('/{user}/{foodnum}/{foodname}/{foodcpg}/{gram}/{cookm}/{totalc}', function (Request $request, Response $response, array $args) {
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
$array=$fs->updateuserfoodtable($user,$foodnum,$data);
}catch(PDOException $e){
    $data=array("statues"=>"fail");
    echo json_endode($data);
}    
});

$app->delete('/{user}/{foodnum}', function (Request $request, Response $response, array $args) {
    $user=$args['user'];
    $foodnum=$args['foodnum'];
    $fs=new Firestore( collection: 'users');
    
try{
$fs->deleteuserallfoodtable($user,$foodnum);
}catch(PDOException $e){
    $data=array("statues"=>"fail");
    echo json_endode($data);
}    
});

$app->run();
?>