<?php

namespace App\Components\Novaposhta\Builder;

use App\Components\Novaposhta\Entity\NovaposhtaDeliveryCost;

class NovaposhtaDeliveryCostBuilder
{
    /**
     * @param array $item
     * @return NovaposhtaSettlement|null
     */
    public function build(array $item): ?NovaposhtaDeliveryCost
    {
        if (empty($item)) {
            return null;
        }
        $entity = new NovaposhtaDeliveryCost();
        $entity->setAssessedCost($item['AssessedCost']);
        $entity->setCost($item['Cost']);

        return $entity;
    }

    /**
     * @param array $items
     * @return array
     */
    public function buildMany(array $items): array
    {
        $result = [];

        foreach ($items as $item) {
            $result[] = $this->build($item)->toArray();
        }

        return $result;
    }
}
