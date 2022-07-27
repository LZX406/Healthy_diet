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
    $filenum=[];
$array=$fs->getusercaloriehistory($user);

foreach($array as $key=>$data){
    // print_r($data->data());
    array_push($filenum,$data->data());
    $date = strval($filenum[$key]['createdAt']);
    $filenum[$key]['createdAt']=$date;
    // print($filenum[$key]['createdAt']);
}
echo json_encode($filenum);
}catch(PDOException $e){
    $data=array("statues"=>"fail");
    echo json_endode($data);
}    
});


$app->put('/{user}/{no}', function (Request $request, Response $response, array $args) {
    $user=$args['user'];
    $no=$args['no'];
    $file=[];
    $dataarray=[];
    $fs=new Firestore( collection: 'users');
    $array=$fs->getusercaloriehistory($user);

foreach($array as $key=>$data){
  


   array_push($file,$data->data());
   if($file[$key]['CalNo'] == $no)
   {
    $dataarray=[
        'CalNo'=> ($no-1),
        'Totalcalorie'=>$file[$key]['Totalcalorie'],
        'createdAt'=>$$file[$key]['createdAt']
    ];
   }
}
try{
$array=$fs->updateusercalorietable($user,$no,$dataarray);

}catch(PDOException $e){
    $data=array("statues"=>"fail");
    echo json_endode($data);
}    
});


$app->delete('/{user}/{no}', function (Request $request, Response $response, array $args) {
    $user=$args['user'];
    $no=$args['no'];
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