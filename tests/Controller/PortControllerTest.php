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



    public function testNewPortRedirectsToHomePageAfterSubmission()
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
        $photo = 'p1.png';
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


        $client->submit($form);

        $content = $client->getResponse()->getContent();
        $contentAsLowerCae = strtolower($content);

         //Assert
         $this->assertContains($expectedLowercaseText, $contentAsLowerCae);
    }

    public function testEditPortRedirectsToHomePageAfterSubmission()
    {

        $url = '/port/'.self::PORT_ID.'/edit';
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

    public function testPortTextSearch()
    {

        $client= $this->login();

        $httpMethod = 'GET';
        $url='/port/';
        $client->followRedirects(true);

        $client->request($httpMethod,$url);
        $expectedContent='ruby';
        $q='ruby';

        // click link to search cheesecakes
        $buttonName = 'search_by_text';

        // Act
        $client->submit($client->request($httpMethod, $url)->selectButton($buttonName)->form([
            'q'=>$q,
        ]));

        $content = $client->getResponse()->getContent();
        $contentLowerCase = strtolower($content);

        //assert
        $this->assertContains($expectedContent, $contentLowerCase);

    }
    public function testPortDateSearch()
    {

        $client= $this->login();

        $httpMethod = 'GET';
        $url='/port/';
        $client->followRedirects(true);

        $client->request($httpMethod,$url);
        $expectedContent='search between dates';
        $d1='2017-04-01';
        $d2='2018-04-01';


        $buttonName = 'search_by_date';

        // Act
        $client->submit($client->request($httpMethod, $url)->selectButton($buttonName)->form([
            'd1'=>$d1,
            'd2'=>$d2,
        ]));

        $content = $client->getResponse()->getContent();
        $contentLowerCase = strtolower($content);

        //assert
        $this->assertContains($expectedContent, $contentLowerCase);

//        //assert
//        $this->assertContains($expectedLowercaseText, $contentAsLowerCase);
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
