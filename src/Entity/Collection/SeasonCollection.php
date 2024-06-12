<?php

namespace Entity\Collection;

use Database\MyPdo;
use Entity\TvShow;
use Entity\Season;

/**
* Classe permettant de retrouver les saisons à partir de l'id de la série
 * On retrouve une unique fonction dans cette classe
 */
class SeasonCollection
{
    /**
     * Renvoie un tableau des saisons de la série télé mis en paramètre
     *
     * @param $tvshowId Id de TvShow
     * @return array Retourne un tableau avec les saisons appartenant à l'ID
     */
    public static function findByTvshowId($tvshowId): array
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT id, tvShowId, name, seasonNumber, posterId
            FROM season
            WHERE tvshowId = :tvshowID
            ORDER BY seasonNumber
        SQL
        );
        $stmt->execute(["tvshowID" => $tvshowId]);
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Season::class);
    }

}
