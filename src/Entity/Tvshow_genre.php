<?php

namespace Entity;

/**
 * Classe de l'Entité Tvshow_genre
 */
class Tvshow_genre
{
    /**
     * @var int
     */
    private int $id;
    /**
     * @var int
     */
    private int $genreId;
    /**
     * @var int
     */
    private int $tvShowId;

    /**
     * Getter de l'id
     * @return int
     */
    public  function getId(): int
    {
        return $this->id;
    }

    /**
     * Getter de genreId
     * @return int
     */
    public  function getGenreId(): int
    {
        return $this->genreId;
    }

    /**
     * Getter de TvSHowId
     * @return int
     */
    public  function getTvShowId(): int
    {
        return $this->tvShowId;
    }

}