<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Car
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
     * @var CarModel
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\CarModel")
     * @ORM\JoinColumn()
     */
    private $carModel;

    /**
     * @var CarModification
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\CarModification")
     * @ORM\JoinColumn()
     */
    private $carModification;

    /**
     * @var string
     *
     * @ORM\Column(length=17, nullable=true, unique=true)
     */
    private $vin;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $year;

    /**
     * @var Operand
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Operand")
     * @ORM\JoinColumn()
     */
    private $owner;

    /**
     * @var string
     *
     * @ORM\Column(nullable=true)
     */
    private $gosnomer;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="sprite_id", type="integer", nullable=true)
     */
    private $spriteId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @var Order[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Order", mappedBy="car")
     */
    private $orders;

    /**
     * @var CarRecommendation[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\CarRecommendation", mappedBy="car", cascade={"persist"})
     */
    private $recommendations;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->orders = new ArrayCollection();
        $this->recommendations = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return CarModel
     */
    public function getCarModel(): ?CarModel
    {
        return $this->carModel;
    }

    /**
     * @param CarModel $carModel
     */
    public function setCarModel(CarModel $carModel)
    {
        $this->carModel = $carModel;
    }

    /**
     * @return CarModification
     */
    public function getCarModification(): ?CarModification
    {
        return $this->carModification;
    }

    /**
     * @param CarModification $carModification
     */
    public function setCarModification(CarModification $carModification)
    {
        $this->carModification = $carModification;
    }

    /**
     * @return string
     */
    public function getVin(): ?string
    {
        return $this->vin;
    }

    /**
     * @param string $vin
     */
    public function setVin(string $vin = null)
    {
        $this->vin = $vin;
    }

    /**
     * @return int
     */
    public function getYear(): ?int
    {
        return $this->year;
    }

    /**
     * @param int $year
     */
    public function setYear(int $year)
    {
        $this->year = $year;
    }

    /**
     * @return Operand
     */
    public function getOwner(): ?Operand
    {
        return $this->owner;
    }

    /**
     * @param Operand $owner
     */
    public function setOwner(Operand $owner)
    {
        $this->owner = $owner;
    }

    /**
     * @return string
     */
    public function getMileage(): ?string
    {
        /** @var Order $order */
        if ($order = $this->orders->last()) {
            return $order->getMileage();
        }

        return null;
    }

    /**
     * @return string
     */
    public function getGosnomer(): ?string
    {
        $roman = ['A', 'B', 'E', 'K', 'M', 'H', 'O', 'P', 'C', 'T', 'Y', 'X'];
        $cyrillic = ['А', 'В', 'Е', 'К', 'М', 'Н', 'О', 'Р', 'С', 'Т', 'У', 'Х'];

        return str_replace($cyrillic, $roman, mb_convert_case($this->gosnomer, MB_CASE_UPPER, 'UTF-8'));
    }

    /**
     * @param string $gosnomer
     */
    public function setGosnomer(string $gosnomer = null)
    {
        $this->gosnomer = $gosnomer;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description = null)
    {
        $this->description = $description;
    }

    /**
     * @param Criteria|null $criteria
     *
     * @return CarRecommendation[]
     */
    public function getRecommendations(Criteria $criteria = null): array
    {
        $criteria = $criteria ?: Criteria::create()->andWhere(Criteria::expr()->isNull('expiredAt'));

        return $this->recommendations->matching($criteria)->toArray();
    }

    public function addRecommendation(CarRecommendation $recommendation): void
    {
        $this->recommendations[] = $recommendation;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function getCarModificationDisplayName(): string
    {
        return (string) ($this->carModification ? $this->carModification->getDisplayName() : $this->carModel);
    }

    public function __toString(): string
    {
        return sprintf('%s, (%s)', $this->getCarModificationDisplayName(), $this->getGosnomer());
    }
}
