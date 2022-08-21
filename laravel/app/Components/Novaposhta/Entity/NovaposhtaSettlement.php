<?php

namespace App\Components\Novaposhta\Entity;

/**
 * Class NovaposhtaSettlement
 * @package common\modules\dict\novaposhta\Entity
 */
class NovaposhtaSettlement
{
    /**
     * 	Ідентифікатор (REF) населеного пункту
     * @var string
     */
    private $ref;


    /**
     * UUID Тип населеного пункту
     * @var string
     */
    private $type;

    /**
     * Адреса українською мовою
     * @var string
     */
    private $description;


    /**
     * Тип населеного пункту українською мовою
     * @var string
     */
    private $settlementTypeDescription;

    /**
     * Область українською мовою
     * @var string
     */
    private $regionsDescription;

    /**
     * Опис області українською мовою
     * @var string
     */
    private $areaDescription;

    /**
     * @param string $ref
     * @return $this
     */
    public function setRef(string $ref): self
    {
        $this->ref = $ref;
        return $this;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }


    /**
     * @param string $settlementTypeDescription
     * @return $this
     */
    public function setSettlementTypeDescription(string $settlementTypeDescription): self
    {
        $this->settlementTypeDescription = $settlementTypeDescription;
        return $this;
    }

    /**
     * @param string $regionDescription
     * @return $this
     */
    public function setRegionsDescription(string $regionDescription): self
    {
        $this->regionsDescription = $regionDescription;
        return $this;
    }
    /**
     * @param string $areaDescription
     * @return $this
     */
    public function setAreaDescription(string $areaDescription): self
    {
        $this->areaDescription = $areaDescription;
        return $this;
    }

    /**
     * @return string
     */
    public function getRef(): string
    {
        return $this->ref;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getSettlementTypeDescription(): string
    {
        return $this->settlementTypeDescription;
    }

    /**
     * @return string
     */
    public function getRegionsDescription(): string
    {
        return $this->regionsDescription;
    }

    /**
     * @return string
     */
    public function getAreaDescription(): string
    {
        return $this->areaDescription;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'ref' => $this->getRef(),
            'description' => $this->getDescription(),
            'type_description' => $this->getSettlementTypeDescription(),
            'region_description' => $this->getRegionsDescription(),
            'area_description' => $this->getAreaDescription(),
        ];
    }
}
