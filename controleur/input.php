<?php

include_once 'class.php';

class input {
	
	private $nameInput;
	private $typeInput;
	private $valueInput;
	private $input;
	private $classInput;
	private $minRange;
	private $maxRange;

	public function __construct($nameInput, $typeInput, $valueInput, $classInput, $minRange= '', $maxRange = '')
	{
		$this->nameInput = $nameInput;
		$this->typeInput = $typeInput;
		$this->classInput = $classInput;
		$this->valueInput = $valueInput;
		$this->minRange = $minRange;
		$this->maxRange = $maxRange;
	}
    public function makeClasses(){
		$classInput= new classes($this->classInput);
		$classInput= $classInput->assembleClasses();
		return $classInput;
    }
	public function __set($property, $value)
	{
		if(property_exists('input', $property))
			$this->$property = $value;
		else
			throw new Exception("property invalid", 1);
	}

	public function __get($property)
	{
		if (property_exists('input', $property))
			return($this->$property);
		else
			throw new Exception("property invalid", 1);
	}

	public function assembleInput()
	{
		$this->input = '<input '.$this->makeClasses($this->classInput).' type="'.$this->typeInput.'" name="'.$this->nameInput.'" value="'.$this->valueInput.'" min="'.$this->minRange.'" max="'.$this->maxRange.'">';
		return $this->input;
	}
}

?>