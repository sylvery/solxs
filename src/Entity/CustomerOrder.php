<?php

namespace App\Entity;

use App\Repository\CustomerOrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CustomerOrderRepository::class)
 */
class CustomerOrder
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Customer::class, inversedBy="customerOrders")
     */
    private $customer;

    /**
     * @ORM\ManyToMany(targetEntity=Design::class, inversedBy="customerOrders")
     */
    private $designs;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateordered;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $designed;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $printed;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateprinted;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $paid;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $delivered;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datedelivered;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $deliveryLocation;
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $printsubmitted;

    public function __construct()
    {
        $this->designs = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getId() . ' - ' . $this->getDescription();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * @return Collection|Design[]
     */
    public function getDesigns(): Collection
    {
        return $this->designs;
    }

    public function addDesign(Design $design): self
    {
        if (!$this->designs->contains($design)) {
            $this->designs[] = $design;
        }

        return $this;
    }

    public function removeDesign(Design $design): self
    {
        $this->designs->removeElement($design);

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDateordered()
    {
        return $this->dateordered;
    }

    public function setDateordered( $dateordered): self
    {
        $this->dateordered = $dateordered;

        return $this;
    }

    public function getDesigned(): ?bool
    {
        return $this->designed;
    }

    public function setDesigned(?bool $designed): self
    {
        $this->designed = $designed;

        return $this;
    }

    public function getPrinted(): ?bool
    {
        return $this->printed;
    }

    public function setPrinted(?bool $printed): self
    {
        $this->printed = $printed;

        return $this;
    }

    public function getPaid(): ?bool
    {
        return $this->paid;
    }

    public function setPaid(?bool $paid): self
    {
        $this->paid = $paid;

        return $this;
    }

    public function getDelivered(): ?bool
    {
        return $this->delivered;
    }

    public function setDelivered(?bool $delivered): self
    {
        $this->delivered = $delivered;

        return $this;
    }

    public function getPrintsubmitted(): ?bool
    {
        return $this->printsubmitted;
    }

    public function setPrintsubmitted(?bool $printsubmitted): self
    {
        $this->printsubmitted = $printsubmitted;

        return $this;
    }

    public function getDateprinted(): ?\DateTimeInterface
    {
        return $this->dateprinted;
    }

    public function setDateprinted(?\DateTimeInterface $dateprinted): self
    {
        $this->dateprinted = $dateprinted;

        return $this;
    }

    public function getDatedelivered(): ?\DateTimeInterface
    {
        return $this->datedelivered;
    }

    public function setDatedelivered(?\DateTimeInterface $datedelivered): self
    {
        $this->datedelivered = $datedelivered;

        return $this;
    }

    public function getDeliveryLocation(): ?string
    {
        return $this->deliveryLocation;
    }

    public function setDeliveryLocation(string $deliveryLocation): self
    {
        $this->deliveryLocation = $deliveryLocation;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(?bool $status): self
    {
        $this->status = $status;

        return $this;
    }
}
