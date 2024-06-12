<?php

namespace Entity;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;

/**
 * Classe de l'entité Genre
 */
class Genre
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var string
     */
    private string $name;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
     * Permet de trouver un genre à partir de son Id, si genreId est absent, alors on lance une EntityNotFoundException
     * @param int|null $id id du genre à chercher
     * @return TvShow Retourne une série à partir de son tvShow
     */
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