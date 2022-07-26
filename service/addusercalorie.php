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
$app->get('/{user}/{record}', function (Request $request, Response $response, array $args) {
    $user=$args['user'];
    $record=$args['record'];
    $fs=new Firestore( collection: 'users');
try{
$array=$fs->getusercalorierecord($user,$record);
    echo json_encode($array);   
}catch(PDOException $e){
    $data=array("statues"=>"fail");
    echo json_endode($data);
}    
});

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
$array=$fs->getuserprofilerecord($user);
//foreach($array as $data){
    //console_log($array['UserDailyCalorie']);
    //console_log($array['ActivityType']);
    //echo '<br>';
    //echo'<br>';
    //print($data['Totalcalorie']);
    //echo'<br>';
    //print($data['createdAt']);
    //echo'<br><br>';
//}
    echo json_encode($array);   
}catch(PDOException $e){
    $data=array("statues"=>"fail");
    echo json_endode($data);
}    
});

$app->put('/{user}/{age}/{height}/{weight}/{gender}', function (Request $request, Response $response, array $args) {
    $user=$args['user'];
    $age=$args['age'];
    $height=$args['height'];
    $weight=$args['weight'];
    $gender=$args['gender'];
    $fs=new Firestore( collection: 'users');
    $data=[
        'Age'=> $age,
        'Height'=>$height,
        'Weight'=>$weight,
        'Gender'=>$gender,
    ];
try{
$fs->setuserprofile($user,$data);
}catch(PDOException $e){
    $data=array("statues"=>"fail");
    echo json_endode($data);
}    
});

$app->put('/{user}/{activitytext}/{usercalorie}', function (Request $request, Response $response, array $args) {
    $user=$args['user'];
    $activitytext=$args['activitytext'];
    $usercalorie=$args['usercalorie'];
    $fs=new Firestore( collection: 'users');
    $data=[
        'ActivityType'=> $activitytext,
        'UserDailyCalorie'=>$usercalorie,
    ];
try{
$fs->setuserdailycalorie($user,$data);
}catch(PDOException $e){
    $data=array("statues"=>"fail");
    echo json_endode($data);
}    
});
$app->run();
?>