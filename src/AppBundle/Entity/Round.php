<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Round
 *
 * @ORM\Table(name="round")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RoundRepository")
 */
class Round
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
     * Number of the current round.
     *
     * @var int
     *
     * @ORM\Column(name="number", type="integer")
     */
    private $number;

    /**
     * @var  Game
     * @ORM\ManyToOne(targetEntity="Game", inversedBy="rounds")
     */
    protected $game;

    /**
     * @var Player
     * @ORM\OneToOne(targetEntity="Player")
     */
    protected $tzar;

    /**
     * @var Card
     */
    protected $blackCard;

    /**
     * @var ArrayCollection|Card[]
     */
    protected $whiteCards;

    /**
     * Round constructor.
     */
    public function __construct()
    {
        $this->whiteCards = new ArrayCollection();
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
     * @return Game
     */
    public function getGame(): Game
    {
        return $this->game;
    }

    /**
     * @param Game $game
     *
     * @return $this
     */
    public function setGame(Game $game)
    {
        $this->game = $game;

        return $this;
    }

    /**
     * @return Player
     */
    public function getTzar()
    {
        return $this->tzar;
    }

    /**
     * @param Player $tzar
     *
     * @return $this
     */
    public function setTzar(Player $tzar)
    {
        $this->tzar = $tzar;

        return $this;
    }
    /**
     * @return Card
     */
    public function getBlackCard()
    {
        return $this->blackCard;
    }

    /**
     * @param Card $blackCard
     *
     * @return $this
     */
    public function setBlackCard(Card $blackCard)
    {
        $this->blackCard = $blackCard;

        return $this;
    }


    /**
     * Add white card
     *
     * @param Card $whiteCard
     *
     * @return Round
     */
    public function addWhiteCard(Card $whiteCard)
    {
        $this->whiteCards[] = $whiteCard;

        return $this;
    }

    /**
     * Remove white card
     *
     * @param Card $whiteCard
     */
    public function removeWhiteCard(Card $whiteCard)
    {
        $this->whiteCards->removeElement($whiteCard);
    }

    /**
     * Get white cards
     *
     * @return Collection
     */
    public function getWhiteCards()
    {
        return $this->whiteCards;
    }

    /**
     * Set number
     *
     * @param integer $number
     *
     * @return Round
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }
}

