<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $userPosition = null;

    // УДАЛЕНО: поле ststus
    // #[ORM\Column(length: 255)]
    // private ?string $ststus = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'project')]
    private Collection $users;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $hypothesis = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $company = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $brief = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $offer = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $site = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $information = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $turnover = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $direction = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $kpi = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $history = null;

    #[ORM\Column(length: 255, nullable: true)] // Оставляем nullable: true
    private ?string $status = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $payment = null;

    #[ORM\Column(nullable: true)]
    private ?int $amount = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $format = null;

    #[ORM\Column(nullable: true)]
    private ?int $expenses = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $contract = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $launch = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $deadline = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $specialist = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $mentor = null;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getUserPosition(): ?string
    {
        return $this->userPosition;
    }

    public function setUserPosition(string $userPosition): static
    {
        $this->userPosition = $userPosition;

        return $this;
    }

    // УДАЛЕНО: методы getStstus() и setStstus()

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function getHypothesis(): ?string
    {
        return $this->hypothesis;
    }

    public function setHypothesis(?string $hypothesis): static
    {
        $this->hypothesis = $hypothesis;

        return $this;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(?string $company): static
    {
        $this->company = $company;

        return $this;
    }

    public function getBrief(): ?string
    {
        return $this->brief;
    }

    public function setBrief(?string $brief): static
    {
        $this->brief = $brief;

        return $this;
    }

    public function getOffer(): ?string
    {
        return $this->offer;
    }

    public function setOffer(?string $offer): static
    {
        $this->offer = $offer;

        return $this;
    }

    public function getSite(): ?string
    {
        return $this->site;
    }

    public function setSite(?string $site): static
    {
        $this->site = $site;

        return $this;
    }

    public function getInformation(): ?string
    {
        return $this->information;
    }

    public function setInformation(?string $information): static
    {
        $this->information = $information;

        return $this;
    }

    public function getTurnover(): ?string
    {
        return $this->turnover;
    }

    public function setTurnover(?string $turnover): static
    {
        $this->turnover = $turnover;

        return $this;
    }

    public function getDirection(): ?string
    {
        return $this->direction;
    }

    public function setDirection(?string $direction): static
    {
        $this->direction = $direction;

        return $this;
    }

    public function getKpi(): ?string
    {
        return $this->kpi;
    }

    public function setKpi(?string $kpi): static
    {
        $this->kpi = $kpi;

        return $this;
    }

    public function getHistory(): ?string
    {
        return $this->history;
    }

    public function setHistory(?string $history): static
    {
        $this->history = $history;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getPayment(): ?string
    {
        return $this->payment;
    }

    public function setPayment(?string $payment): static
    {
        $this->payment = $payment;

        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(?int $amount): static
    {
        $this->amount = $amount;

        return $this;
    }

    public function getFormat(): ?string
    {
        return $this->format;
    }

    public function setFormat(?string $format): static
    {
        $this->format = $format;

        return $this;
    }

    public function getExpenses(): ?int
    {
        return $this->expenses;
    }

    public function setExpenses(?int $expenses): static
    {
        $this->expenses = $expenses;

        return $this;
    }

    public function getContract(): ?string
    {
        return $this->contract;
    }

    public function setContract(?string  $contract): static
    {
        $this->contract = $contract;

        return $this;
    }

    public function getLaunch(): ?string
    {
        return $this->launch;
    }

    public function setLaunch(?string $launch): static
    {
        $this->launch = $launch;

        return $this;
    }

    public function getDeadline(): ?string
    {
        return $this->deadline;
    }

    public function setDeadline(?string $deadline): static
    {
        $this->deadline = $deadline;

        return $this;
    }

    public function getSpecialist(): ?string
    {
        return $this->specialist;
    }

    public function setSpecialist(?string $specialist): static
    {
        $this->specialist = $specialist;

        return $this;
    }

    public function getMentor(): ?string
    {
        return $this->mentor;
    }

    public function setMentor(?string $mentor): static
    {
        $this->mentor = $mentor;

        return $this;
    }
}