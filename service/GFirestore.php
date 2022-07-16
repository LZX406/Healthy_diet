<?php
header('Access-Control-Allow-Origin: *' );
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Headers: *' );
require_once '../vendor/autoload.php';
use Google\Cloud\Firestore\FirestoreClient;
class Firestore
{
    protected $db;
    protected $name;
    public function __construct(string $collection){
    
        $this->db= new FirestoreClient([
            'projectId' => 'healthydiet-cb745']);
        $this->name=$collection;
        //print("connected $this->name");
    
    }

    public function getdb()
    {
        return $this->$db;
    }

    public function getname()
    {
        return $this->$name;
    }

    public function getDocument(string $name)
    {
        return $this->db->collection($this->name)->document($name)->snapshot()->data();
    }

    public function getusercalorierecord(string $name,string $record)
    {
        
        return $this->db->collection($this->name)->document($name)->collection('UserdailyCalorie')->document($record)->snapshot()->data();  
    }

    public function getuserprofilerecord(string $name)
    {
        
        return $this->db->collection($this->name)->document($name)->snapshot()->data();  
    }

    public function setprofileage(string $name,Array $data)
    {
        return $this->db->collection($this->name)->document($name)->set($data, ['merge'=> true ]);
    }

    public function setuserprofile(string $name,Array $data,)
    {
        $this->db->collection($this->name)->document($name)->set($data, ['merge'=> true ]);
    }

    public function setuserdailycalorie(string $name,Array $data,)
    {
        $this->db->collection($this->name)->document($name)->collection('UserdailyCalorie')->document('record')->set($data, ['merge'=> true ]);
    }

    public function getuserfoodtable(string $name)
    {
        
        return $this->db->collection($this->name)->document($name)->collection('FoodTable')->documents();  
    }

    public function adduserfoodtable(string $name,string $num,Array $data)
    {
        
        $this->db->collection($this->name)->document($name)->collection('FoodTable')->document($num)->set($data);  
    }

    public function updateuserfoodtable(string $name,string $num,Array $data)
    {
        
        $this->db->collection($this->name)->document($name)->collection('FoodTable')->document($num)->set($data);  
    }

    public function getuserfoodcalorierecord(string $name)
    {
        
        return $this->db->collection($this->name)->document($name)->collection('Calorierecord')->documents();  
    }

    public function adduserfoodcalorierecord(string $name,string $num,Array $data)
    {
        
        $this->db->collection($this->name)->document($name)->collection('Calorierecord')->document($num)->set($data);  
    }

    public function deleteuserallfoodtable(string $name,string $num)
    {
        $this->db->collection($this->name)->document($name)->collection('FoodTable')->document($num)->delete();
    }
}