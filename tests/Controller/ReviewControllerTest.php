<?php


namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ReviewControllerTest extends WebTestCase
{

    const REVIEW_ID = '1';

    public function testReviewPageStatusOkay()
    {
        //arrange
        $url = '/review/';
        $httpMethod = 'GET';
        $client = static::createClient();
        $expectedResult = Response::HTTP_OK;

        //assert
        $client->request($httpMethod,$url);
        $resultStatusCode = $client->getResponse()->getStatusCode();

        //act
        $this->assertEquals($expectedResult,$resultStatusCode);

    }
    /**
     * @dataProvider basicPagesTextProvider
     */
    public function testReviewPagesContainBasicText($url, $exepctedLowercaseText)
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

            ['/review/'.self::REVIEW_ID, 'review'],
            ['/review/'.self::REVIEW_ID.'/edit', 'edit review'],
            ['/review/'.self::REVIEW_ID, 'place of purchase'],
            ['/review/new', 'create new review'],
            ['review/upVote/'.self::REVIEW_ID, 'review'],
            ['review/downVote/'.self::REVIEW_ID, 'review'],


        ];
    }

    public function testEditReviewRedirectsToHomePageAfterSubmission()
    {
        // Arrange

        $url = '/review/'.self::REVIEW_ID.'/edit';
        $client= $this->login();
        $client->followRedirects(true);
        $httpMethod = 'GET';

        // Act
        $crawler = $client->request($httpMethod, $url);

        // - should be on form page now
        $review = 'This is a was just simply devine';
        $pricePaid = '32';
        $description = 'This is a test test';
        $expectedLowercaseText = strtolower($description);
        $user = 2;

        $placeOfPurchase = 'tesco';
      //  $date = 'This is a test test';
        $isPublic = 1;
        $doesUserWantToMakePublic = 1;
        $numOfStars = 2.5;
        $buttonName = 'review_submit';

        // get reference to button

        $buttonCrawlerNode = $crawler->selectButton($buttonName);

        // Act
        $formData =
            [
                'review[review]'  => $review,

                'review[placeOfPurchase]'  => $placeOfPurchase,
                'review[pricePaid]'  => $pricePaid,
                'review[numOfStars]'  => $numOfStars,
                'review[user]'  => $user,

                'review[date][year]'  => 2018,
                'review[date][month]'  => 1,
                'review[date][day]'  => 2,

                'review[isPublic]'  => $isPublic,
                'review[doesUserWantToMakePublic]'  => $doesUserWantToMakePublic,
            ];

        $form = $buttonCrawlerNode->form($formData);

        $client->submit($form);

        $content = $client->getResponse()->getContent();
        $contentAsLowerCae = strtolower($content);

        //Assert
        $this->assertContains($expectedLowercaseText, $contentAsLowerCae);
    }

    public function testNewReviewRedirectsToHomePageAfterSubmission()
    {
        // Arrange

        $url = 'review/new';
        $client= $this->login();
        $client->followRedirects(true);
        $httpMethod = 'GET';

        // Act
        $crawler = $client->request($httpMethod, $url);

        // - should be on form page now
        $review = 'This is a was just simply devine';
        $pricePaid = '32';
        $description = 'This is a test test';
        $expectedLowercaseText = strtolower($description);
        $user = 2;

        $placeOfPurchase = 'tesco';
        //  $date = 'This is a test test';
        $isPublic = 1;
        $doesUserWantToMakePublic = 1;
        $numOfStars = 2.5;
        $buttonName = 'review_submit';

        // get reference to button

        $buttonCrawlerNode = $crawler->selectButton($buttonName);

        // Act
        $formData =
            [
                'review[review]'  => $review,

                'review[placeOfPurchase]'  => $placeOfPurchase,
                'review[pricePaid]'  => $pricePaid,
                'review[numOfStars]'  => $numOfStars,
                'review[user]'  => $user,

                'review[date][year]'  => 2018,
                'review[date][month]'  => 1,
                'review[date][day]'  => 2,




                'review[isPublic]'  => $isPublic,
                'review[doesUserWantToMakePublic]'  => $doesUserWantToMakePublic,
            ];

        $form = $buttonCrawlerNode->form($formData);

        $client->submit($form);

        $content = $client->getResponse()->getContent();
        $contentAsLowerCae = strtolower($content);

        //Assert
        $this->assertContains($expectedLowercaseText, $contentAsLowerCae);
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