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
        $changeValues = [10, 5, 2];
        $result = [
            'nb10' =>0,
            'nb5' =>0,
            'nb2' =>0,            
        ];
        foreach ($changeValues as $changeValue) {
            if ($amount >= $changeValue ){                
                $key = 'nb' . $changeValue;                
                $result[$key] = floor($amount/$changeValue);                
                $amount = $amount%$changeValue;                 
            } else {
                $key = 'nb' . $changeValue;
                $result[$key] = 0;
            }
        }       

         
        $change = new Change();        
        $change->bill10 = $result['nb10'];
        $change->bill5 = $result['nb5'];
        $change->coin2 = $result['nb2'];        

        return $change; 
    }
}