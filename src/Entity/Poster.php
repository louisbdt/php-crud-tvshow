<?php

namespace Entity;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;

/**
 * Classe de l'entité Poster
 */
class Poster
{
    /**
     * @var int|null
     */
    private ?int $id;
    /**
     * @var string
     */
    private string $jpeg;

    /**
     * Permet de trouver un poster à partir de son Id, si poster est absent, alors on lance une EntityNotFoundException
     * @param int|null $id id du genre à chercher
     * @return Poster|object|\stdClass|null Retourne une série à partir de son tvShow
     */
    public static function findById(?int $id)
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT id, jpeg
            FROM poster
            WHERE id = :ID
        SQL
        );
        $stmt->execute([":ID" => $id]);
        $poster = $stmt->fetchObject(Poster::class);
        if ($poster === false) {
            throw new EntityNotFoundException();
        }
        return $poster;
    }

    /**
     * Getter de Id
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Getter de Jpeg
     * @return string
     */
    public function getJpeg(): string
    {
        return $this->jpeg;
    }

}
