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

$array=$fs->getHistory( name: $user);

    echo json_encode($fs->getBMIValue( name: $user, id: 1)['BMI']);
    echo json_encode($fs->getBMIValue( name: $user, id: 1)['No']);
    echo json_encode($fs->getBMIValue( name: $user, id: 1)['createdAt']);

}

catch(PDOException $e){
    $data=array("statues"=>"fail");
    echo json_endode($data);
    $response->getBody()->write($data);
}    
});
$app->run();
?>