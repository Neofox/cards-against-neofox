<?php
/**
 * User: Neofox
 * Date: 09/11/2016
 * Time: 09:48
 */

namespace AppBundle\Resources\Services\Manager;


use AppBundle\Entity\Card;
use AppBundle\Repository\CardRepository;

class CardManager
{
    /** @var CardRepository  */
    protected $cardRepository;

    public function __construct(CardRepository $cardRepository)
    {
        $this->cardRepository = $cardRepository;
    }

    public function findAll()
    {
        return $this->cardRepository->findAll();
    }

    /**
     * @param array $params
     *
     * @return null|Card
     */
    public function findOneBy(array $params)
    {
        return $this->cardRepository->findOneBy($params);
    }

    /**
     * @param array $params
     *
     * @return Card
     */
    public function create(array $params)
    {
        $card = new Card();

        // Hydrate and set default states.
        $card->hydrate($params);

        $this->cardRepository->save($card);

        return $card;
    }

}