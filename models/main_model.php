<?php
class Main_Model 
{
	protected $con;
    private static $instance = [];  

	protected $table;
	protected function __construct(){
		$instanceDB = ConnectDb::getInstance();
		$this->con = $instanceDB->getConnection();
		if(!$this->table)	$this->setTableName();
	}

	public static function getInstance() {
		$called_class = get_called_class();
        if (!array_key_exists($called_class,self::$instance)) {
			self::$instance[$called_class] = new $called_class();
		}
        return self::$instance[$called_class];
    }

	public function setTableName($table=null){
		if($table) {
			$this->table=$table;
		} else {
			$cln = get_class($this);
			$clnf = str_split($cln, strrpos($cln, '_'))[0];
			if (strrpos($clnf,"y")) {
				if ((strrpos($clnf,"y") + 1) == strlen($clnf)) {
					$this->table = str_split($clnf, strrpos($clnf, 'y'))[0].'ies'; 
				} 
			} else {
				$this->table = $clnf.'s';
			}
		}
	}
	
	public function getTableName() {
		return $this->table;
	}
	
	public function getAllTables() {
		$sql = "SHOW TABLES FROM ".DB_NAME;
		$query = mysqli_query($this->con,$sql);
		$result = [];
		if($query) {
			while($field = mysqli_fetch_row($query)) {
				array_push($result, $field[0]);
			}
		}
		return $result;
	}
	
	public function getAllFields($table) {
		$sql = "SHOW COLUMNS FROM ".$table;
		$fields = $this->con->query($sql);
		$result = [];
		if($fields) {
			while($field = mysqli_fetch_array($fields)) {
				array_push($result, $field['Field']);
			}
		}
		return $result;
	}
	
}
