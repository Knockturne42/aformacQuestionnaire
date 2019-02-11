<?php 

class classes{
    private $contentClasses; 
    private $classe;

    public function __construct($contentClasses)
    {
        $this->contentClasses = $contentClasses;
        $this->classe = '';
    }
    public function __set($property, $value)
	{
		if(property_exists('classes', $property))
			$this->$property = $value;
		else
			throw new Exception("property invalid", 1);
	}

	public function __get($property)
	{
		if (property_exists('classes', $property))
			return($this->$property);
		else
			throw new Exception("property invalid", 1);
    }
    public function assembleClasses()
	{
		$this->classe = ' class="'.$this->contentClasses.'" ';
		return $this->classe;
	}
    
}
?>