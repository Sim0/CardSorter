<?php

namespace AppBundle\Controller;

use AppBundle\DataTransformer\CardResponseFormatter;
use AppBundle\Domain\CardBox;
use AppBundle\Domain\CardBoxSorter;
use AppBundle\Domain\CardComparer;
use AppBundle\Domain\CardSorter;
use AppBundle\Factory\CardBoxFactory;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\RequestOptions;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="sort_cards")
     * @return Response
     * @param Request $request
     */
    public function cardSorterAction(Request $request)
    {
        $guzzleClient = $this->get('guzzle.client.adatper');
        $apiResponse = $guzzleClient->get($this->getParameter('card_api'));
        $formattedResponse = (new CardResponseFormatter())->transform($apiResponse);

        //Invalid Response Format
        if (null === $formattedResponse) {
            return $this->render('cards/error.html.twig');
        }

        //sorting card as an array of object (CardBox) by a sorter (CardBoxSorter)
        $cardBox = CardBoxFactory::create($formattedResponse->cards);
        $cardBoxSorted = (new CardBoxSorter($cardBox,
            new CardComparer($formattedResponse->categoryOrder, $formattedResponse->valueOrder)))
            ->sort();

        return $this->render('cards/index.html.twig',
            ['OriginalResponse' => json_decode($apiResponse, TRUE),
                'solution' => $formattedResponse->reverseTransform($cardBoxSorted)]
        );
    }

    public function testSortingAction(Request $request, $exerciseId, $data)
    {
        $testResult = $this->get('guzzle.client.adatper')
            ->post(sprintf($this->getParameter('test_api'), $exerciseId), [RequestOptions::JSON => $data]);

        return $this->render('cards/result.html.twig',
            ['exerciseId' => $exerciseId,
                'status' => $testResult->getStatusCode()]
        );
    }
}
