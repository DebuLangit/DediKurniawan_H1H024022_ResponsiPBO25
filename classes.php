<?php
// 1. ABSTRACTION & ENCAPSULATION
// Abstract class sebagai template dasar semua Pokemon
abstract class Pokemon {
    // Encapsulation: Property bersifat protected/private
    protected $name;
    protected $type;
    protected $level;
    protected $hp;
    protected $trainingHistory = [];

    public function __construct($name, $type, $level, $hp) {
        $this->name = $name;
        $this->type = $type;
        $this->level = $level;
        $this->hp = $hp;
    }

    // Abstract method (Polymorphism): Harus diimplementasikan oleh child class
    abstract public function specialMove();

    // Method umum untuk latihan
    public function train($trainingType, $intensity) {
        $xpGain = $intensity * 2; // Logika sederhana
        $hpGain = $intensity * 5;
        
        $prevLevel = $this->level;
        $prevHp = $this->hp;

        // Update stats
        $this->level += $xpGain;
        $this->hp += $hpGain;

        // Mencatat riwayat (Encapsulation logic)
        $this->addHistory($trainingType, $intensity, $prevLevel, $this->level, $prevHp, $this->hp);
    }

    // Setter & Getter (Encapsulation)
    protected function addHistory($type, $intensity, $oldLvl, $newLvl, $oldHp, $newHp) {
        $this->trainingHistory[] = [
            'type' => $type,
            'intensity' => $intensity,
            'old_level' => $oldLvl,
            'new_level' => $newLvl,
            'old_hp' => $oldHp,
            'new_hp' => $newHp,
            'time' => date("Y-m-d H:i:s")
        ];
    }

    public function getHistory() {
        return $this->trainingHistory;
    }

    public function getName() { return $this->name; }
    public function getType() { return $this->type; }
    public function getLevel() { return $this->level; }
    public function getHp() { return $this->hp; }
}

// 2. INHERITANCE
// Class Diglett mewarisi sifat dari Pokemon
class Diglett extends Pokemon {
    public function __construct() {
        // PERUBAHAN 1: HP awal diubah dari 50 menjadi 10
        // Format: parent::__construct(Nama, Tipe, Level, HP)
        parent::__construct("Diglett", "Ground", 5, 10); 
    }

    // 3. POLYMORPHISM
    // Implementasi method abstract khusus untuk Diglett
    public function specialMove() {
        // PERUBAHAN 2: Jurus spesial diganti
        return "Dig, dan Mud Slap";
    }

    // Override method train (Logika bonus tipe Ground tetap dipertahankan)
    public function train($trainingType, $intensity) {
        // Bonus khusus tipe Ground jika latihan Defense
        if ($trainingType == 'Defense') {
            $intensity += 2; // Bonus efisiensi
        }
        parent::train($trainingType, $intensity);
    }
}
?>