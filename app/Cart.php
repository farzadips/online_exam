<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart
{
    public $questions = null;
    public $totalQty = 0;
    public function __construct($oldcart)
    {
        if ($oldcart){
            $this->questions = $oldcart->questions;
            $this->totalQty = $oldcart->totalQty;
        }
    }

    public function add($question,$id)
    {
        $storeQuestion = ['qty'=>0,'question'=>$question];
        if ($this->questions){
            if (array_key_exists($id,$this->questions)){
                $storeQuestion = $this->questions[$id];
            }
        }
        $storeQuestion['qty']++;
        $this->questions[$id] = $storeQuestion;
        $this->totalQty ++;
    }
}
