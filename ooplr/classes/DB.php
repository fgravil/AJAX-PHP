<?php  
//singleton pattern
class DB{
	private static $_instance = null;
	private $_pdo, 
			$_query,
			$_error = false,
			$_results,
			$_count=0;

	/*This constructor sets the db configurations defied in the Config class.
	 *If the configurations are not defined properly an error message is thrown and the script dies.
	 */
	private function __construct(){
		try{
			$this->_pdo = new PDO('mysql:host=' . Config::get('mysql/host') . ';dbname=' . Config::get('mysql/db'),Config::get('mysql/username'),Config::get('mysql/password'));
		}catch(PDOException $e){
			die($e->getMessage());
		}
	}

	//This function creates a new instance of the DB if one has not already been set.
	// Returns the instance of the DB to follow the singleton pattern.
	public static function getInstance(){
		if(!isset(self::$_instance)){
			self::$_instance = new DB();
		}
		return self::$_instance;
	}

	/*This function takes in a sql statement and the parameters that needs to be 
	 *bound to the statements. After binding all parameter values as a prepared 
	 *statement, the sql statement is executed and the results and count variables are set.
	 */
	public function query($sql,$params = array()){
		$this->_error = false;
		if($this->_query = $this->_pdo->prepare($sql)){
			$x = 1;
			if(count($params)){
				foreach($params as $param){
					$this->_query->bindValue($x,$param);
					$x++;
				}
			}
			if($this->_query->execute()){
				$this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
				$this->_count = $this->_query->rowCount();
			}else{
				$this->_error = true;
			}
			return $this;
		}
	}

	//Function to create a sql statement based on parameters. 
	//The query function executes the newly created sql statement.
	public function action($action,$table,$where = array()){
		if(count($where) === 3){
			$operators = array('=','>','<','>=','<=');

			$field = $where[0];
			$operator = $where[1];
			$value = $where[2];

			if(in_array($operator, $operators)){
				$sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";

				if(!$this->query($sql,array($value))->error()){
					return $this;
				}
			}
		}
		return false;
	}

	//Function to get all the rows in the $table that match the $where specifications.
	public function get($table, $where){
		return $this->action('SELECT *',$table,$where);
	}

	//Function to delete all the rows in the $table that match the $where specifictions.
	public function delete($table,$where){
		return $this->action('DELETE',$table,$where);
	}

	//Function to insert into the $table based on the given $fields in the array
	public function insert($table,$fields = array()){
		if(count($fields)){
			$keys = array_keys($fields);
			$values = '';
			$x = 1;

			foreach ($fields as $field) {
				$values .= "?";
				if($x < count($fields)){
					$values .= ', ';
				}
				$x++;
			}

			$sql = "INSERT INTO {$table} (`" . implode('`, `', $keys) . "`) VALUES ({$values})";

			if(!$this->query($sql,$fields)->error()){
				return true;
			}
		}
		return false;
	}

	//Function updates the $table based on the given $id and $fields that need to be changed.$fields is an array.
	public function update($table,$id,$fields){
		$set = '';
		$x = 1;

		foreach($fields as $name => $value){
			$set .= "{$name} = ?";
			if($x < count($fields)){
				$set .= ', ';
			}
			$x++;
		}

		$sql = "UPDATE {$table} SET {$set} WHERE id = {$id}";
		if(!$this->query($sql,$fields)->error()){
			return true;
		}
		return false;
	}

	//Function to return the results of the last query that was run
	public function results(){
		return $this->_results;
	}

	//Function to return the first row in the results 
	public function first(){
		return $this->results()[0];
	}

	//Function to return the amount of rows affected by the last query
	public function count(){
		return $this->_count;
	}

	//Function to return error messages
	public function error(){
		return $this->_error;
	}
}