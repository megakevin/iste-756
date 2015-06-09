package domain;

import data.BeerRepository;

import java.util.ArrayList;

public class BeerController
{
    private BeerRepository repository;

    public BeerController()
    {
        this.repository = new BeerRepository();
    }

    public double getPrice(String beer) throws Exception
    {
        return repository.getPrice(beer);
    }

    public boolean setPrice(String beer, double price) throws Exception
    {
        return repository.setPrice(beer, price);
    }

    public ArrayList<String> getBeers() throws Exception
    {
        return repository.getBeers();
    }

    public String getCheapest() throws Exception
    {
        return repository.getCheapest();
    }

    public String getCostliest() throws Exception
    {
        return repository.getCostliest();
    }
}
