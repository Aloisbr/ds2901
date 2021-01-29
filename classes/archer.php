<?php

class Archer extends Character {

    private $arrow = 4;
    private $nbrShoot = 1;
    private $multiplier = 1;
    private $aim = false;

    public function __construct($name) {
        parent::__construct($name);
        $this->damage = 20;
    }
    
    public function turn($target) {
        $rand = rand(1, 10);
        if($this->arrow > 0) {
            if($rand < 4 && !($this->aim) && $this->arrow > 1) 
                return $this->doubleShoot();
            elseif($rand < 7 && !($this->aim))
                return $this->aimWeakness();
            else
                return $this->shootArrow($target);
        }
        else 
            return $this->attack($target);

    }

    public function shootArrow($target) {
        $target->setHealthPoints($this->damage * $this->nbrShoot * $this->multiplier);
        
        if($this->nbrShoot > 1)
            $status = "$this->name tire deux flèches sur $target->name ! Il reste $target->healthPoints points de vie à $target->name !";
        elseif($this->multiplier > 1)
            $status = "$this->name tire une flèche dans la poitrine de $target->name ! Il reste $target->healthPoints points de vie à $target->name !";
        else 
            $status = "$this->name tire une flèche sur $target->name ! Il reste $target->healthPoints points de vie à $target->name !";
    
        $this->arrow -= 1 * $this->nbrShoot;
        $this->nbrShoot = 1;
        $this->multiplier = 1;
        return $status;
    }

    public function doubleShoot() {
        $this->aim = true;
        $this->nbrShoot = 2;
        return "$this->name arme son arc ...";
    }

    public function aimWeakness() {
        $this->aim = true;
        $this->multiplier = rand(3,6) / 2;
        return "$this->name se concentre ...";
    }

    public function attack($target) {
        $target->setHealthPoints(8);
        return "$this->name donne un coup de dague sur $target->name ! Il reste $target->healthPoints points de vie à $target->name !";
    }
}

?>