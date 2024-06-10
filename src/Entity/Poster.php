<?php

namespace Entity;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;

class Poster
{
    private int $id;
    private string $jpeg;

    public static function findById(int $id)
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
    public function getId(): int
    {
        return $this->id;
    }
    public function getJpeg(): string
    {
        return $this->jpeg;
    }

}
