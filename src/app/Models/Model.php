<?php

class Model {

    protected $table = '';
    public $readables = []; //Fields the model can read
    protected $writables = []; //Fields the model can 
    protected $dbConnection;

    /**
     * At the initalisazion the model will take a database connection as argument
     * @param PDO $dbConnection
     */
    public function __construct($dbConnection, $debug = false){
        $this->dbConnection = $dbConnection;

        if($debug){
            $this->table = 'test';
            $this->readables = ['name','firstname','birthday'];
            $this->writables = ['name','firstname','birthday','favorite_pets'];
        }
    }

    /** 
     * Request to the database informations about all the registery related to the table model.
     * @return array $data
     */
    public function all(){
        $sth = $this->dbConnection->prepare($this->baseSelect());

        $sth->execute();

        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function baseSelect(){
        $req = "SELECT :columns FROM {$this->table}";
        $tmpStr = '';
        $nbColumns = count($this->readables);

        $tmpStr = $this->genReadableStr($this->readables);

        $req = str_replace(':columns',$tmpStr,$req);

        return $req;
    }

    /**
     * Convert an array to a string for sql request
     * @param array $readables
     * @return string $readablesStr 
     */
    protected function genReadableStr($readables){
        $tmpReadablesStr = '';

        $x = 0;
        foreach($readables as $readable){
            if(is_array($readable) && $x < count($readables) - 1){
                $tmpReadablesStr .= $readable[key($readable)]." as ". key($readable).",";
            }
            else if(is_array($readable)){
                $tmpReadablesStr .= $readable[key($readable)]." as ". key($readable); 
            }
            else if($x < count($readables) - 1){
                $tmpReadablesStr .= $readable.",";
            }
            else{
                $tmpReadablesStr .= $readable;
            }
            $x++;
        }
        return $tmpReadablesStr;
    }

    /**
     * Request to the database informations about the specified registery related to the table model.
     * @param int $id
     * @return array $data
     */
    public function find($id){
        $req = $this->baseSelect();
        $req .= ' WHERE '.$this->table.'.id = '.$id;

        $sth = $this->dbConnection->prepare($req);

        $sth->execute();

        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * Request to the database informations about the restery who are related to another table.
     * @param int $idOfWhatYouWant
     * @param int $idOfWhatIsRelated
     * @return void
     */
    public function findRelatedTo($idOfWhatYouWant,$idOfWhatIsRelated){
        //todo
    }


    /**
     * Insert into the database new registery informations.
     * @param array
     * @return  
     */
    public function insert(){
        //todo
    }


    /**
     * Update a existing registery informations in the database
     * 
     */
    public function update(){
        //todo
    }

    /**
     * Delete a registery in the database
     * @param int $id
     * @return bool
     */

    public function delete(){
        //todo
    }
}