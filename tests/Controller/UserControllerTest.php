<?php


namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;


class UserControllerTest  extends WebTestCase
{

    /**
     * @dataProvider userPagesTextProvider
     * @param $url
     * @param $expectedLowercaseText
     */
    public function testUserPagesContainBasicText($url, $expectedLowercaseText)
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

    public function userPagesTextProvider()
    {
        return [
            ['/user/', 'user index'],
            ['user/new','create new user'],
            ['/user/125', 'user'],
            ['/user/125/edit', 'edit user'],

        ];
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