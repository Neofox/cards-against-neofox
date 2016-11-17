<?php
/**
 * User: Neofox
 * Date: 09/11/2016
 * Time: 09:48
 */

namespace AppBundle\Resources\Services\Manager;


use AppBundle\Entity\Card;
use AppBundle\Entity\Deck;
use AppBundle\Repository\CardRepository;
use AppBundle\Repository\DeckRepository;

class DeckManager
{
    /** @var DeckRepository  */
    protected $deckRepository;

    /** @var CardRepository  */
    private $cardRepository;

    /**
     * DeckManager constructor.
     *
     * @param DeckRepository $deckRepository
     * @param CardRepository $cardRepository
     */
    public function __construct(DeckRepository $deckRepository, CardRepository $cardRepository)
    {
        $this->deckRepository = $deckRepository;
        $this->cardRepository = $cardRepository;
    }

    public function findAll()
    {
        return $this->deckRepository->findAll();
    }

    /**
     * @param array $params
     *
     * @return null|Deck
     */
    public function findOneBy(array $params)
    {
        return $this->deckRepository->findOneBy($params);
    }

    public function findByName(string $name)
    {
        return $this->deckRepository->findBy(['name' => $name])[0];
    }

    public function addCard(Card $card, Deck $deck)
    {
        $card->setDeck($deck);
        $deck->addCard($card);
        $this->cardRepository->save($card);
    }

    public function addCards(array $cards, Deck $deck)
    {
        /** @var Card $card */
        foreach ($cards as $card) {
            $card->setDeck($deck);
            $deck->addCard($card);
            $this->cardRepository->persist($card);
        }
        $this->deckRepository->save();
    }

    /**
     * @param array $params
     *
     * @return Deck
     */
    public function create(array $params)
    {
        $deck = new Deck();

        $deck->hydrate($params);
        $this->deckRepository->save($deck);

        return $deck;
    }

    /**
     * @param Deck $deck
     */
    public function delete(Deck $deck)
    {
        return $this->deckRepository->remove($deck);
    }

    /**
     * Return an array of single color card.
     *
     * @param Deck   $deck
     * @param string $color
     *
     * @return array
     * @throws \Exception
     */
    public function getCardsByColor(Deck $deck, string $color) : array
    {
        if($color != Card::BLACK || $color != Card::WHITE) {
            throw new \Exception(sprintf("card color %s is invalid.", $color));
        }

        $cards = [];

        /** @var Card $card */
        foreach ($deck->getCards()->toArray() as $card) {
            if($card->getType() === $color) {
                $cards[] = $card;
            }
        }

        return $cards;
    }

}