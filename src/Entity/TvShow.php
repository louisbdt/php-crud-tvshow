<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Collection\SeasonCollection;
use Entity\Exception\EntityNotFoundException;

class TvShow
{
    private ?int $id;

    private string $name;

    private string $originalName;

    private string $homepage;

    private string $overview;

    private int $posterId;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getOriginalName(): string
    {
        return $this->originalName;
    }

    public function getHomepage(): string
    {
        return $this->homepage;
    }

    public function getOverview(): string
    {
        return $this->overview;
    }

    public function getPosterId(): int
    {
        return $this->posterId;
    }

    public static function findById(?int $id): TvShow
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
                SELECT id, name, originalName, homepage, overview, posterId
                FROM tvshow
                WHERE id = :Id
            SQL
        );
        $stmt->execute([":Id" => $id]);
        $showId = $stmt->fetchObject(TvShow::class);
        if ($showId === false) {
            throw new EntityNotFoundException("Série introuvable");
        }
        return $showId;

    }

    public function getSeason(): array
    {
        return SeasonCollection::findByTvshowId($this->id);
    }

}
