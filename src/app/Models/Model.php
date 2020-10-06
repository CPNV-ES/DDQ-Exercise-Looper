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
        $req = "SELECT :column FROM :table";

        $tmpStr = '';

        $nbColumns = count($this->readables);

        for($x = 1;$x <= $nbColumns;$x++){
            $tmpStr .=  $x<$nbColumns?'?,':'?';
        }

        str_replace(':column',$tmpStr,$req);

        var_dump($req);        

        $columns = $this->genReadableStr($this->readables);

        $sth = $this->dbConnection->prepare($req);

        $sth->bindValue(':colum', $columns);
        $sth->bindValue(':table', $this->table);

        $bool = $sth->execute();

        var_dump($bool);

        return $sth->fetchAll();
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
            if(is_array($readable)){
                $tmpReadablesStr .= $readable['column']." as ". $readable['name'].","; 
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
    public function find(){
        //todo
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