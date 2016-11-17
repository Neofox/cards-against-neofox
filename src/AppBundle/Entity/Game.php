<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Game
 *
 * @ORM\Table(name="game")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GameRepository")
 */
class Game
{
    use HydrateTrait;

    const WAITING = 0;
    const IN_PROGRESS = 1;
    const FINISHED = 2;

    const PUBLIC = "public";
    const PRIVATE = "private";

    /**
     * Id of the game.
     *
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * Name of the game.
     *
     * @var  string
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * Type of game. (See constant)
     *
     * @var  string
     * @ORM\Column(type="string")
     */
    protected $type;

    /**
     * State of the game. (See constants)
     *
     * @var  int
     * @ORM\Column(type="integer")
     */
    protected $state;

    /**
     * Number of blank card in a game. (White cards with no text)
     *
     * @var  int
     * @ORM\Column(type="integer")
     */
    protected $blankCard;

    /**
     * Number of cards players can have at the same time in hand.
     *
     * @var  int
     * @ORM\Column(type="integer")
     */
    protected $handCard;

    /**
     * Maximum score of a game (define when the game stop).
     *
     * @var  int
     * @ORM\Column(type="integer")
     */
    protected $maxScore;

    /**
     * Maximum of players in a game.
     *
     * @var integer
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $maxPlayers; // TODO: implement that

    /**
     * List of all Players in a game.
     *
     * @var ArrayCollection|Player[]
     * @ORM\OneToMany(targetEntity="Player", mappedBy="game", cascade={"persist"})
     */
    protected $players;

    /**
     * List of all Decks included in a game.
     *
     * @var ArrayCollection|Deck[]
     * @ORM\ManyToMany(targetEntity="Deck", mappedBy="games", cascade={"persist"})
     */
    protected $decks;

    /**
     * List of all rounds of a game.
     *
     * @var ArrayCollection|Round[]
     * @ORM\OneToMany(targetEntity="Round", mappedBy="game", cascade={"persist", "remove"})
     */
    protected $rounds;

    // DYNAMIC PROPERTIES
//
//    /**
//     * White cards of the game.
//     *
//     * @var ArrayCollection|Card[]
//     */
//    protected $whiteCards;
//
//    /**
//     * Black cards of the game.
//     *
//     * @var ArrayCollection|Card[]
//     */
//    protected $blackCards;


    /**
     * Game constructor.
     */
    public function __construct()
    {
        $this->players = new ArrayCollection();
        $this->decks = new ArrayCollection();
        $this->rounds = new ArrayCollection();
//      $this->cards = new ArrayCollection();
    }


    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Game
     */
    public function setName(string $name): Game
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int
     */
    public function getState(): int
    {
        return $this->state;
    }

    /**
     * @param int $state
     *
     * @return Game
     * @throws \Exception
     */
    public function setState(int $state): Game
    {
        if(in_array($state, [Game::WAITING, Game::IN_PROGRESS, Game::FINISHED])){
            $this->state = $state;
        } else {
            throw new \Exception(sprintf('The state %d is not valid. Expected "%s" , "%s" or "%s".', $state, Game::WAITING, Game::IN_PROGRESS, Game::FINISHED));
        }

        return $this;
    }

    /**
     * Add player
     *
     * @param Player $player
     *
     * @return Game
     */
    public function addPlayer(Player $player)
    {
        $this->players[] = $player;

        return $this;
    }

    /**
     * Remove player
     *
     * @param Player $player
     */
    public function removePlayer(Player $player)
    {
        $this->players->removeElement($player);
    }

    /**
     * Get players
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * Add Round
     *
     * @param Round $round
     *
     * @return Game
     */
    public function addRound(Round $round)
    {
        $this->rounds[] = $round;

        return $this;
    }

    /**
     * Remove round
     *
     * @param Round $round
     */
    public function removeRound(Round $round)
    {
        $this->rounds->removeElement($round);
    }

    /**
     * Get rounds
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRounds()
    {
        return $this->rounds;
    }

    /**
     * Add deck
     *
     * @param Deck $deck
     *
     * @return Game
     */
    public function addDeck(Deck $deck)
    {
        $this->decks[] = $deck;

        return $this;
    }

    /**
     * Remove deck
     *
     * @param Deck $deck
     */
    public function removeDeck(Deck $deck)
    {
        $this->decks->removeElement($deck);
    }

//
//    /**
//     * Add white card
//     *
//     * @param Card $card
//     *
//     * @return Game
//     * @throws \Exception
//     */
//    public function addWhiteCard(Card $card)
//    {
//        if($card->isWhiteCard()) {
//            $this->whiteCards[] = $card;
//        } else {
//            throw new \Exception(sprintf("card %s must be white.", $card->getId()));
//        }
//
//        return $this;
//    }
//
//
//    /**
//     * Add black card
//     *
//     * @param Card $card
//     *
//     * @return Game
//     * @throws \Exception
//     */
//    public function addBlackCard(Card $card)
//    {
//        if($card->isBlackCard()) {
//            $this->blackCards[] = $card;
//        } else {
//            throw new \Exception(sprintf("card %s must be black.", $card->getId()));
//        }
//
//        return $this;
//    }
//
//    /**
//     * Remove card
//     *
//     * @param Card $card
//     *
//     * @throws \Exception
//     */
//    public function removeWhiteCard(Card $card)
//    {
//        if($card->isWhiteCard()) {
//            $this->whiteCards->removeElement($card);
//        } else {
//            throw new \Exception(sprintf("card %s must be white.", $card->getId()));
//        }
//    }
//
//    /**
//     * Remove card
//     *
//     * @param Card $card
//     *
//     * @throws \Exception
//     */
//    public function removeBlackCard(Card $card)
//    {
//        if($card->isBlackCard()) {
//            $this->blackCards->removeElement($card);
//        } else {
//            throw new \Exception(sprintf("card %s must be black.", $card->getId()));
//        }
//    }
//
//    /**
//     * Get cards
//     *
//     * @return ArrayCollection
//     */
//    public function getWhiteCards()
//    {
//        return $this->whiteCards;
//    }
//
//    /**
//     * Get cards
//     *
//     * @return ArrayCollection
//     */
//    public function getBlackCards()
//    {
//        return $this->blackCards;
//    }
//
//    /**
//     * Set cards
//     *
//     * @param array $cards
//     *
//     * @return $this
//     * @throws \Exception
//     */
//    public function setWhiteCards(array $cards)
//    {
//        /** @var Card $card */
//        foreach ($cards as $card) {
//            if($card->isWhiteCard()) {
//                $this->whiteCards->add($card);
//            } else {
//                throw new \Exception(sprintf("card %s must be white.", $card->getId()));
//            }
//        }
//
//        return $this;
//    }
//    /**
//     * Set cards
//     *
//     * @param array $cards
//     *
//     * @return $this
//     * @throws \Exception
//     */
//    public function setBlackCards(array $cards)
//    {
//        /** @var Card $card */
//        foreach ($cards as $card) {
//            if($card->isBlackCard()) {
//                $this->blackCards->add($card);
//            } else {
//                throw new \Exception(sprintf("card %s must be black.", $card->getId()));
//            }
//        }
//
//        return $this;
//    }

    /**
     * Get decks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDecks()
    {
        return $this->decks;
    }

    /**
     * @return boolean
     */
    public function isPrivate(): bool
    {
        return $this->type === Game::PRIVATE;
    }

    /**
     * @return boolean
     */
    public function isPublic(): bool
    {
        return $this->type === Game::PUBLIC;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return $this
     */
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return $this
     * @throws \Exception
     */
    public function setType(string $type)
    {
        if(in_array($type, [Game::PUBLIC, Game::PRIVATE])){
            $this->type = $type;
        } else {
            throw new \Exception(sprintf('The type %d is not valid. Expected "%s" or "%s".', $type, Game::PUBLIC, Game::PRIVATE));
        }

        return $this;
    }

    /**
     * @return int
     */
    public function getBlankCard(): int
    {
        return $this->blankCard;
    }

    /**
     * @param int $blankCard
     *
     * @return $this
     */
    public function setBlankCard(int $blankCard)
    {
        $this->blankCard = $blankCard;

        return $this;
    }

    /**
     * @return int
     */
    public function getHandCard(): int
    {
        return $this->handCard;
    }

    /**
     * @param int $handCard
     *
     * @return $this
     */
    public function setHandCard(int $handCard)
    {
        $this->handCard = $handCard;

        return $this;
    }


    /**
     * @return int
     */
    public function getMaxPlayers(): int
    {
        return $this->maxPlayers;
    }

    /**
     * @param int $maxPlayers
     *
     * @return $this
     */
    public function setMaxPlayers(int $maxPlayers)
    {
        $this->maxPlayers = $maxPlayers;

        return $this;
    }

    /**
     * @return int
     */
    public function getMaxScore(): int
    {
        return $this->maxScore;
    }

    /**
     * @param int $maxScore
     *
     * @return $this
     */
    public function setMaxScore(int $maxScore)
    {
        $this->maxScore = $maxScore;

        return $this;
    }
}

