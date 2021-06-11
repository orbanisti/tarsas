<?php

namespace App\Entity;

use App\Repository\RecruitmentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RecruitmentRepository::class)
 * @ORM\Table(name="everest_recruitment")
 */
class Recruitment extends BaseEntity
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $channel;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $comment;


    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $cvOk;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $firstRoundAt;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $message;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $offer;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $secondRoundAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $selectPosition;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $subject;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChannel(): ?string
    {
        return $this->channel;
    }

    public function setChannel(?string $channel): self
    {
        $this->channel = $channel;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getCvOk(): ?string
    {
        return $this->cvOk;
    }

    public function setCvOk(?string $cvOk): self
    {
        $this->cvOk = $cvOk;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getFirstRoundAt(): ?\DateTimeInterface
    {
        return $this->firstRoundAt;
    }

    public function setFirstRoundAt(?\DateTimeInterface $firstRoundAt): self
    {
        $this->firstRoundAt = $firstRoundAt;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getOffer(): ?string
    {
        return $this->offer;
    }

    public function setOffer(?string $offer): self
    {
        $this->offer = $offer;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getSecondRoundAt(): ?\DateTimeInterface
    {
        return $this->secondRoundAt;
    }

    public function setSecondRoundAt(?\DateTimeInterface $secondRoundAt): self
    {
        $this->secondRoundAt = $secondRoundAt;

        return $this;
    }

    public function getSelectPosition(): ?string
    {
        return $this->selectPosition;
    }

    public function setSelectPosition(?string $selectPosition): self
    {
        $this->selectPosition = $selectPosition;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(?string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }


}
