<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\CalculatorService;

class CalculatorController extends AbstractController
{
    #[Route('/calculate',  methods: 'POST')]
    
    public function calculate(Request $request, CalculatorService $calculateService ): JsonResponse
    {
        return $calculateService->calculate($request);
    }
}
