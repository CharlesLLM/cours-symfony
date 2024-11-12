<?php

namespace App\Entity;

use App\Enum\MediaTypeEnum;
use App\Repository\MovieRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MovieRepository::class)]
class Movie extends Media
{
    #[ORM\Column]
    private int $duration = 0;

    public function getMediaType(): string
    {
        return MediaTypeEnum::MOVIE->value;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): static
    {
        $this->duration = $duration;

        return $this;
    }
}
