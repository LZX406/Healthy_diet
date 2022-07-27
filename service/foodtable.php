<?php
header('Access-Control-Allow-Origin: *' );
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Headers: *' );
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Google\Cloud\Firestore\FieldValue;
require '../vendor/autoload.php';
require_once 'GFirestore.php';
$app = new \Slim\App;

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

$app->post('/{user}/{foodnum}/{allfoodtotalc}', function (Request $request, Response $response, array $args) {
    $user=$args['user'];
    $foodnum=$args['foodnum'];
    $allfoodtotalc=$args['allfoodtotalc'];
    $today=FieldValue::serverTimestamp();
    $fs=new Firestore( collection: 'users');
    $data=[
        'CalNo'=> $foodnum,
        'Totalcalorie'=>$allfoodtotalc,
        'createdAt'=>$today
    ];
try{
$fs->adduserfoodcalorierecord($user,$foodnum,$data);
}catch(PDOException $e){
    $data=array("statues"=>"fail");
    echo json_endode($data);
}    
});

$app->get('/{user}', function (Request $request, Response $response, array $args) {
    $user=$args['user'];
    $fs=new Firestore( collection: 'users');
    
try{
    $filenum=0;
    $filearray=[];
$array=$fs->getuserfoodcalorierecord($user);
foreach($array as $data){
    $filenum+=1;
}
echo json_encode(strval($filenum));
}catch(PDOException $e){
    $data=array("statues"=>"fail");
    echo json_endode($data);
}    
});

$app->delete('/{user}/delete', function (Request $request, Response $response, array $args) {
    $user=$args['user'];
    $fs=new Firestore( collection: 'users');
    
try{
$array=$fs->getuserfoodtable($user);
foreach($array as $data){
    print($data['TableNo']);
$fs->deleteuserallfoodtable($user,$data['TableNo']);
}
}catch(PDOException $e){
    $data=array("statues"=>"fail");
    echo json_endode($data);
}    
});

$app->run();
?>