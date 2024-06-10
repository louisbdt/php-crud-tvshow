<?php

namespace Entity\Collection;



use Database\MyPdo;
use TvShow;
use Season;

class SeasonCollection
{
    public static function findByTvshowId($tvshowId) : array
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT id, tvShowid, name, seasonNumber, posterId
            FROM season
            WHERE tvshowId = :tvshowID
            ORDER BY seasonNumber
        SQL);
        $stmt->execute([":tvshowID" =>$tvshowId]);
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Season::class);




    }

}