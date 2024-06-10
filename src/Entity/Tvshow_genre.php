<?php

namespace Entity;

class Tvshow_genre
{
    private int $id;
    private int $genreId;
    private int $tvShowId;
    public  function getId(): int
    {
        return $this->id;
    }
    public  function getGenreId(): int
    {
        return $this->genreId;
    }
    public  function getTvShowId(): int
    {
        return $this->tvShowId;
    }

}