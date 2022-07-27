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

$app->get('/login/{user}', function (Request $request, Response $response, array $args) {
    $filenum=[];
    $user=$args['user'];
    $fs=new Firestore( collection: 'users');
try{
$array=$fs->getuser($user);
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