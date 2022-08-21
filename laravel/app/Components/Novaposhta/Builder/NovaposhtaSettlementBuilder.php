<?php

namespace App\Components\Novaposhta\Builder;


use App\Components\Novaposhta\Entity\NovaposhtaSettlement;

/**
 * Class NovaposhtaSettlementBuilder
 * @package common\modules\dict\novaposhta\Builder
 */
class NovaposhtaSettlementBuilder
{
    /**
     * @param array $item
     * @return NovaposhtaSettlement|null
     */
    public function build(array $item): ?NovaposhtaSettlement
    {
        if (empty($item)) {
            return null;
        }

        $entity = new NovaposhtaSettlement();
        $entity->setRef($item['Ref']);
        $entity->setDescription($item['Description']);
        $entity->setSettlementTypeDescription($item['SettlementTypeDescription']);
        $entity->setRegionsDescription($item['RegionsDescription']);
        $entity->setAreaDescription($item['AreaDescription']);
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
