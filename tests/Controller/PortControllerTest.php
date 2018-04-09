<?php


namespace App\Tests\Controller;

use App\Entity\Port;
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
        $client->followRedirects(true);
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



    public function testMatt99()
    {

        $url = '/port/new';
        $client= $this->login();
        $client->followRedirects(true);
        $httpMethod = 'GET';

        // Arrange


        // Act
        $crawler = $client->request($httpMethod, $url);

        // - should be on form page now
        $portName = 'This is a test test';
        $photo = '1.png';
        $description = 'This is a test test';
        $expectedLowercaseText = strtolower($description);

        $priceRange = 32;
        $reviewedBy = 'Admin';
        $date = 'This is a test test';
        $isPublic = 1;
        $doesUserWantToMakePublic = 1;
        $ingredients ='nightmares';
        $buttonName = 'port_submit';


        // get reference to button

        $buttonCrawlerNode = $crawler->selectButton($buttonName);



        // Act


        $formData =
            [
                'port[portName]'  => $portName,

                'port[photo]'  => $photo,
                'port[description]'  => $description,
                'port[ingredients]'  => $ingredients,
                'port[priceRange]'  => $priceRange,
                'port[reviewedBy]'  => $reviewedBy,
                'port[date][date][year]'  => 2018,
                'port[date][date][month]'  => 1,
                'port[date][date][day]'  => 2,
                'port[date][time][hour]'  => 10,
                'port[date][time][minute]'  => 45,
                'port[isPublic]'  => $isPublic,
                'port[doesUserWantToMakePublic]'  => $doesUserWantToMakePublic,
            ];


        $form = $buttonCrawlerNode->form($formData);

//        $client->submit($client->request($httpMethod, $url)->selectButton($buttonName)->form([
//            'port_portName'  => $portName,
//
//            'port_photo'  => $photo,
//            'port_description'  => $description,
//            'port_ingredients'  => $ingredients,
//            'port_priceRange'  => $priceRange,
//            'port_reviewedBy'  => $reviewedBy,
//            'port_date'  => $date,
//            'port_isPublic'  => $isPublic,
//            'port_doesUserWantToMakePublic'  => $doesUserWantToMakePublic,
//


////        $form = $buttonCrawlerNode->form();
//
//
//        $form['port_portName'] = $portName;
//        $form['port_photo'] = $photo;
//        $form['port_description'] = $description;
//        $form['port_ingredients'] = $ingredients;
//        $form['port_priceRange'] =   $priceRange;
//        $form['port_reviewedBy'] = $reviewedBy;
//        $form['port_date'] = $date;
//        $form['port_isPublic'] = $isPublic;
//        $form['port_doesUserWantToMakePublic'] = $doesUserWantToMakePublic;
//
//


//        var_dump($form);
//        die();


        // submit form
//        $form->submit($formData);
        $client->submit($form);

        $content = $client->getResponse()->getContent();
        $contentAsLowerCae = strtolower($content);

         //Assert
         $this->assertContains($expectedLowercaseText, $contentAsLowerCae);
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


//    public function testNewPortFormRedirect()
//    {
//        // Arrange
//        $url = '/port/new';
//        $client= $this->login();
//        $httpMethod = 'GET';
////       $client->request($httpMethod, $url);
//        $expectedURL = '/';
//
//        $crawler = $client->request($httpMethod, $url);
//
//        $button = $crawler->selectButton('Save');
//        $form = $button->form();
//
//
//        $form['portName'] = 'This is a test test';
//        $form['photo'] = '1.png';
//        $form['description'] = 'This is a test test';
//        $form['priceRange'] = 32;
//        $form['reviewedBy'] = 'Admin';
//        $form['date'] = 'This is a test test';
//        $form['isPublic'] = 0;
//        $form['doesUserWantToMakePublic'] = 0;
//        $form['ingredients'] ='nightmares';

//        return $client;
        //     $form['buttonName'] = 'Save';

//        $portName = 'This is a test test';
//        $photo = '1.png';
//        $description = 'This is a test test';
//        $priceRange = 32;
//        $reviewedBy = 'Admin';
//        $date = 'This is a test test';
//        $isPublic = 0;
//        $doesUserWantToMakePublic = 0;
//        $ingredients ='nightmares';
//        $buttonName = 'Save';
//
//
//        // Act
//        $client->submit($client->request($httpMethod, $url)->selectButton($buttonName)->form([
//            'portName'  => $portName,
//
//            'photo'  => $photo,
//            'description'  => $description,
//            'ingredients'  => $ingredients,
//            'priceRange'  => $priceRange,
//            'reviewedBy'  => $reviewedBy,
//            'date'  => $date,
//            'isPublic'  => $isPublic,
//            'doesUserWantToMakePublic'  => $doesUserWantToMakePublic,
//
//        ]));
//        $content = $client->getResponse()->getContent();
        // Assert
        // $this->assertContains($expectedURL, $content);
//
//        $this->assertContains($expectedURL, $client);
//    }


//*********************************************************************IDEA FOR REDIRECT *******************************************************************************
//    public function testNewPortRedirect()
//    {
//        $client->followRedirect();
//
//        // to lower case
//        $contentLowerCase = strtolower($content);
//
//        $this->assertSame(Response::HTTP_OK,$client->getResponse()->getStatusCode() );
//
//    }
//    public function testNewPortRedirect()
//    {
//        $client = static ::createClient([], [
//            '_username' => 'admin',
//            '_password' => 'admin',
//        ]);
//
//        $client->request('Get','/?id=51');
//        $client->followRedirect();
//
//        $this->assertSame(Response::HTTP_OK,$client->getResponse()->getStatusCode());
//
//    }





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
