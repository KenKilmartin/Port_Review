<?php

namespace App\Controller\Test;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class MattControllerTest extends WebTestCase
{

    public function testFormSubmitsWithValidData()
    {
        // arrange
        $httpMethod = 'GET';
        $url = '/matt/new';
        $client = static::createClient();
        $client->followRedirects(true);

//        $crawler = $client->request($httpMethod, $url);
        $client->request($httpMethod, $url);
        $expectedContent = 'Edit Matt';
        $expectedContentLower = strtolower($expectedContent);

        $age = 1;


        // click link 'about'
        $buttonName = 'matt_submit';

        // Act
        $client->submit($client->request($httpMethod, $url)->selectButton($buttonName)->form([
            'matt[age]' => $age,
        ]));

        $content = $client->getResponse()->getContent();
        $contentLowerCase = strtolower($content);

        // aassert
        $this->assertContains($expectedContentLower, $contentLowerCase);
    }




}