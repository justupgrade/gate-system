<?php
	require_once "classes/Room.php";
	
	define('SMALL_WIDTH', 7);
	define('SMALL_HEIGHT', 7);
	
	class System {
		public $cols;
		public $rows;
		
		private $gates;
		private $center;
		private $rooms;
		
		public function __construct($cols=SMALL_WIDTH, $rows=SMALL_HEIGHT){
			$this->cols = $cols;
			$this->rows = $rows;
		}
		
		public function generate() {
			$this->gates = $this->generateGates();
			$this->center = $this->generateCenter();
			//create connection with center for each gate:
			
		}
		
		public function generateCenter() {
			return new Room(
					intval(round($this->cols/2,0,PHP_ROUND_HALF_DOWN)), 
					intval(round($this->rows/2,0,PHP_ROUND_HALF_DOWN))
			);
		}
		
		public function generateGates() {
			//left, top, right, bottom
			$maxCol = $this->cols-1;
			$maxRow = $this->rows-1;
			
			$left 	= new Room(0,					rand(2,$maxRow-2));
			$top 	= new Room(rand(2,$maxCol-2),	0);
			$right 	= new Room($maxCol,				rand(2,$maxRow-2));
			$bottom = new Room(rand(2,$maxCol-2),	$maxRow);
				
			return array($left, $top, $right, $bottom);
		}
		
		//--------------- get / set ---------------------
		public function getRooms() {
			return $this->rooms;
		}
		
		public function getCenter() {
			return $this->center;
		}
		
		public function getGates() {
			return $this->gates;
		}
	}
?>