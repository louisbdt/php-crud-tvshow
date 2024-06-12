<?php

namespace Entity\Collection;

use Database\MyPdo;
use Entity\TvShow;

/**
* Classe permettant de retourner un tableau de série
 */
class TvshowCollection
{
    /**
     * Permet de retourner à partir de la base SQL, toutes les séries qui y sont présentes
     * @return array Retourne un tableau de toutes les séries
     */
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

    /**
     * Permet de retourner les séries à partir de leur genre
     * @param $genreId Id du genre
     * @return array Retourne un tableau des séries triées
     */
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
