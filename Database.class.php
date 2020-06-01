<?php 
    class Database{
        protected $connect;
        protected $database;
        protected $table;
        protected $resultQuery;

        // Connect to Database
        public function __construct($params){
            $link = mysqli_connect($params['server'],$params['username'],$params['password']);
            if(!$link){
                die ('Fail: ' .  mysqli_connect_error());
            } else {
                $this->connect = $link;
                $this->database = $params['database'];
                $this->table = $params['table'];
                $this->setDatabase();
                $this->query("SET NAMES 'utf8'");
                $this->query("SET CHARACTER SET 'utf8'");
            }
        }

        // Set database
        public function setDatabase($database = null){
            if($database != null) {
                $this->database = $database;
            }
            mysqli_select_db($this->connect,$this->database);
        }

        // Set connect
        public function setConnect($connect){
            $this->connect = $connect;
        }

        // Get connect
        public function getConnect(){
            return $this->connect;
        }
	
        // Set table
        public function setTable($table){
            $this->table = $table;
        }

        // QUERY
        public function query($query){
            $this->resultQuery = mysqli_query($this->connect, $query);
            return $this->resultQuery;
        }

        // DISCONNECT DATABASE
        public function __destruct(){
            mysqli_close($this->connect);
        }

        // INSERT FUNCTION
        public function insert($data, $type = 'single'){
            if($type = 'single'){
                $newQuery= $this->createInsertArray($data);
                $query= "INSERT INTO `$this->table` (".$newQuery['fields'].") VALUES (".$newQuery['values'].")";
                $this->query($query);
            } else {
                foreach($data as $value){
                    $newQuery = $this->createInsertArray($data);
                    $query= "INSERT INTO `$this->table` (".$newQuery['fields'].") VALUES (".$newQuery['values'].")";
                    $this->query($query);
                }
            }
            return $this->insertId();
        }

        // CREATE INSERT ARRAY
        private function createInsertArray($data){
            $newQuery = array();
            $fields = '';
            $values = '';
            if (!empty($data)){
                foreach($data as $key=>$data){
                    $fields .= ", `$key`";
                    $values .= ", '$data'";
                }
            }
            $newQuery['fields'] = substr($fields,2);
            $newQuery['values'] = substr($values,2);
            return $newQuery;
        }

        // insert id
        public function insertId(){
            return $lastID= mysqli_insert_id($this->connect);
        }

        // UPDATE
        public function update($data, $id){
            $updateData = $this->createUpdata($data);
            $whereData= $this->createWhereUpdate($id);
            $updateCommand = "UPDATE `$this->table` SET ".$updateData." WHERE $whereData";
            $this->query($updateCommand);
            return $this->affected_row();
        }

        // UpdateData
        private function createUpdata($data){
            $newQuery = '';
            if(!empty($data)){
                foreach ($data as $key=>$value){
                    $newQuery .= ", `$key` = '$value'";
                }
            }
            $newQuery = substr($newQuery,2);
            return $newQuery;
        }

        // Update/WhereData
        private function createWhereUpdate($id){
            $newQuery = '';
            if(!empty($id)){
                $newQuery = "`id` = $id";
            }
            return $newQuery;
        }

        // Check Affective_row
        public function affected_row(){
            return mysqli_affected_rows($this->connect);
        }

        // Delete 
        public function delete($id){
            $query=$this->createWhereDelete($id);
            $this->query($query);
            return $this->affected_row();
        }

        // Delete id
        private function createWhereDelete($id){
            if(!empty($id)){
                $newWhere = '';
                $query = '';
                if(is_array($id)){
                    foreach($id as $value){
                        $newWhere .= "," . $value;
                    }
                    $newWhere = substr($newWhere,1);
                    $query = "DELETE FROM `$this->table` WHERE `id` IN ($newWhere)";
                } else{
                    $query = "DELETE FROM `$this->table` WHERE `id` = $id";
                    }
            }
            return $query;
        }

        // SHOW ROWS DATA
        public function listRecord($query = null){
            $result = array();
            $resultQuery = ($query == null)? $this->query : $this->query($query);
            if(mysqli_num_rows($resultQuery) > 0){
                while($row = mysqli_fetch_assoc($resultQuery)){
                    $result[] = $row;
                }
                mysqli_free_result($resultQuery);
            }
            return $result;
        }

        // Count result
        public function countResult($where = null){
            if(!$where){
                $query = "SELECT COUNT(id) AS total FROM `users`";
            } else{
                $query = "SELECT COUNT(id) AS total FROM `users` WHERE $where";
            }
            $result = $this->query($query);
            $total = mysqli_fetch_assoc($result);
            return $total['total'];
        }
    }
?>