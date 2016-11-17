<?php
/**
 * User: Neofox
 * Date: 09/11/2016
 * Time: 09:48
 */

namespace AppBundle\Resources\Services\Manager;


use AppBundle\Entity\Card;
use AppBundle\Entity\Player;
use AppBundle\Entity\Round;
use AppBundle\Repository\CardRepository;
use AppBundle\Repository\RoundRepository;

class RoundManager
{
    /** @var RoundRepository  */
    protected $roundRepository;

    /**
     * RoundManager constructor.
     *
     * @param RoundRepository $roundRepository
     */
    public function __construct(RoundRepository $roundRepository)
    {
        $this->roundRepository = $roundRepository;
    }

    public function findAll()
    {
        return $this->roundRepository->findAll();
    }

    /**
     * @param array $params
     *
     * @return null|Round
     */
    public function findOneBy(array $params)
    {
        return $this->roundRepository->findOneBy($params);
    }

    /**
     * @param array $params
     *
     * @return Card
     */
    public function create(array $params)
    {
        $round = new Round();

        // Hydrate and set default states.
        $card->hydrate($params);

        $this->roundRepository->save($round);

        return $card;
    }


    public function pickTzar(Round $round)
    {
        /** @var Player $tzar */
        $tzar = $round->getGame()->getPlayers()->get(array_rand($round->getGame()->getPlayers()->toArray()));
        $round->setTzar($tzar);
    }

}