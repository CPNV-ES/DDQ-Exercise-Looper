<?php

class Model{
    protected $table = '';
    protected $readables = []; //Fields the model can read
    protected $dbConnection;

    /**
     * At the initalisazion the model will take a database connection as argument
     * @param PDO $dbConnection
     */
    protected function __construct($dbConnection){
        $this->dbConnection = $dbConnection;
    }

    /**
     * Request to the database informations about all the registery related to the table model.
     * @return array $data
     */
    public function all(){
        $this->dbConnection->connect();
        $req = 'select :column FROM :table';

        $columns = $this->genReadableStr($this->readable);

        $this->dbConnection->prepare($req);
        $this->dbConnection->execute([':column' => $columns,':table' => $this->table]);
    }

    /**
     * Convert an array to a string for sql request
     * @param array $readables
     * @return string $readablesStr 
     */
    protected function genReadableStr($readables){
        $tmpReadablesStr;

        foreach($readable as $readable){
            if(is_array($readable)){
                $tmpReadablesStr .= $readable['column']." as ". $readable['name'].","; 
            }
            else{
                $tmpReadablesStr .= $readable.",";
            }
        }
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