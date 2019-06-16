<?php

namespace App\Calculator;

use App\Calculator\CalculatorInterface;
use App\Model\Change;

//Automate qui interoge le service calculator pour connaitre le nombre de billets et pièces à rendre en fonction des billets disponibles
    //Chiffres ronds
    //Monnaie optimale
    //N a accès qu'au pièces de 1
Class Mk2Calculator implements CalculatorInterface 
{
    /**
     * @return string Indicates the model of automaton
     */
    public function getSupportedModel(): string
    {        
        return 'mk2';
    }

    /**
     * @param int $amount The amount of money to turn into change
     *
     * @return Change|null The change, or null if the operation is impossible
     */
    public function getChange(int $amount): ?Change
    {  
        $bill5 = 0;
        $coin2 = 0;
        $bill10 = 0; 

        $bill10 = floor($amount/10);           
        $i = $amount-($bill10*10);


        //Case 1: from 0 to 9 + multiples ending with 0 to 9 (execpt 1 et 3)        
        switch ($i) {
            case 0:                 
                $bill5 = 0;
                $coin2 = 0;
                break;
            case 2:               
                $bill5 = 0;
                $coin2 = 1;
                break;
            case 4:                 
                $bill5 = 0;
                $coin2 = 2;
                break;            
            case 5:                 
                $bill5 = 1;
                $coin2 = 0;
                break;
            case 6:                
                $bill5 = 0;
                $coin2 = 3;
                break;
            case 7:                
                $bill5 = 1;
                $coin2 = 1;
                break;
            case 8:                
                $bill5 = 0;
                $coin2 = 4;
                break;
            case 9:                 
                $bill5 = 1;
                $coin2 = 2;
                break;
        }

        // Special cases of 11 and 13
        if ($amount == 11){
            $bill10 = 0;         
            $bill5 = 1;
            $coin2 = 3;
        }

        if ($amount == 13) {            
            $bill10 = 0;
            $bill5 = 1;
            $coin2 = 4;
        }

        
        //Special cases of amount greater than 20, ending by 1
        if ($amount>20 && $amount%10 == 1) {
            $bill10 = floor($amount/10)-1;
            $bill5 = 1;
            $coin2 = 3;
        }

        ///Special cases of amount greater than 20, ending by 3
         if ($amount>20 && $amount%10 == 3) {
            $bill10 = floor($amount/10)-1;
            $bill5 = 1;
            $coin2 = 4;
        }

        //Special cases of 1 and 3 amount
        if ($amount == 1 | $amount == 3) {
            $change = NULL;


        } else {
            $change = new Change();        
            $change->bill10 = $bill10;
            $change->bill5 = $bill5;
            $change->coin2 = $coin2;
        }

        return $change; 
    }
}