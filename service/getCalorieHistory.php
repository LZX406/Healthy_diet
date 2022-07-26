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





$app->get('/{user}', function (Request $request, Response $response, array $args) {
    $user=$args['user'];
    $fs=new Firestore( collection: 'users');
    
try{
    $filenum=0;
$array=$fs->getusercaloriehistory($user);
foreach($array as $data){
    $filenum+=1;
}
echo json_encode($filenum);
}catch(PDOException $e){
    $data=array("statues"=>"fail");
    echo json_endode($data);
}    
});


$app->put('/{user}/{no}/{totalc}/{date}', function (Request $request, Response $response, array $args) {
    $user=$args['user'];
    $no=$args['no'];
    $totalc=$args['totalc'];
    $date=$args['date'];
    
    $fs=new Firestore( collection: 'users');
    $data=[
        
        'Totalcalorie'=>$totalc,
        'Calno'=>(int)$foodnum,
        'createdAt'=>$date,
       
    ];
try{
$array=$fs->updateusercalorietable($user,$no,$data);
}catch(PDOException $e){
    $data=array("statues"=>"fail");
    echo json_endode($data);
}    
});


$app->delete('/{user}/{no}', function (Request $request, Response $response, array $args) {
    $user=$args['user'];
    $no=$args['foodnum'];
    $fs=new Firestore( collection: 'users');
    
try{
$fs->deleteusercalorie($user,$no);
}catch(PDOException $e){
    $data=array("statues"=>"fail");
    echo json_endode($data);
}    
});

$app->run();

?>