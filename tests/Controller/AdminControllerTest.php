<?php


namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class AdminControllerTest extends WebTestCase
{
    /**
     * http found is for 302 so that means that was redirected due to fact not loged in
     */
    public function testIfNotLoggedInAndTryAccessAdminPage()
    {
        $url = '/myadmin';
        $httpMethod = 'GET';
        $client = static::createClient();

        $expectedResult = Response::HTTP_FOUND;

        //assert
        $client->request($httpMethod,$url);
        $resultStatusCode = $client->getResponse()->getStatusCode();

        //act
        $this->assertEquals($expectedResult,$resultStatusCode);

    }



}
