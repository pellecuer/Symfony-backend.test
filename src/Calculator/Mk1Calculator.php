<?php

namespace App\Calculator;

use App\Calculator\CalculatorInterface;
use App\Model\Change;

//Automate qui interoge le service calculator pour connaitre le nombre de billets et pièces à rendre en fonction des billets disponibles
    //Chiffres ronds
    //Monnaie optimale
    //N a accès qu'au pièces de 1
Class Mk1Calculator implements CalculatorInterface 
{
    /**
     * @return string Indicates the model of automaton
     */
    public function getSupportedModel(): string
    {        

        return 'mk1';

    }

    /**
     * @param int $amount The amount of money to turn into change
     *
     * @return Change|null The change, or null if the operation is impossible
     */
    public function getChange(int $amount): ?Change    
    {      
        $changeValue = 1;         
        
        if ($amount >= $changeValue ){
            $coin1 = floor($amount/$changeValue);        

        } else {
            $coin1 = 0;
        }        
         
        $change = new Change();        
        $change->coin1 = $coin1;

        return $change; 
    }
}