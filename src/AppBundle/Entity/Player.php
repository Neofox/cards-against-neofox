<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Player
 *
 * @ORM\Table(name="player")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlayerRepository")
 */
class Player
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
     * @ORM\Column(name="pseudo", type="string", length=255, unique=true)
     */
    private $pseudo;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @var  Game
     * @ORM\ManyToOne(targetEntity="Game", inversedBy="players")
     */
    protected $game;

    // DYNAMIC PROPERTIES

    /**
     * @var ArrayCollection|Card[]
     */
    protected $hand;


    public function __construct()
    {
        $this->hand = new ArrayCollection();
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set pseudo
     *
     * @param string $pseudo
     *
     * @return Player
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get pseudo
     *
     * @return string
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Player
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }


    /**
     * Add hand card
     *
     * @param Card $card
     *
     * @return Player
     */
    public function addHandCard(Card $card)
    {
        $this->hand[] = $card;

        return $this;
    }

    /**
     * Remove hand card
     *
     * @param Card $card
     */
    public function removeHandCard(Card $card)
    {
        $this->hand->removeElement($card);
    }

    /**
     * Get hand
     *
     * @return ArrayCollection
     */
    public function getHand()
    {
        return $this->hand;
    }

    /**
     * Get hand
     *
     * @param ArrayCollection $hand
     *
     * @return $this
     */
    public function setHand(ArrayCollection $hand)
    {
        $this->hand = $hand;

        return $this;
    }


    /**
     * @param string $password
     *
     * @return Player
     */
    public function setPassword(string $password): Player
    {
        $this->password = md5($password);

        return $this;
    }

}

