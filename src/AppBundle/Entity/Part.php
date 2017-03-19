<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="part", uniqueConstraints={
 *     @ORM\UniqueConstraint(name="part_idx", columns={"partnumber", "manufacturer_id"})
 * })
 * @ORM\Entity
 */
class Part
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var Manufacturer
     *
     * @Assert\NotBlank()
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Manufacturer")
     * @ORM\JoinColumn()
     */
    private $manufacturer;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(nullable=true)
     */
    private $partname;

    /**
     * @var string
     *
     * @ORM\Column(name="partnumber_disp", length=64, nullable=true)
     */
    private $partnumberDisp;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(length=30)
     */
    private $partnumber;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * @var bool
     *
     * @ORM\Column(name="negative", type="boolean", nullable=true)
     */
    private $negative;

    /**
     * @var bool
     *
     * @ORM\Column(name="fractional", type="boolean", nullable=true)
     */
    private $fractional;

    /**
     * @var int
     *
     * @ORM\Column(nullable=true)
     */
    private $price = 0;

    /**
     * @var float
     *
     * @ORM\Column(name="quantity", type="float", precision=10, scale=0, nullable=true)
     */
    private $quantity;

    /**
     * @var int
     *
     * @ORM\Column(name="reserved", type="integer", nullable=false)
     */
    private $reserved = 0;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getManufacturer(): ?Manufacturer
    {
        return $this->manufacturer;
    }

    public function setManufacturer(Manufacturer $manufacturer)
    {
        $this->manufacturer = $manufacturer;
    }

    public function getName(): ?string
    {
        return $this->partname;
    }

    public function setName(string $name): void
    {
        $this->partname = $name;
    }

    /**
     * @deprecated
     */
    public function getPartname(): ?string
    {
        return $this->getName();
    }

    /**
     * @deprecated
     */
    public function setPartname(string $partname)
    {
        $this->setName($partname);
    }

    public function getPartnumber(): ?string
    {
        return $this->partnumber;
    }

    public function setPartnumber(string $partnumber)
    {
        $this->partnumber = $partnumber;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price)
    {
        $this->price = $price;
    }

    public function __toString(): string
    {
        return (string) $this->getName();
    }
}
