<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use App\Trait\DateTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Project
{
    use DateTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $url = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\ManyToMany(targetEntity: Frontend::class, inversedBy: 'projects')]
    private Collection $frontend;

    #[ORM\ManyToMany(targetEntity: Backend::class, inversedBy: 'projects')]
    private Collection $backend;


    public function __construct()
    {
        $this->frontend = new ArrayCollection();
        $this->backend = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, Frontend>
     */
    public function getFrontend(): Collection
    {
        return $this->frontend;
    }

    public function addFrontend(Frontend $frontend): self
    {
        if (!$this->frontend->contains($frontend)) {
            $this->frontend->add($frontend);
        }

        return $this;
    }

    public function removeFrontend(Frontend $frontend): self
    {
        $this->frontend->removeElement($frontend);

        return $this;
    }

    /**
     * @return Collection<int, Backend>
     */
    public function getBackend(): Collection
    {
        return $this->backend;
    }

    public function addBackend(Backend $backend): self
    {
        if (!$this->backend->contains($backend)) {
            $this->backend->add($backend);
        }

        return $this;
    }

    public function removeBackend(Backend $backend): self
    {
        $this->backend->removeElement($backend);

        return $this;
    }

    public function getData(): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "url" => $this->url,
            "image" => $this->image,
            "created_at" => $this->createdAt,
            "updated_at" => $this->updatedAt
        ];
    }
}
