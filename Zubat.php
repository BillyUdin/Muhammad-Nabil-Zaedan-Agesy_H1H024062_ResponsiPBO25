<?php
require_once 'Pokemon.php';

class Zubat extends Pokemon {
    private $flightSpeed;
    private $poisonLevel;
    

    public function __construct() {

        parent::__construct(
            "Zubat",                    
            "Poison/Flying",           
            5,                          
            40,                        
            ["Wing Attack", "Poison Fang", "Supersonic", "Bite"] 
        );
        

        $this->flightSpeed = 50;
        $this->poisonLevel = 30;
    }
    
    /**
     * POLYMORPHISM: Override method train() dari parent
     * Implementasi training khusus untuk Zubat
     * 
     * @param string $trainingType - Jenis latihan (Attack/Defense/Speed)
     * @param int $intensity - Intensitas latihan (1-10)
     * @return array - Hasil training
     */
    public function train($trainingType, $intensity) {
        $oldLevel = $this->getLevel();
        $oldHp = $this->getHp();
        
        $levelIncrease = 0;
        $hpIncrease = 0;
        $message = "";
        
        switch($trainingType) {
            case "Attack":

                $levelIncrease = floor($intensity * 1.5);
                $hpIncrease = $intensity * 3;
                $this->poisonLevel += $intensity * 2;
                $message = "Zubat meningkatkan kekuatan serangan racun! Poison level naik menjadi {$this->poisonLevel}!";
                break;
                
            case "Defense":

                $levelIncrease = floor($intensity * 1.0);
                $hpIncrease = $intensity * 5;
                $message = "Zubat meningkatkan pertahanan dengan melatih sayapnya!";
                break;
                
            case "Speed":

                $levelIncrease = floor($intensity * 2.0);
                $hpIncrease = $intensity * 2;
                $this->flightSpeed += $intensity * 3;
                $message = "Zubat terbang lebih cepat! Flight speed naik menjadi {$this->flightSpeed}!";
                break;
        }
        

        $this->setLevel($oldLevel + $levelIncrease);
        $this->setHp($oldHp + $hpIncrease);
        
        return [
            'success' => true,
            'message' => $message,
            'oldLevel' => $oldLevel,
            'newLevel' => $this->getLevel(),
            'oldHp' => $oldHp,
            'newHp' => $this->getHp(),
            'trainingType' => $trainingType,
            'intensity' => $intensity
        ];
    }
    
    /**
     * POLYMORPHISM: Override method specialMove() dari parent
     * Implementasi jurus spesial Zubat
     * 
     * @return string - Deskripsi special move
     */
    public function specialMove() {
        $moves = $this->getSpecialMoves();
        $randomMove = $moves[array_rand($moves)];
        
        $descriptions = [
            "Wing Attack" => "Zubat mengepakkan sayapnya dengan kuat dan menyerang dengan kecepatan tinggi! 💨",
            "Poison Fang" => "Zubat menggigit dengan taring beracun! Racun menyebar ke target! ☠️",
            "Supersonic" => "Zubat mengeluarkan gelombang ultrasonik yang membingungkan lawan! 🔊",
            "Bite" => "Zubat menggigit dengan kuat menggunakan taring tajamnya! 🦇"
        ];
        
        return [
            'move' => $randomMove,
            'description' => $descriptions[$randomMove] ?? "Zubat menggunakan {$randomMove}!",
            'power' => $this->calculateMovePower($randomMove)
        ];
    }
    

    private function calculateMovePower($moveName) {
        $basePower = [
            "Wing Attack" => 60,
            "Poison Fang" => 50,
            "Supersonic" => 40,
            "Bite" => 60
        ];
        
        $power = ($basePower[$moveName] ?? 50) + ($this->getLevel() * 2);
        return $power;
    }
    

    public function getFlightSpeed() {
        return $this->flightSpeed;
    }
    
    public function getPoisonLevel() {
        return $this->poisonLevel;
    }
    

    public function displayStatus() {
        $baseStatus = parent::displayStatus();
        return $baseStatus . " | Flight Speed: {$this->flightSpeed} | Poison Level: {$this->poisonLevel}";
    }
}
?>