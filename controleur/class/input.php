<?php

include_once 'classe.php';

class input {
	
	private $nameInput;
	private $typeInput;
	private $valueInput;
	private $input;
    private $classInput;
    
	public function __construct($nameInput, $typeInput, $valueInput, $classInput)
	{
		$this->nameInput = $nameInput;
		$this->typeInput = $typeInput;
		$this->classInput = $classInput;
		$this->valueInput = $valueInput;
    }
    
    public function makeClasses($classInput){
		$classInput= new classes($classInput);
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
		$this->input = '<input '.$this->makeClasses($this->classInput).' type="'.$this->typeInput.'" name="'.$this->nameInput.'" value="'.$this->valueInput.'">';
		return $this->input;
	}
}
?>
