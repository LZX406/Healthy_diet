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

    public function getDocument(string $name)
    {
        return $this->db->collection($this->name)->document($name)->snapshot()->data();
    }

    public function getBMIValue(string $name, $id)
    {
        return $this->db->collection($this->name)->document($name)-> collection('BMI Value')->document($id)->snapshot()->data();
    }

    public function getusercalorierecord(string $name)
    {
        return $this->db->collection($this->name)->document($name)->collection('Calorierecord')->documents()->rows();
    }

    public function setprofileage(string $name,Array $data)
    {
        return $this->db->collection($this->name)->document($name)->set($data, ['merge'=> true ]);
    }

    public function setAccount(string $name,Array $data)
    {
        return $this->db->collection($this->name)->document($name)->set($data);
    }

    public function addBMI(string $name, Array $data, $id)
    {
        return $this->db->collection($this->name)->document($name)->collection('BMI Value')->document($id)->set($data);
        $id++;
    }

    public function getHistory(string $name)
    {
        return $this->db->collection($this->name)->document($name)->collection('BMI Value')->documents()->rows();
    }
}