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



$app->post('/{username}/{email}/{password}', function (Request $request, Response $response, array $args) {
    
    $username=$args['username'];
    $password= $args['password'];
    $email = $args['email'];

    $fs=new Firestore( collection: 'users');

    $data=[
        'username' => $username,
        'password'=> $password,
        'email' => $email
    ];
try{

    $array=$fs->setAccount( name: $username, data:$data);
    echo "Account registered successful";

}

catch(PDOException $e){

    $data=array("statues"=>"fail");
    echo json_endode($data);

}    
});
//$response->getBody()->write("this is $place");
//print_r($fs->getDocument(name:''))
$app->run();
?>