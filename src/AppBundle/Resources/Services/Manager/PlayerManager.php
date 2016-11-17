<?php
/**
 * User: Neofox
 * Date: 09/11/2016
 * Time: 09:48
 */

namespace AppBundle\Resources\Services\Manager;

use AppBundle\Entity\Player;
use AppBundle\Repository\PlayerRepository;

class PlayerManager
{
    /** @var PlayerRepository  */
    protected $playerRepository;

    public function __construct(PlayerRepository $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }

    public function findAll()
    {
        return $this->playerRepository->findAll();
    }

    /**
     * @param array $params
     *
     * @return null|Player
     */
    public function findOneBy(array $params)
    {
        return $this->playerRepository->findOneBy($params);
    }

    /**
     * @param array $params
     *
     * @return Player
     */
    public function create(array $params)
    {
        $player = new Player();

        // Hydrate and set default states.
        $player->hydrate($params);

        $this->playerRepository->save($player);

        return $player;
    }

}