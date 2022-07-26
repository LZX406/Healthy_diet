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



$app->post('/{username}/{BMI}', function (Request $request, Response $response, array $args) {
    
    $username= $args['username'];
    $BMI= $args['BMI'];
    $id = 0;
    $time = date("r");

    $fs=new Firestore( collection: 'users');

    $data=[
        'BMI' => $BMI,
        'No'=> $id+1,
        'createdAt' => $time,
    ];
    
try{
    $array=$fs->addBMI( name: $username, data:$data, id:$id+1);
    echo "Value added";
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