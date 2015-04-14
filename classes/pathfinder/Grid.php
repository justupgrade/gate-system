<?php
	require_once "classes/pathfinder/Tile.php";
	
	class Grid {
		private $width;
		private $height;
		private $grid;
		private $blockedTiles;
		
		public function __construct($width, $height){
			$this->width = $width;
			$this->height = $height;
			
			$this->grid = array();
			$this->blockedTiles = array();
		}
		
		public function addBlock($point){
			//
		}
		
		public function removeBlock($point) {
			
		}
		
		public function inNewBlock($point){
			
		}
		
		public function reset() {
			
		}
		
		public function generate() {
			for($row=0; $row < $this->height; $row++) {
				$rows = array();
				for($col =0; $col < $this->width; $col++) {
					$tile = new Tile($col,$row);
					foreach($this->blockedTiles as $block) {
						//is blocked tile? -> set type = 1;
					}
					$rows[] = $tile;
				}
				$this->grid[] = $rows;
			}
		}
		
		public function getTile($col,$row) {
			if($col >= 0 && $col < $this->width  && $row >= 0 && $row < $this->height) {
				return $this->grid[$row][$col];
			}
			return null;
		}
		
		public function updateTile($tile,$col,$row) {
			if($col >= 0 && $col < $this->width  && $row >= 0 && $row < $this->height) {
				$this->grid[$row][$col] = $tile;
			}
		}
	}
?>