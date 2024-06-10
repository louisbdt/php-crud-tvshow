<?php

declare(strict_types=1);

class Episode {

    private int $id;

    protected int $seasonId;

    private string $name;

    private string $overview;

    protected int $episodeNumber;

    public function getId(): int
    {
        return $this->id;
    }

    public function getSeasonId(): int
    {
        return $this->seasonId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getOverview(): string
    {
        return $this->overview;
    }

    public function getEpisodeNumber(): int
    {
        return $this->episodeNumber;
    }


}
