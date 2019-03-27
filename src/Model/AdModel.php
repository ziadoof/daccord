<?php
/**
 * Created by PhpStorm.
 * User: ziadoof
 * Date: 26/03/19
 * Time: 12:56
 */

namespace App\Model;


class AdModel
{
    protected $title;

    protected $price;

    protected $sSize;

    protected $manufacturingYear;

    /**
     * @return mixed
     */
    public function getManufacturingYear()
    {
        return $this->manufacturingYear;
    }

    /**
     * @param mixed $manufacturingYear
     */
    public function setManufacturingYear($manufacturingYear): void
    {
        $this->manufacturingYear = $manufacturingYear;
    }

    /**
     * @return mixed
     */
    public function getSSize()
    {
        return $this->sSize;
    }

    /**
     * @param mixed $sSize
     */
    public function setSSize($sSize): void
    {
        $this->sSize = $sSize;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }


}