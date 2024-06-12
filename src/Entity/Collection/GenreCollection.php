<?php

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Genre;


/**
 * Classe permettant de retrouver la liste des genres
 * On retrouve une unique fonction qui permet de trouver les saisons à partir de leur Id

 */
class GenreCollection
{
    /**
     * Selectionne à partir d'une requête SQL tous les Genres présentes dans la base de données
     * @return array Retourne un tableau avec tous les genres
     */
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
