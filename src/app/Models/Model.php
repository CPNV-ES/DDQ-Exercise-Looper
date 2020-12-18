<?php

require_once dirname(__DIR__,1) . "/Db.php";

class Model {

    protected $table = '';
    protected $foreignKeys = [];
    protected $readables = []; //Fields the model can read
    protected $writables = []; //Fields the model can write
    protected $dbConnection;

    /**
     * At the initalisazion the model will take a database connection as argument
     * @param PDO $dbConnection
     */
    public function __construct($dbConnection = null, $debug = false){
        if(isset($dbConnection)){
            $this->dbConnection = $dbConnection;
        }
        else {
            $this->dbConnection = Db::getConnection();
        }
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

        if(isset($this->foreignKeys)){
            $foreignKeys = $this->foreignKeys;

            $join = '';

            foreach($foreignKeys as $fkey){
                $fIndex = array_values($fkey)[0]; // extract the table from the index given exemple "answers.id" will get answers who is the table
                $table = explode('.',$fIndex)[0];

                $fColumn = array_keys($fkey)[0];

                $join .= ' INNER JOIN ' . $table . ' ON '. $fColumn . ' = ' . $fIndex;
            }
            $req .= $join;
        }

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
            if(strpos($readable,'.') == false){
                $readable = $this->table.'.'.$readable;
            }
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

    public function findByExercise($id){
        $req = $this->baseSelect();
        $req .= ' WHERE exercisesId = '.$id;

        $sth = $this->dbConnection->prepare($req);

        $sth->execute();

        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Insert into the database new registery informations.
     * @param array $data
     * @return int $lastId
     */
    public function insert($data){

        $writable = $this->writables;

        if(!in_array('updatedAt',$data)) $writable = array_diff($writable, ['updatedAt']);

        $req = "INSERT INTO ".$this->table." (:columns) VALUES (:writables)";
        $req = str_replace(":columns",$this->genReadableStr($writable),$req);

        $nbWritables = $writable;

        $abstractArgumentArray = array_fill(0,count($nbWritables), "?");
        $abstractArgumentArray = implode(", ",$abstractArgumentArray);
        $req = str_replace(":writables",$abstractArgumentArray,$req);

        $sth = $this->dbConnection->prepare($req);

        $state = $sth->execute(array_values($data));

        $lastId = false;

        if($state) $lastId = $this->dbConnection->lastInsertId();

        return $lastId;
    }


    /**
     * Update a existing registery informations in the database
     * @param array $data
     * @param array $updateColumns
     */
    public function update($id, $data, $updateColumns = null){
        $sql = "UPDATE ".$this->table." SET ";
        if(!empty($updateColumns)){
            foreach($updateColumns as $key => $column) {
                if(array_search($column, $this->writables) !== false){
                    $sql .= $column . " = ?" . (count($updateColumns)-1>$key ? ", " : " ");
                }
            }
        }

        $sql .= "WHERE id = ".$id;

        $sth = $this->dbConnection->prepare($sql);

        $state = $sth->execute($data);

        return $state;
    }

    /**
     * Delete a registery in the database
     * @param int $id
     * @return bool
     */

    public function delete($id){
        $sql = "DELETE FROM ".$this->table." WHERE id = ?";

        $sth = $this->dbConnection->prepare($sql);

        $state = $sth->execute([$id]);

        return $state;
    }
}