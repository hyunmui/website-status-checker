<?php

namespace App\Entity;

use App\Repository\PageCheckLogRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PageCheckLogRepository::class)]
class PageCheckLog
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $path = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?CheckScreenshot $screenshot = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $checkedAt = null;

    #[ORM\ManyToOne(inversedBy: 'pageCheckLogs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?WebsiteCheckHistory $checkHistory = null;

    #[ORM\Column]
    private ?int $httpStatusCode = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): static
    {
        $this->path = $path;

        return $this;
    }

    public function getScreenshot(): ?CheckScreenshot
    {
        return $this->screenshot;
    }

    public function setScreenshot(?CheckScreenshot $screenshot): static
    {
        $this->screenshot = $screenshot;

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

    public function getCheckHistory(): ?WebsiteCheckHistory
    {
        return $this->checkHistory;
    }

    public function setCheckHistory(?WebsiteCheckHistory $checkHistory): static
    {
        $this->checkHistory = $checkHistory;

        return $this;
    }

    public function getHttpStatusCode(): ?int
    {
        return $this->httpStatusCode;
    }

    public function setHttpStatusCode(int $httpStatusCode): static
    {
        $this->httpStatusCode = $httpStatusCode;

        return $this;
    }
}
