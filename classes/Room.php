<?php
	class Room {
		public $connected;
		public $connections;
		public $col;
		public $row;
		
		public function __construct($col,$row){
			$this->col = $col;
			$this->row = $row;
			$this->connected = false;
			$this->connections = array();
		}
	}
?>