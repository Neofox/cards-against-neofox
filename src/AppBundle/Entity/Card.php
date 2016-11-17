<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Card
 *
 * @ORM\Table(name="card")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CardRepository")
 */
class Card
{

    use HydrateTrait;

    const WHITE = 'white';
    const BLACK = 'black';

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
     * @ORM\Column(name="text", type="string", length=255, nullable=true)
     */
    private $text;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var int
     *
     * @ORM\Column(name="nbrAnswer", type="integer", nullable=true)
     */
    private $nbrAnswer;

    /**
     * @var  Deck
     * @ORM\ManyToOne(targetEntity="Deck", inversedBy="cards")
     */
    protected $deck;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    public function isWhiteCard()
    {
        return $this->type === Card::WHITE;
    }

    public function isBlackCard()
    {
        return $this->type === Card::BLACK;
    }

    /**
     * @return Deck
     */
    public function getDeck(): Deck
    {
        return $this->deck;
    }

    /**
     * @param Deck $deck
     *
     * @return $this
     */
    public function setDeck(Deck $deck)
    {
        $this->deck = $deck;

        return $this;
    }
    /**
     * Set text
     *
     * @param string $text
     *
     * @return Card
     */
    public function setText($text)
    {
        $this->text = strtoupper($text);

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    public function setType(string $type)
    {
        if ($type === Card::BLACK || $type === Card::WHITE) {
            $this->type = $type;
        } else {
            throw new \Exception(sprintf('invalid type %s .', $type));
        }

        return $this;
    }

    public function getNbrAnswer()
    {
        if ($this->type === Card::BLACK) {
            return $this->nbrAnswer;
        } else {
            throw new \Exception('Only black card have answers.');
        }
    }

    public function setNbrAnswer(int $nbrAnswer)
    {
        if ($this->type === Card::BLACK) {
            $this->nbrAnswer = $nbrAnswer;
        } else {
            throw new \Exception('Only black card have answers.');
        }

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

}
