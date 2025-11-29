<?php

abstract class Pokemon {
    private $name;
    protected $type;
    protected $level;
    protected $hp;
    protected $maxHp;
    protected $specialMoves;
    
    /**
     * Constructor
     * @param string $name 
     * @param string $type 
     * @param int $level 
     * @param int $hp 
     * @param array $specialMoves 
     */
    public function __construct($name, $type, $level, $hp, $specialMoves) {
        $this->name = $name;
        $this->type = $type;
        $this->level = $level;
        $this->hp = $hp;
        $this->maxHp = $hp;
        $this->specialMoves = $specialMoves;
    }
    

    public function getName() {
        return $this->name;
    }
    
    public function getType() {
        return $this->type;
    }
    
    public function getLevel() {
        return $this->level;
    }
    
    public function getHp() {
        return $this->hp;
    }
    
    public function getMaxHp() {
        return $this->maxHp;
    }
    
    public function getSpecialMoves() {
        return $this->specialMoves;
    }
    
    protected function setLevel($level) {
        $this->level = $level;
    }
    
    protected function setHp($hp) {
        $this->hp = $hp;
        if ($this->hp > $this->maxHp) {
            $this->maxHp = $this->hp;
        }
    }
    

    abstract public function train($trainingType, $intensity);
    

    abstract public function specialMove();
    
    public function getInfo() {
        return [
            'name' => $this->name,
            'type' => $this->type,
            'level' => $this->level,
            'hp' => $this->hp,
            'maxHp' => $this->maxHp,
            'specialMoves' => $this->specialMoves
        ];
    }
    

    public function displayStatus() {
        return "{$this->name} (Type: {$this->type}) - Level {$this->level} - HP: {$this->hp}/{$this->maxHp}";
    }
}

?>
