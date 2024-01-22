<?php

namespace App\Entity;

use App\Repository\TagsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TagsRepository::class)]
class Tags
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 60)]
    private ?string $title = null;

    #[ORM\ManyToMany(targetEntity: Posts::class, mappedBy: 'fk_tags')]
    private Collection $fk_posts;

    public function __construct()
    {
        $this->fk_posts = new ArrayCollection();
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

    /**
     * @return Collection<int, Posts>
     */
    public function getFkPosts(): Collection
    {
        return $this->fk_posts;
    }

    public function addFkPost(Posts $fkPost): static
    {
        if (!$this->fk_posts->contains($fkPost)) {
            $this->fk_posts->add($fkPost);
            $fkPost->addFkTag($this);
        }

        return $this;
    }

    public function removeFkPost(Posts $fkPost): static
    {
        if ($this->fk_posts->removeElement($fkPost)) {
            $fkPost->removeFkTag($this);
        }

        return $this;
    }
}
