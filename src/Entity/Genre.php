<?php

namespace Entity;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;

class Genre
{
    private int $id;

    private string $name;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public static function findById(?int $id): TvShow
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
                SELECT id, name
                FROM genre
                WHERE id = :Id
            SQL
        );
        $stmt->execute([":Id" => $id]);
        $genreId = $stmt->fetchObject(Genre::class);
        if ($genreId === false) {
            throw new EntityNotFoundException("Genre introuvable");
        }
        return $genreId;
    }
}