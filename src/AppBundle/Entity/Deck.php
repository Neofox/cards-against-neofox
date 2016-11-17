<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Deck
 *
 * @ORM\Table(name="deck")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DeckRepository")
 */
class Deck
{
    use HydrateTrait;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="rating", type="integer", nullable=true)
     */
    private $rating;

    /**
     * @var string
     *
     * @ORM\Column(name="packId", type="string", length=255, unique=true)
     */
    private $packId;

    /**
     * @var ArrayCollection|Card[]
     * @ORM\OneToMany(targetEntity="Card", mappedBy="deck", cascade={"persist", "remove"})
     */
    protected $cards;

    /**
     * @var  ArrayCollection|Game[]
     * @ORM\ManyToMany(targetEntity="Game", inversedBy="decks")
     */
    protected $games;

    /**
     * Deck constructor.
     */
    public function __construct()
    {
        $this->cards = new ArrayCollection();
        $this->games = new ArrayCollection();
    }



    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Deck
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Deck
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set rating
     *
     * @param integer $rating
     *
     * @return Deck
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return int
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set packId
     *
     * @param string $packId
     *
     * @return Deck
     */
    public function setPackId($packId)
    {
        $this->packId = $packId;

        return $this;
    }

    /**
     * Get packId
     *
     * @return string
     */
    public function getPackId()
    {
        return $this->packId;
    }


    /**
     * Add card
     *
     * @param Card $card
     *
     * @return Deck
     */
    public function addCard(Card $card)
    {
        $this->cards[] = $card;

        return $this;
    }

    /**
     * Remove card
     *
     * @param Card $card
     */
    public function removeCard(Card $card)
    {
        $this->cards->removeElement($card);
    }

    /**
     * Get cards
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCards()
    {
        return $this->cards;
    }

    /**
     * Add game
     *
     * @param Game $game
     *
     * @return Deck
     */
    public function addGame(Game $game)
    {
        $this->games[] = $game;

        return $this;
    }

    /**
     * Remove game
     *
     * @param Game $game
     */
    public function removeGame(Game $game)
    {
        $this->games->removeElement($game);
    }

    /**
     * Get games
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGames()
    {
        return $this->games;
    }

}
