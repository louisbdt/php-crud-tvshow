<?php

declare(strict_types=1);
namespace Entity;

/**
 * Classe de l'entité Episode
 */
class Episode
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var int
     */
    protected int $seasonId;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var string
     */
    private string $overview;

    /**
     * @var int
     */
    protected int $episodeNumber;

    /**
     * Getter d'id
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Getter de SeasonId
     * @return int
     */
    public function getSeasonId(): int
    {
        return $this->seasonId;
    }

    /**
     * Getter de Name
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Getter de Overview
     * @return string
     */
    public function getOverview(): string
    {
        return $this->overview;
    }

    /**
     * Getter de EpisodeNumber
     * @return int
     */
    public function getEpisodeNumber(): int
    {
        return $this->episodeNumber;
    }

}
