<?php

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Genre;
use Entity\TvShow;

class TvshowCollection
{
    public static function findAll(): array
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT id, name, overview, posterId
            FROM tvshow
            ORDER BY name
        SQL
        );
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, TvShow::class);
    }

    public static function findByGenreId($genreId): array
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT id, name, overview, posterId
            FROM tvshow
            WHERE id IN (SELECT tvShowId
                         FROM tvshow_genre
                         WHERE genreId =:genreId ) 
            ORDER BY name
        SQL
        );
        $stmt->execute(["genreId" => $genreId]);
        return $stmt->fetchAll(\PDO::FETCH_CLASS, TvShow::class);
    }
}
