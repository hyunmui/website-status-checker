<?php

namespace App\Entity;

use App\Repository\WebsiteCheckHistoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WebsiteCheckHistoryRepository::class)]
class WebsiteCheckHistory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'checkHistories')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Website $website = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $checkedAt = null;

    #[ORM\OneToMany(mappedBy: 'checkHistory', targetEntity: PageCheckLog::class)]
    private Collection $pageCheckLogs;

    public function __construct()
    {
        $this->pageCheckLogs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWebsite(): ?Website
    {
        return $this->website;
    }

    public function setWebsite(?Website $website): static
    {
        $this->website = $website;

        return $this;
    }

    public function getCheckedAt(): ?\DateTimeImmutable
    {
        return $this->checkedAt;
    }

    public function setCheckedAt(\DateTimeImmutable $checkedAt): static
    {
        $this->checkedAt = $checkedAt;

        return $this;
    }

    /**
     * @return Collection<int, PageCheckLog>
     */
    public function getPageCheckLogs(): Collection
    {
        return $this->pageCheckLogs;
    }

    public function addPageCheckLog(PageCheckLog $pageCheckLog): static
    {
        if (!$this->pageCheckLogs->contains($pageCheckLog)) {
            $this->pageCheckLogs->add($pageCheckLog);
            $pageCheckLog->setCheckHistory($this);
        }

        return $this;
    }

    public function removePageCheckLog(PageCheckLog $pageCheckLog): static
    {
        if ($this->pageCheckLogs->removeElement($pageCheckLog)) {
            // set the owning side to null (unless already changed)
            if ($pageCheckLog->getCheckHistory() === $this) {
                $pageCheckLog->setCheckHistory(null);
            }
        }

        return $this;
    }
}
