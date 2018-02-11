<?php

namespace AppBundle\Controller;

use AppBundle\DataTransformer\CardResponseFormatter;
use AppBundle\Form\ResultType;
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

        try {

            if (null === $formattedResponse) {
                return;
            }

            $cardBox = CardBoxFactory::create($formattedResponse->cards);
            $cardBoxSorter = (new CardBoxSorter($cardBox, new CardComparer($formattedResponse->categoryOrder, $formattedResponse->valueOrder)));
            $cardBoxSorter->sort();
            $result = $formattedResponse->reverseTransform($cardBoxSorter->getCardBox());


        } catch (\Exception $e) {

        }
        $form = $this->createForm(ResultType::class, null, ['data' => ['result_data' => serialize($result)]]);

        return $this->render('cards/index.html.twig',
            ['exerciseId' => $formattedResponse->exerciseId,
                'challenge' => $formattedResponse->cards,
                'categoryOrder' => $formattedResponse->categoryOrder,
                'valueOrder' => $formattedResponse->valueOrder,
                'OriginalResponse' => $apiResponse,
                'result' => $formattedResponse->reverseTransform($cardBoxSorter->getCardBox()),
                'form' => $form->createView()]
        );
    }

    public function testSortingAction(Request $request, $exerciseId, $data)
    {
        try {
            $testResult = $this->get('guzzle.client.adatper')->post($this->getParameter('test_api') . $exerciseId, [
                RequestOptions::JSON => $data]);
            $status = $testResult->getStatusCode();

        } catch (ServerException $e) {

        }
        return $this->render(
            'cards/test.html.twig', ['exerciseId' => $exerciseId, 'status' => $status]
        );
    }
}
