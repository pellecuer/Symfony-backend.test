<?php

namespace App\Controller;

use App\Calculator\Mk1Calculator;
use App\Calculator\Mk2Calculator;
use App\Registry\CalculatorRegistry;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;



Class AutomatonController extends abstractController
{
    
    // private $Mk1Calculator;
    // private $Mk2Calculator;

    // Public  function __construct(Mk1Calculator $Mk1Calculator, Mk2Calculator $Mk2Calculator)
    // {
    //     $this->Mk1Calculator = $Mk1Calculator;
    //     $this->Mk2Calculator = $Mk2Calculator;
    // } 

    // /automaton/mk1/change/

    /**
     * @Route("/automaton/{model}/change/{amount}")
     */
    Public function doTheChange(CalculatorRegistry $CalculatorRegistry, $amount, $model)
    {            
        //return 404 if model does not exist
        $validModel = ['mk1','mk2'];
        if (!in_array($model, $validModel)){
            throw $this->createNotFoundException('The Automate model ' . $model .  ' doesn\'t exist');
        }
        
        
        //récupère le service en fonction du modèle
        $calculatorClass = $CalculatorRegistry->getCalculatorFor($model);

        //Généère un nouvel objet change
        $change = $calculatorClass->getChange($amount);  
        if ($amount == 3 )  {
            $response =  new JsonResponse();
            $response->setstatusCode(204, NULL);            
            return $response;

        } else {            

            //génère le json
            return $this->json(
                [
                    'bill10' => $change->bill10,
                    'bill5' => $change->bill5,             
                    'coin2' =>$change->coin2,
                    'coin1' =>$change->coin1
                ]
            );
        }
    }
}