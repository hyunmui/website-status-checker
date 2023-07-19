<?php

namespace App\Entity;

use App\Repository\WebsiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WebsiteRepository::class)]
class Website
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $host = null;

    #[ORM\Column]
    private ?bool $isHttps = null;

    #[ORM\OneToMany(mappedBy: 'website', targetEntity: WebsiteCheckHistory::class)]
    private Collection $checkHistories;

    public function __construct()
    {
        $this->checkHistories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getHost(): ?string
    {
        return $this->host;
    }

    public function setHost(string $host): static
    {
        $this->host = $host;

        return $this;
    }

    public function isIsHttps(): ?bool
    {
        return $this->isHttps;
    }

    public function setIsHttps(bool $isHttps): static
    {
        $this->isHttps = $isHttps;

        return $this;
    }

    /**
     * @return Collection<int, WebsiteCheckHistory>
     */
    public function getCheckHistories(): Collection
    {
        return $this->checkHistories;
    }

    public function addCheckHistory(WebsiteCheckHistory $checkHistory): static
    {
        if (!$this->checkHistories->contains($checkHistory)) {
            $this->checkHistories->add($checkHistory);
            $checkHistory->setWebsite($this);
        }

        return $this;
    }

    public function removeCheckHistory(WebsiteCheckHistory $checkHistory): static
    {
        if ($this->checkHistories->removeElement($checkHistory)) {
            // set the owning side to null (unless already changed)
            if ($checkHistory->getWebsite() === $this) {
                $checkHistory->setWebsite(null);
            }
        }

        return $this;
    }
}
