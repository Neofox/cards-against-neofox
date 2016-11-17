<?php
/**
 * User: Neofox
 * Date: 09/11/2016
 * Time: 09:48
 */

namespace AppBundle\Resources\Services\Manager;

use AppBundle\Entity\Card;
use AppBundle\Entity\Deck;
use AppBundle\Entity\Game;
use AppBundle\Entity\Player;
use AppBundle\Repository\GameRepository;
use AppBundle\Repository\PlayerRepository;

class GameManager
{
    /** @var GameRepository */
    protected $gameRepository;

    /** @var PlayerRepository */
    private $playerRepository;

    /** @var DeckManager */
    private $deckManager;

    /** @var PlayerManager */
    private $playerManager;

    /**
     * GameManager constructor.
     *
     * @param GameRepository   $gameRepository
     * @param PlayerRepository $playerRepository
     * @param DeckManager      $deckManager
     * @param PlayerManager    $playerManager
     */
    public function __construct(
        GameRepository $gameRepository,
        PlayerRepository $playerRepository,
        DeckManager $deckManager,
        PlayerManager $playerManager
    ) {
        $this->gameRepository = $gameRepository;
        $this->playerRepository = $playerRepository;
        $this->deckManager = $deckManager;
        $this->playerManager = $playerManager;
    }

    public function findAll()
    {
        return $this->gameRepository->findAll();
    }

    /**
     * @param array $params
     *
     * @return null|Game
     */
    public function findOneBy(array $params)
    {
        return $this->gameRepository->findOneBy($params);
    }

    public function fillAllHands(Game $game)
    {
        /** @var Player $player */
        foreach ($game->getPlayers() as $player) {
            $this->fillHand($game, $player);
        }
    }

    public function fillHand(Game $game, Player $player)
    {
        if ($player->getHand()->count() < 10) {
            $nbr = 10 - $player->getHand()->count();
            $cards = $this->getRandomDeckWhiteCards($game, $nbr);

            /** @var Card $card */
            foreach ($cards as $card) {
                $player->addHandCard($card);
            }
        }
    }


//    public function setCards(Game $game, string $color)
//    {
//        $cards = [];
//
//        if($color != Card::BLACK || $color != Card::WHITE) {
//            throw new \Exception(sprintf("card color %s is invalid.", $color));
//        }
//
//        /** @var Deck $deck */
//        foreach ($game->getDecks() as $deck) {
//            $cards[$deck->getPackId()] = $this->deckManager->getCardsByColor($deck, $color);
//        }
//
//        if($color === Card::WHITE) {
//            $game->setWhiteCards($cards);
//        } else {
//            $game->setBlackCards($cards);
//        }
//    }

    /**
     * Get randoms white cards from a random deck
     *
     * @param Game $game
     * @param int  $nbrDraw
     *
     * @return array
     */
    public function getRandomDeckWhiteCards(Game $game, int $nbrDraw = 1)
    {
        $deck = $this->getRandomDeck($game);

        $whiteCards = $this->deckManager->getCardsByColor($deck, Card::WHITE);

        shuffle($whiteCards);

        return array_slice($whiteCards, 0, $nbrDraw);
    }

    public function getRandomDeck(Game $game) : Deck
    {
        return $game->getDecks()->get(array_rand($game->getDecks()->toArray()));
    }

    public function setBlackCards(Game $game)
    {
        $allCards = [];

        /** @var Deck $deck */
        foreach ($game->getDecks() as $deck) {
            $allCards[$deck->getPackId()] = $deck->getCards()->toArray();
        }


    }

    public function addPlayer(Game $game, Player $player)
    {
        $player->setGame($game);
        $game->addPlayer($player);
        $this->playerRepository->save($player);
    }

    public function addDeck(Game $game, Deck $deck)
    {
        $deck->addGame($game);
        $game->addDeck($deck);
        $this->gameRepository->save($game);
    }

    /**
     * @param array $params
     *
     * @return Game
     */
    public function create(array $params)
    {
        $game = new Game();

        // Hydrate and set default states.
        $game->setBlankCard(0);
        $game->setHandCard(10);
        $game->setMaxScore(5);
        $game->hydrate($params);
        $game->setState(Game::WAITING);

        $this->gameRepository->save($game);

        return $game;
    }

    public function start(Game $game)
    {
        $game->setState(Game::IN_PROGRESS);

        $this->gameRepository->save($game);
    }

}