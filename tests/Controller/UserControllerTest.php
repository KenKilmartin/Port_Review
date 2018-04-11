<?php


namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;



class UserControllerTest  extends WebTestCase
{
    const USER_ID = '1';
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
            ['/user/'.self::USER_ID, 'user'],
            ['/user/'.self::USER_ID.'/edit', 'edit user'],


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

//    public function testNewUserRedirectsToHomePageAfterSubmission()
//    {
//
//        $url = '/user/new';
//        $client= $this->login();
//        $client->followRedirects(true);
//        $httpMethod = 'GET';
//
//
//        // Act
//        $crawler = $client->request($httpMethod, $url);
//
//        // - should be on form page now
//        $userName = 'This is a test test';
//        $expectedLowercaseText = strtolower($userName);
//        $password = '1.png';
//        $role = ['Role_User'];
//
//        $buttonName = 'user_submit';
//
//        // get reference to button
//
//        $buttonCrawlerNode = $crawler->selectButton($buttonName);
//
//        // Act
//        $formData =
//            [
//                'user[userName]'  => $userName,
//                'user[roles][]'  => $role,
//                'user[password]'  => $password,
//
//            ];
//
//        $form = $buttonCrawlerNode->form($formData);
//
//
//        $client->submit($form);
//
//        $content = $client->getResponse()->getContent();
//        $contentAsLowerCae = strtolower($content);
//
//        //Assert
//        $this->assertContains($expectedLowercaseText, $contentAsLowerCae);
//    }



}