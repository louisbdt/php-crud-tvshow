<?php

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Episode;

class EpisodeCollection
{
    public static function findBySeasonId($seasonId) : array
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT id, seasonId, name, overview, episodeNumber
            FROM episode
            WHERE seasonId = :seasonId
            ORDER BY episodeNumber
        SQL);
        $stmt->execute([":seasonId" =>$seasonId]);
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Episode::class);




    }
}