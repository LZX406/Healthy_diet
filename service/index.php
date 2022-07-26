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
    //GET DB Object
    //echo'<br>';
    //print_r($fs->getDocument( name: $user)['Age']);
    //echo'<br>';
    //print_r($fs->getDocument( name: $user)['Gender']);
    //echo'<br>';
$array=$fs->getusercalorierecord( name: $user);
$arr=[];
foreach($array as $data){
    //print($data['CalNo']);
    //echo'<br>';
    //print($data['Totalcalorie']);
    //echo'<br>';
    //print($data['createdAt']);
    //echo'<br><br>';
}
    echo json_encode($fs->getDocument( name: $user)['Gender']);
    $response->getBody()->write($fs->getDocument( name: $user)['Gender']);
}catch(PDOException $e){
    $data=array("statues"=>"fail");
    echo json_endode($data);
    $response->getBody()->write($data);
}    
    return $response;
});

$app->put('/{user}/{age}', function (Request $request, Response $response, array $args) {
    $user=$args['user'];
    $age=(int)$args['age']; 
    $fs=new Firestore( collection: 'users');

    $data=[
        'Age'=> $age,
    ];
try{
$array=$fs->setprofileage( name: $user, data:$data);
echo "update successful";
}catch(PDOException $e){
    $data=array("statues"=>"fail");
    echo json_endode($data);
    
}    
});
//$response->getBody()->write("this is $place");
//print_r($fs->getDocument(name:''))

$app->get('/', function (Request $request, Response $response, array $args) {
    $response->getBody()->write("this is the root directory.....");

    return $response;
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

$app->run();
?>