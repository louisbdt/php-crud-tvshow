<?php

namespace Entity;

class Season
{
    private int $id;

    protected int $tvShowId;

    private string $name;

    protected int $seasonNumber;

    protected int $posterId;

    public function getId(): int
    {
        return $this->id;
    }

    public function getTvShowId(): int
    {
        return $this->tvShowId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSeasonNumber(): int
    {
        return $this->seasonNumber;
    }

    public function getPosterId(): int
    {
        return $this->posterId;
    }

}