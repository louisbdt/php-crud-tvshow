<?php

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Episode;

/**
 * Classe permettant de retrouver une liste des saisons
 * On retrouve une unique fonction qui permet de trouver les saisons à partir de leur Id
 *
 */
class EpisodeCollection
{
    /**
     * Permet de retrouver les saisons à partir de leur Id
     * @param $seasonId L'id de la saison à chercher
     * @return array Retourne un tableau avec les saisons trouvées
     */
    public static function findBySeasonId($seasonId): array
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT id, seasonId, name, overview, episodeNumber
            FROM episode
            WHERE seasonId = :seasonId
            ORDER BY episodeNumber
        SQL
        );
        $stmt->execute([":seasonId" => $seasonId]);
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Episode::class);




    }
}
