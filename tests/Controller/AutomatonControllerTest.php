<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AutomatonControllerTest extends WebTestCase
{
    public function testEasyTaskForMk1()
    {
        $client = static::createClient();

        $client->request('GET', '/automaton/mk1/change/2');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertSame('{"bill10":0,"bill5":0,"coin2":0,"coin1":2}', $client->getResponse()->getContent());
    }

    public function testEasyTaskForMk2()
    {
        $client = static::createClient();

        $client->request('GET', '/automaton/mk2/change/2');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertSame('{"bill10":0,"bill5":0,"coin2":1,"coin1":0}', $client->getResponse()->getContent());
    }

    public function testImpossibleTaskForMk2()
    {
        $client = static::createClient();

        $client->request('GET', '/automaton/mk2/change/3');

        $this->assertEquals(204, $client->getResponse()->getStatusCode());
        $this->assertEmpty($client->getResponse()->getContent());
    }

    /**
     * @expectedException \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function testUnknownModel()
    {
        $client = static::createClient();

        $client->request('GET', '/automaton/mk3/change/2');

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }
}