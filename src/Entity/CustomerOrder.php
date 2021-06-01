<?php

namespace App\Entity;

use App\Repository\CustomerOrderRepository;
use DateTime;
use DateTimeZone;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=CustomerOrderRepository::class)
 * @Vich\Uploadable
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
     * @ORM\Column(type="date", nullable=true)
     */
    private $datedesigned;

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

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $currentState = [];

    /**
     * @ORM\Column(type="string", length=24, nullable=true)
     */
    private $color;

    /**
     * @ORM\Column(type="string", length=24, nullable=true)
     */
    private $orientation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $itemsize;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $price;
    
    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="refined", fileNameProperty="imageName", size="imageSize")
     * 
     * @var File|null
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string|null
     */
    private $imageName;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int|null
     */
    private $imageSize;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTimeInterface|null
     */
    private $updatedAt;

    public function __construct()
    {
        $this->designs = new ArrayCollection();
        $this->refinedDesign = new ArrayCollection();
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

    public function getCurrentState(): ?array
    {
        return $this->currentState;
    }

    public function setCurrentState(?array $currentState): self
    {
        $this->currentState = $currentState;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getOrientation(): ?string
    {
        return $this->orientation;
    }

    public function setOrientation(?string $orientation): self
    {
        $this->orientation = $orientation;

        return $this;
    }

    public function getItemsize(): ?string
    {
        return $this->itemsize;
    }

    public function setItemsize(string $itemsize): self
    {
        $this->itemsize = $itemsize;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDatedesigned(): ?\DateTimeInterface
    {
        return $this->datedesigned;
    }

    public function setDatedesigned(?\DateTimeInterface $datedesigned): self
    {
        $this->datedesigned = $datedesigned;

        return $this;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;
        if ($imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->setUpdatedAt(new DateTime('now', new DateTimeZone('Pacific/Port_Moresby')));
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function getImageSize(): ?int
    {
        return $this->imageSize;
    }

    public function setImageSize(?int $imageSize): void
    {
        $this->imageSize = $imageSize;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

}
