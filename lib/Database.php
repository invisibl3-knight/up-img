<?php
Class Database{
	
	public $host   = DB_HOST;
	public $name   = DB_USER;
	public $pass   = DB_PASS;
	public $dbname = DB_NAME;
	
	public $link;
	public $error;
	
	
	public function __construct(){
		$this->connectDB();
	}
	private function connectDB(){
		$this->link = new mysqli($this->host,$this->name,$this->pass,$this->dbname);
		if(!$this->link){
			$this->error = "Connection failed !!".$this->link->connect_error;
		}
	}
	
	
	// Image insert
	public function upload($query){
		$insert_row = $this->link->query($query) or die ($this->link->error__LINE__);
		if($insert_row){
			return $insert_row;
		}
		else {
			return false;
		}
	}
	
	//Read Image
	public function read($data){
		$read_row = $this->link->query($data) or die ($this->link->error__LINE__);
		if($read_row->num_rows > 0){
			return $read_row;
		}
		else {
			return false;
		}
	}
	//Delete Image
	public function delete($data){
		$delete_row = $this->link->query($data) or die ($this->link->error__LINE__);
		if($delete_row){
			return $delete_row;
		}
		else {
			return false;
		}
	}
	
	
	
}


?>