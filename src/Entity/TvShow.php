<?php

declare(strict_types=1);
Class TvShow {

    private int $id;

    private string $name;

    private string $originalName;

    private string $homepage;

    private string $overview;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getOriginalName(): string
    {
        return $this->originalName;
    }

    public function getHomepage(): string
    {
        return $this->homepage;
    }

    public function getOverview(): string
    {
        return $this->overview;
    }


}