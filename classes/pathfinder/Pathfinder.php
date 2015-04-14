<?php
	class Pathfinder {
		private $grid;
		private $openList;
		private $closedList;
		private $start;
		private $finish;
		
		public function __construct() {
			$this->openList = array();
			$this->closedList = array();
		}
		
		public function setStart($x,$y){
			$this->start = $this->grid->getTile($x,$y);
			$this->openList[] = $this->start;
			$this->start->addToOpenList();
		}
		
		public function setFinish($x,$y){
			$this->finish = $this->grid->getTile($x,$y);
		}
		
		public function findPath() {
			$lastParent = $this->start;
			
			while($lastParent !== $this->finish) {
				$this->addAdjacentTilesToOpenList($lastParent);
				$this->moveToClosedList($lastParent);
				$this->calculateCost($lastParent);
				$lastParent = $this->findTileWithTheLowestCost();
			}
			
			return $this->finalizeSearch($lastParent);
		}
		
		public function finalizeSearch($lastParent){
			$this->closedList[] = $lastParent;
			
			return $this->closedList;
		}
		
		public function findTileWithTheLowestCost() {
			$lowestCost = $this->openList[0]->getTotalCost();
			$tileWithLowestCost = $this->openList[0];
			
			for($i = 1; $i < count($this->openList); $i++) {
				$tile = $this->openList[$i];
				$cost = $tile->getTotalCost();
				if($cost <= $lowestCost) {
					$tileWithLowestCost = $tile;
					$lowestCost = $cost;
				}
			}
			
			return $tileWithLowestCost;
		}
		
		public function calculateCost($potentialParent){
			foreach($this->openList as $tile){
				if($tile->getTotalCost() == 0) {
					$tile->setGCost();
					$tile->setHCost($this->finish);
				}
			}
		}
		
		public function moveToClosedList($tile) {
			$idx = array_search($tile,$this->openList);
			$tile->inOpenList = false;
			array_splice($this->openList, $idx, 1);
			$tile->inClosedList = true;
			$this->closedList[] = $tile;
		}
		
		public function addAdjacentTilesToOpenList($parentTile) {
			$adjacent = $this->getAdjacentTiles($parentTile);
			
			foreach($adjacent as $tile){
				if($tile->isOpen() && !$tile.inClosedList){
					$currentGCost = $tile->getGCost();
					$potentialGCost = $tile->calculateGCost($parentTile);
					if($currentGCost > $potentialGCost) {
						$tile->setParentTile($parentTile);
						$tile->setGCost();
					}
				} else {
					$this->openList[] = $tile;
					$tile->inOpenList = true;
					$tile->setParentTile($parentTile);
				}
			}
		}
		
		public function getAdjacentTiles($centerTile) {
			$col = $centerTile->getCol();
			$row = $centerTile->gerRow();
			$adjacent = array();
			
			for($i=$row-1; i<=$row+1; $i++){
				for($j=$col-1; $j<=$col+1; $j++){
					if($i == $row && $j == $col) continue;
					
					$tile = $this->grid->getTile($j,$i);
					if($tile === null) continue;
					if($tile->inClosedList) continue;
					
					if($i === $row-1 && $j === $col+1) {
						if(!$this->grid->getTile($j,$i+1)->isOpen()) continue;
						elseif(!$this->grid->getTile($j-1,$i)->isOpen()) continue;
					} elseif($i === $row+1 && $j === $col+1) {
						if(!$this->grid->getTile($j,$i-1)->isOpen()) continue;
						elseif(!$this->grid->getTile($j-1,$i)->isOpen()) continue;
					}
					
					$adjacent[] = $tile;
				}
			}
			
			return $adjacent;
		}
		
		public function setGrid($grid){
			$this->grid = $grid;
		}
	}
?>