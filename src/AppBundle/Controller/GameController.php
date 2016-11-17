<?php
/**
 * User: Neofox
 * Date: 09/11/2016
 * Time: 09:41
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\{
    Request, Response
};
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Serializer;

class GameController extends Controller
{

    /**
     * @Route("/game/list", name="game_list")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function listAction(Request $request)
    {
        /** @var Serializer $serializer */
        $serializer = $this->get('serializer');
        return $this->render('game/list.html.twig', [
            // We pass an array as props
            'props' => $serializer->normalize(
                ['games' => $this->get('game.manager')->findAll(),
                 // '/' or maybe '/app_dev.php/', so the React Router knows about the root
                 'baseUrl' => $this->generateUrl('homepage'),
                 'location' => $request->getRequestUri()
                ])
        ]);
    }




}