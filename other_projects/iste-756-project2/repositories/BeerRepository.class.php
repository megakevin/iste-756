<?php

require_once "models/Beer.class.php";

class BeerRepository
{
    // Hardcoded data because requirements
    private static $beers = array(
        array('id' => 1, 'name' => "Budweiser", 'price' => 10.49),
        array('id' => 2, 'name' => "Coors", 'price' => 9.99),
        array('id' => 3, 'name' => "Corona", 'price' => 13.49),
        array('id' => 4, 'name' => "Genesee", 'price' => 5.99),
        array('id' => 5, 'name' => "Guiness", 'price' => 14.99),
        array('id' => 6, 'name' => "Labatt", 'price' => 8.99),
        array('id' => 7, 'name' => "Sam Adams", 'price' => 13.99)
    );

    public function __construct() { }

    public function select_all()
    {
        $beers_to_return = array();

        foreach (BeerRepository::$beers as $beer)
        {
            $beers_to_return[] = new Beer($beer['id'], $beer['name'], $beer['price']);
        }

        return $beers_to_return;
    }

    public function select_by_name($beer_name)
    {
        foreach (BeerRepository::$beers as $beer)
        {
            if ($beer['name'] == $beer_name)
            {
                return new Beer($beer['id'], $beer['name'], $beer['price']);
            }
        }

        return null;
    }

    public function select_cheapest()
    {
        $cheapest_beer = BeerRepository::$beers[0];

        foreach (BeerRepository::$beers as $beer)
        {
            if ($cheapest_beer['price'] >= $beer['price'])
            {
                $cheapest_beer = $beer;
            }
        }

        return new Beer($cheapest_beer['id'], $cheapest_beer['name'], $cheapest_beer['price']);
    }

    public function select_costliest()
    {
        $costliest_beer = BeerRepository::$beers[0];

        foreach (BeerRepository::$beers as $beer)
        {
            if ($costliest_beer['price'] <= $beer['price'])
            {
                $costliest_beer = $beer;
            }
        }

        return new Beer($costliest_beer['id'], $costliest_beer['name'], $costliest_beer['price']);
    }

    public function update($beer)
    {
        //nothing... this is just mock data.
        return true;
    }
}