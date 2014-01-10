<?php

/**
 * Cellular automaton class
 * @author Lukas Kolletzki <lukas@kolletzki.info>
 * @version 2014-01-10
 * @copyright (c) 2014, Lukas Kolletzki
 * @license http://www.gnu.org/licenses/ GNU General Public License, version 3 (GPL-3.0)
 */
class CAphp {

	private $automaton;
	private $sizeX;
	private $sizeY;
	private $generations;
	private $rules;
	private $neigborhood;

	/**
	 * Constructor
	 * @param int $sizeX with of automaton
	 * @param int $sizeY heigh of automaton
	 * @param int $generations amount of generations
	 * @param array $rules rules array (each element stands for the amount of living cells, it's key for the action: 0 = survive, 1 = birth, 2 = die
	 * @param array $startConfig array with cells that should live at start, each field = one cellID
	 * @param int $neighborhood 0: Moore neighborhood; 1: Von Neumann neighborhood
	 */
	public function __construct($sizeX, $sizeY, $generations, $rules, $startConfig, $neighborhood = 0) {
		$this->automaton = array_fill(0, $sizeY, array_fill(0, $sizeX, 0));

		//set start configs
		foreach ($startConfig as $cfg) {
			$this->automaton[(int) ($cfg / $sizeX)][$cfg % $sizeX] = 1;
		}

		$this->sizeX = $sizeX;
		$this->sizeY = $sizeY;
		$this->generations = $generations;
		$this->rules = $rules;
		$this->neigborhood = $neighborhood;
	}

	/**
	 * Let the automaton live
	 * @param int $generations if empty, the automaton will live as many generations as submitted in constructor
	 */
	public function live($generations = false) {
		if (empty($generations)) {
			$generations = $this->generations;
		}

		for ($gen = 0; $gen < $generations; $gen++) {
			for ($y = 0; $y < $this->sizeY; $y++) {
				for ($x = 0; $x < $this->sizeX; $x++) {
					//count living cells
					$alive = 0;

					//row above
					if ($y > 0) {
						if (!$this->neigborhood && $x > 0 && $this->automaton[$y - 1][$x - 1] == 1) {
							$alive++;
						}
						if ($this->automaton[$y - 1][$x] == 1) {
							$alive++;
						}
						if (!$this->neigborhood && $x < $this->sizeX - 1 && $this->automaton[$y - 1][$x + 1] == 1) {#
							$alive++;
						}
					}

					//current row
					if ($x > 0 && $this->automaton[$y][$x - 1] == 1) {
						$alive++;
					}
					if ($x < $this->sizeX - 1 && $this->automaton[$y][$x + 1] == 1) {#
						$alive++;
					}

					//row below
					if ($y < $this->sizeY - 1) {
						if (!$this->neigborhood && $x > 0 && $this->automaton[$y + 1][$x - 1] == 1) {#
							$alive++;
						}
						if ($this->automaton[$y + 1][$x] == 1) {#
							$alive++;
						}
						if (!$this->neigborhood && $x < $this->sizeX -1 && $this->automaton[$y + 1][$x + 1] == 1) {#
							$alive++;
						}
					}

					//alter automaton depending on rule
					switch($this->rules[$alive]) {
						case 1:
							$this->automaton[$y][$x] = 1;
							break;
						case 2:
							$this->automaton[$y][$x] = 0;
							break;
					}
				}
			}
		}
	}
	
	/* -- getter + setter methods -- */
	public function getAutomaton() {
		return $this->automaton;
	}

	public function getSizeX() {
		return $this->sizeX;
	}

	public function getSizeY() {
		return $this->sizeY;
	}

	public function getGenerations() {
		return $this->generations;
	}

	public function getRules() {
		return $this->rules;
	}

	public function getNeigborhood() {
		return $this->neigborhood;
	}

	public function setAutomaton($automaton) {
		$this->automaton = $automaton;
	}

	public function setSizeX($sizeX) {
		$this->sizeX = $sizeX;
	}

	public function setSizeY($sizeY) {
		$this->sizeY = $sizeY;
	}

	public function setGenerations($generations) {
		$this->generations = $generations;
	}

	public function setRules($rules) {
		$this->rules = $rules;
	}

	public function setNeigborhood($neigborhood) {
		$this->neigborhood = $neigborhood;
	}


}
