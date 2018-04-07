<?php


namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class PortControllerTest extends WebTestCase
{

    const PORT_ID = '1';

    public function testPortListPageStatusOkay()
    {
        //arrange
        $url = '/port/';
        $httpMethod = 'GET';
        $client = static::createClient();
        $expectedResult = Response::HTTP_OK;

        //assert
        $client->request($httpMethod,$url);
        $resultStatusCode = $client->getResponse()->getStatusCode();

        //act
        $this->assertEquals($expectedResult,$resultStatusCode);



    }
    public function testNewPortPageRedirectsDueToNotBeingLoggedIn()
    {
        //arrange
        $url = '/port/new';
        $httpMethod = 'GET';
        $client = static::createClient();
        $expectedResult = Response::HTTP_FOUND;

        //assert
        $client->request($httpMethod,$url);
        $resultStatusCode = $client->getResponse()->getStatusCode();

        //act
        $this->assertEquals($expectedResult,$resultStatusCode);



    }

    /**
     * @dataProvider basicPagesTextProvider
     */
    public function testPortPagesContainBasicText($url, $exepctedLowercaseText)
    {
        // Arrange
        $httpMethod = 'GET';
        $client = static::createClient();

        // Act
        $client->request($httpMethod, $url);
        $content = $client->getResponse()->getContent();
        $statusCode = $client->getResponse()->getStatusCode();

        // to lower case
        $contentLowerCase = strtolower($content);

        // Assert - status code 200
        $this->assertSame(Response::HTTP_OK, $statusCode);
        // Assert - expected content
        $this->assertContains(
            $exepctedLowercaseText,
            $contentLowerCase
        );
    }
    public function basicPagesTextProvider()
    {
        return [
            ['/', 'home page'],
            ['/port/', 'port index'],  // this is for port index
            ['/port/'.self::PORT_ID.'/edit', 'edit port'],  // this is for editing Port
            ['/port/'.self::PORT_ID, 'port'], // this is for Port show


        ];
    }

    /**
     * @dataProvider portPagesTextProvider
     * @param $url
     * @param $expectedLowercaseText
     */
    public function testNewPortContainBasicText($url, $expectedLowercaseText)
    {

        $client= $this->login();
        $httpMethod = 'GET';

        // Arrange


        // Act
        $client->request($httpMethod, $url);
        $content = $client->getResponse()->getContent();
        $statusCode = $client->getResponse()->getStatusCode();

        // to lower case
        $contentLowerCase = strtolower($content);

        $this->assertSame(Response::HTTP_OK, $statusCode);
        // Assert - expected content
        $this->assertContains(
            $expectedLowercaseText,
            $contentLowerCase
        );
    }

    public function portPagesTextProvider()
    {
        return [
            ['/port/new', 'create'],

        ];
    }

    public function testDeletePortPageRedirectsDueToNotBeingLoggedIn()
    {
        //arrange
        $url = '/port/'.self::PORT_ID;
        $httpMethod = 'GET';
        $client = static::createClient();
        $expectedResult = Response::HTTP_OK;

        //assert
        $client->request($httpMethod,$url);
        $resultStatusCode = $client->getResponse()->getStatusCode();

        //act
        $this->assertEquals($expectedResult,$resultStatusCode);



    }





    public function login()
    {

        $urlL = '/login';
        $httpMethod = 'GET';
        $client = static::createClient();
        $crawler = $client->request($httpMethod, $urlL);

        // Act
        $button = $crawler->selectButton('login');

        $form = $button->form();

        // set some values
        $form['_username'] = "admin";
        $form['_password'] = "admin";

        // submit the form
        $client->submit($form);

        return $client;
    }

}
