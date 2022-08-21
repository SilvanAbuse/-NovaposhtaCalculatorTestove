<?php

namespace App\Components\Novaposhta\Builder;

use App\Components\Novaposhta\Response\NovaposhtaResponse;

/**
 * Class NovaposhtaResponseBuilder
 * @package common\modules\dict\novaposhta\Builder
 */
class NovaposhtaResponseBuilder
{
    private $itemBuilder;

    /**
     * @param array $params
     * @return mixed
     */
    public function build(array $params)
    {
        if (!$this->itemBuilder) {
            throw new \InvalidArgumentException('Item Builder not set. Use setItemBuilder method.');
        }

        $items = $this->itemBuilder->buildMany($params['data']);

        return new NovaposhtaResponse(
            $items,
            $params['errors'],
            $params['info']
        );
    }

    /**
     * @param $builder
     */
    public function setItemBuilder($builder)
    {
        $this->itemBuilder = $builder;
    }
}
