<?php
	class Tile {
		private $col;
		private $row;
		private $type;
		private $gCost;
		private $hCost;
		private $parentTile;
		
		public $inOpenList;
		public $inClosedList;
		
		public function __construct($x,$y){
			$this->col = $x;
			$this->row = $y;
			
			$this->type = 0;
			$this->gCost = 0;
			$this->hCost = 0;
			$this->parentTile = null;
			$this->inOpenList = false;
			$this->inClosedList = false;
		}
		
		public function reset() {
			$this->type = 0;
			$this->gCost = 0;
			$this->hCost = 0;
			$this->parentTile = null;
			$this->inOpenList = false;
			$this->inClosedList = false;
		}
		
		public function addToOpenList() {
			$this->inOpenList = true;
		}
		
		public function addToClosedList() {
			$this->inClosedList = true;
		}
		
		public function removeFromClosedList() {
			$this->inClosedList = false;
		}
		
		public function setType($type){
			$this->type = $type;
		}
		
		public function setGCost() {
			$this->gCost = $this->calculateGCost($this->parentTile);
		}
		
		public function calculateGCost($parentTile){
			if($this->col - $parentTile->getCol() === 0 || 
					$this->row - $parentTile->getRow() === 0){
				//diagonal +10
				return $parentTile->getGCost() + 10;
			} else {
				//non-diagonal + 14
				return $parentTile->getGCost() + 14;
			}
		}
		
		public function isInClosedList() {
			return $this->inClosedList;
		}
		
		public function isInOpenList() {
			return $this->isInOpenList();
		}
		
		public function setHCost($finishTile) {
			$this->hCost = (10*(abs($this->col-$finishTile->getCol()) +
					abs($this->row-$finishTile->getRow())));
		}
		
		public function getTotalCost() {
			return $this->gCost + $this->hCost;
		}
		
		public function getGCost() {
			return $this->gCost;
		}
		
		public function getHCost() {
			return $this->hCost;
		}
		
		public function setParentTile($tile){
			$this->parentTile = $tile;
		}
		
		public function getParentTile() {
			return $this->parentTile;
		}
		
		public function isOpen() {
			return $this->type === 0;
		}
		
		public function getCol() {
			return $this->col;
		}
		
		public function getRow() {
			return $this->row;
		}
		
		public function getType() {
			return $this->type;
		}
		
	}