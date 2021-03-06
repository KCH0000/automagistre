<?php

declare(strict_types=1);

namespace App\Form\Model;

use App\Entity\Operand;
use Money\Money;

/**
 * @author Konstantin Grachev <me@grachevko.ru>
 */
final class Supply extends Model
{
    /**
     * @var Operand
     */
    public $supplier;

    /**
     * @var \App\Entity\Part
     */
    public $part;

    /**
     * @var Money
     */
    public $price;

    /**
     * @var int
     */
    public $quantity;

    public static function getEntityClass(): string
    {
        return \App\Entity\Supply::class;
    }
}
