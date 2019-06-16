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
    /**
     * @Route("/automaton/{model}/change/{amount}")
     */
    Public function doTheChange(CalculatorRegistry $CalculatorRegistry, $amount, $model)
    {            
        //return 404 if model does not exist
        $validModel = ['mk1','mk2'];
        if (!in_array(strtolower($model), $validModel)){
            throw $this->createNotFoundException('The Automate model ' . $model .  ' doesn\'t exist');
        } 

        $calculatorClass = $CalculatorRegistry->getCalculatorFor($model);
        $change = $calculatorClass->getChange($amount);

        if ($amount == 3 || $amount == 1 )  {
            $response =  new JsonResponse();
            $response->setstatusCode(204, NULL);            
            return $response;

        } else {
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