<?php

require_once "repositories/BeerRepository.class.php";

class BeerService
{
    private $beer_repository;

    public function __construct()
    {
        $this->beer_repository = new BeerRepository();
    }

    public function get_all_beers()
    {
        return $this->beer_repository->select_all();
    }

    public function get_cheapest_beer()
    {
        return $this->beer_repository->select_cheapest();
    }

    public function get_costliest_beer()
    {
        return $this->beer_repository->select_costliest();
    }

    public function get_beer_price($beer_name)
    {
        $beer = $this->beer_repository->select_by_name($beer_name);
        return $beer->price;
    }

    public function set_beer_price($beer_name, $beer_price)
    {
        $beer = $this->beer_repository->select_by_name($beer_name);

        if ($beer)
        {
            $beer->price = $beer_price;

            try
            {
                $this->beer_repository->update($beer);
                return true;
            }
            catch (Exception $ex)
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }
}