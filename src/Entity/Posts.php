<?php

namespace App\Entity;

use App\Repository\PostsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostsRepository::class)]
class Posts
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 60)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $content = null;

    #[ORM\Column(length: 60)]
    private ?string $picture = null;

    #[ORM\ManyToMany(targetEntity: Tags::class, inversedBy: 'fk_posts')]
    private Collection $fk_tags;

    public function __construct()
    {
        $this->fk_tags = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): static
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return Collection<int, Tags>
     */
    public function getFkTags(): Collection
    {
        return $this->fk_tags;
    }

    public function addFkTag(Tags $fkTag): static
    {
        if (!$this->fk_tags->contains($fkTag)) {
            $this->fk_tags->add($fkTag);
        }

        return $this;
    }

    public function removeFkTag(Tags $fkTag): static
    {
        $this->fk_tags->removeElement($fkTag);

        return $this;
    }
}
