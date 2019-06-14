<?php

namespace App\Registry;

use App\Registry\CalculatorRegistryInterface;
use App\Calculator\Mk1Calculator;
use App\Calculator\Mk2Calculator;
use App\Calculator\CalculatorInterface;


Class CalculatorRegistry implements CalculatorRegistryInterface 
{

    private $calculator1;

    private $calculator2;

    public function __construct(Mk1Calculator $calculator1, Mk2Calculator $calculator2)
    {
        $this->Mk1Calculator = $calculator1;
        $this->Mk2Calculator = $calculator2;
    }
    
    
    /**
     * @param string $model Indicates the model of automaton
     *
     * @return CalculatorInterface|null The calculator, or null if no CalculatorInterface supports that model
     */
    public function getCalculatorFor(string $model): ?CalculatorInterface
    {        
           if ($model == $this->Mk1Calculator->getSupportedModel()){
                $calculatorClass = $this->Mk1Calculator;          
           } elseif ($model == $this->Mk2Calculator->getSupportedModel()) {
               $calculatorClass = $this->Mk2Calculator;
           } else {
                $calculatorClass = NULL; 
           } 

        return $calculatorClass;
    }
}