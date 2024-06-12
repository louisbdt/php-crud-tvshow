<?php

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Genre;
use Entity\TvShow;

class GenreCollection
{
    public static function findAll(): array
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT id, name
            FROM genre
            ORDER BY name
        SQL
        );
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Genre::class);
    }
}
