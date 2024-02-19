<?php

namespace App\Service;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
class CalculatorService{

    public function calculate(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $expression = $data['expression'] ?? null;
        if (!$expression) {
            return new JsonResponse(['error' => 'Expression is required'], 400);
        }

        try {
            $result = eval("return $expression;");
            return new JsonResponse(['result' => $result]);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Invalid expression'], 400);
        }
    }
}