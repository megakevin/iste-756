package service;

import java.util.*;
import javax.jws.*;
import java.util.UUID;

import domain.AuthenticationController;
import domain.BeerController;

@WebService
public class BeerService
{
    private AuthenticationController authenticationController;
    private BeerController beerController;

    private String invalidRequestErrorMessage = "Invalid Request!";

    public BeerService()
    {
        this.authenticationController = new AuthenticationController();
        this.beerController = new BeerController();
    }

    @WebMethod
    public String getToken(String username, String password) throws Exception
    {
        try
        {
            return this.authenticationController.authenticate(username, password);
        }
        catch (Exception ex)
        {
            throw ex;
        }
    }

    @WebMethod
    public ArrayList<String> getMethods()
    {
        ArrayList<String> methods = new ArrayList<String>();

        methods.add("public String getToken(String username,String password)");
        methods.add("public ArrayList<String> getMethods()");
        methods.add("public Double getPrice(String beer)");
        methods.add("public Boolean setPrice(String beer, Double price)");
        methods.add("public ArrayList<String> getBeers()");
        methods.add("public String getCheapest()");
        methods.add("public String getCostliest()");

        return methods;
    }

    private boolean isValidRequest(String token) throws Exception
    {
        boolean isValid = false;

        if (this.authenticationController.isValidToken(token))
        {
            if (this.authenticationController.isAllowedAge(token))
            {
                if (this.authenticationController.isAllowedTime())
                {
                    isValid = true;
                }
            }
        }

        return isValid;
    }

    @WebMethod
    public Double getPrice(String beer, String token) throws Exception
    {
        boolean isValid = this.isValidRequest(token);
        this.authenticationController.destroyToken(token);

        if (isValid)
        {
            return this.beerController.getPrice(beer);
        }
        else
        {
            throw new Exception(this.invalidRequestErrorMessage);
        }
    }

    @WebMethod
    public boolean setPrice(String beer, Double price, String token) throws Exception
    {
        boolean isValid = this.isValidRequest(token) && this.authenticationController.isAdmin(token);
        this.authenticationController.destroyToken(token);

        if (isValid)
        {
            return this.beerController.setPrice(beer, price);
        }
        else
        {
            throw new Exception(this.invalidRequestErrorMessage);
        }
    }

    @WebMethod
    public ArrayList<String> getBeers(String token) throws Exception
    {
        boolean isValid = this.isValidRequest(token);
        this.authenticationController.destroyToken(token);

        if (isValid)
        {
            return this.beerController.getBeers();
        }
        else
        {
            throw new Exception(this.invalidRequestErrorMessage);
        }
    }

    @WebMethod
    public String getCheapest(String token) throws Exception
    {
        boolean isValid = this.isValidRequest(token);
        this.authenticationController.destroyToken(token);

        if (isValid)
        {
            return this.beerController.getCheapest();
        }
        else
        {
            throw new Exception(this.invalidRequestErrorMessage);
        }
    }

    @WebMethod
    public String getCostliest(String token) throws Exception
    {
        boolean isValid = this.isValidRequest(token);
        this.authenticationController.destroyToken(token);

        if (isValid)
        {
            return this.beerController.getCostliest();
        }
        else
        {
            throw new Exception(this.invalidRequestErrorMessage);
        }
    }
}