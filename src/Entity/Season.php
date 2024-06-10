<?php

namespace Entity;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;

class Season
{
    private int $id;

    protected int $tvshowId;

    private string $name;

    protected int $seasonNumber;

    protected int $posterId;

    public function getId(): int
    {
        return $this->id;
    }

    public function getTvShowId(): int
    {
        return $this->tvshowId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSeasonNumber(): int
    {
        return $this->seasonNumber;
    }

    public function getPosterId(): int
    {
        return $this->posterId;
    }

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

}