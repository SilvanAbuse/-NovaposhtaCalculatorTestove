<?php

namespace App\Components\Novaposhta\Entity;

class NovaposhtaDeliveryCost
{


    /**
     * Оціночна вартість
     * @var string
     */
    private $assessedCost;

    /**
     * Вартість
     * @var string
     */
    private $cost;

//    /**
//     * Вартість зворотної доставки
//     * @var string
//     */
//    private $costRedelivery;
//
//    /**
//     * 	Інформація про тарифну зону доставки
//     * @var object
//     */
//    private $TZoneInfo;
//
//    /**
//     * Вартість пакування
//     * @var string
//     */
//    private $costPack;
//

    /**
     * @return string
     */
    public function getAssessedCost(): string
    {
        return $this->assessedCost;
    }

    /**
     * @param string $assessedCost
     */
    public function setAssessedCost(string $assessedCost)
    {
        $this->assessedCost = $assessedCost;
    }

    /**
     * @return string
     */
    public function getCost(): string
    {
        return $this->cost;
    }

    /**
     * @param string $cost
     */
    public function setCost(string $cost)
    {
        $this->cost = $cost;
    }

//    /**
//     * @return string
//     */
//    public function getCostPack(): string
//    {
//        return $this->costPack;
//    }
//
//    /**
//     * @param string $costPack
//     */
//    public function setCostPack(string $costPack)
//    {
//        $this->costPack = $costPack;
//    }
//
//    /**
//     * @return string
//     */
//    public function getCostRedelivery(): string
//    {
//        return $this->costRedelivery;
//    }
//
//    /**
//     * @param string $costRedelivery
//     */
//    public function setCostRedelivery(string $costRedelivery)
//    {
//        $this->costRedelivery = $costRedelivery;
//    }
//
//    /**
//     * @return object
//     */
//    public function getTZoneInfo()
//    {
//        return $this->TZoneInfo;
//    }
//
//    /**
//     * @param object $TZoneInfo
//     */
//    public function setTZoneInfo($TZoneInfo)
//    {
//        $this->TZoneInfo = $TZoneInfo;
//    }
//

    public function toArray()
    {
        return [
            'assessedCost' => $this->getAssessedCost(),
            'cost' => $this->getCost()
        ];
    }
}
