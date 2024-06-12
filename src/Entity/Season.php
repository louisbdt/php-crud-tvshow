<?php

namespace Entity;

use Database\MyPdo;
use Entity\Collection\EpisodeCollection;
use Entity\Exception\EntityNotFoundException;

/**
 * Classe de l'entité Season
 */
class Season
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var int
     */
    protected int $tvshowId;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var int
     */
    protected int $seasonNumber;

    /**
     * @var int|null
     */
    protected ?int $posterId;

    /**
     * Getter de Id
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Getter de TvShowId
     * @return int
     */
    public function getTvShowId(): int
    {
        return $this->tvshowId;
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
     * Getter de Name
     * @return int
     */
    public function getSeasonNumber(): int
    {
        return $this->seasonNumber;
    }

    /**
     * Getter de PosterId
     * @return int|null
     */
    public function getPosterId(): ?int
    {
        return $this->posterId;
    }

    /**
     * Permet de trouver une saison à partir de son Id, si saison est absent, alors on lance une EntityNotFoundException
     * @param int $id id de la saison à chercher
     * @return Season Retourne une Season
     */
    public static function findById(int $id): Season
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
                SELECT id, tvshowId, name, seasonNumber, posterId
                FROM season
                WHERE id = :Id
            SQL
        );
        $stmt->execute([":Id" => $id]);
        $seasonId = $stmt->fetchObject(Season::class);
        if ($seasonId === false) {
            throw new EntityNotFoundException("Saison introuvable");
        }
        return $seasonId;
    }

    /**
     * Getter d'Episode
     * @return array
     */
    public function getEpisode(): array
    {
        return EpisodeCollection::findBySeasonId($this->id);
    }



}