<?php

namespace App\Tests\Service;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CalculatorServiceTest extends WebTestCase
{
    
        public function testCalculate()
    {
        $client = static::createClient();

        // Envoyer une requête POST avec une expression valide
        $client->request('POST', '/calculate', [], [], [], json_encode(['expression' => '6 / 2 * 2']));
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertEquals(['result' => 6], json_decode($client->getResponse()->getContent(), true));

        // Envoyer une requête POST avec une expression invalide
        $client->request('POST', '/calculate', [], [], [], json_encode(['expression' => '6 / 0']));
        $this->assertEquals(400, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertEquals(['error' => 'Invalid expression'], json_decode($client->getResponse()->getContent(), true));

        // Envoyer une requête POST sans expression
        $client->request('POST', '/calculate');
        $this->assertEquals(400, $client->getResponse()->getStatusCode());
        $this->assertJson($client->getResponse()->getContent());
        $this->assertEquals(['error' => 'Expression is required'], json_decode($client->getResponse()->getContent(), true));
    }
}

