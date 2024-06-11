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

    private function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setOriginalName(string $originalName): void
    {
        $this->originalName = $originalName;
    }

    public function setHomepage(string $homepage): void
    {
        $this->homepage = $homepage;
    }

    public function setOverview(string $overview): void
    {
        $this->overview = $overview;
    }

    public function setPosterId(int $posterId): void
    {
        $this->posterId = $posterId;
    }

    protected function update(): TvShow
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<< 'SQL'
            UPDATE tvshow
            SET name = :name,
                originalName = :originalName,
                homepage = :homepage,
                overview = :overview
            WHERE id = :id
            SQL);
        $stmt->execute(
                [':id' => $this->getId(),
                ':name' => $this->getName(),
                ':originalName' => $this->getOriginalName(),
                ':homepage' => $this->getHomepage(),
                 ':overview' => $this->getOverview()
            ]
        );
        return $this;
    }

}
