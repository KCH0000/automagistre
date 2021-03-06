<?php

declare(strict_types=1);

namespace App\Controller\EasyAdmin;

use App\Entity\Part;
use App\Entity\Supply;
use App\Form\Model\Supply as SupplyModel;

/**
 * @author Konstantin Grachev <me@grachevko.ru>
 */
final class SupplyController extends AbstractController
{
    protected function createNewEntity()
    {
        $model = new SupplyModel();

        $requestQuery = $this->request->query;

        if ($part = $this->getEntity(Part::class)) {
            $model->part = $part;
        }

        if ($quantity = $requestQuery->getInt('quantity')) {
            $model->quantity = $quantity;
        }

        return $model;
    }

    /**
     * @param SupplyModel $model
     */
    protected function persistEntity($model): void
    {
        parent::persistEntity(
            new Supply($model->supplier, $model->part, $model->price, $model->quantity)
        );
    }
}
