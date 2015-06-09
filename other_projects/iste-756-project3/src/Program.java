import data.UserRepository;
import service.BeerService;

import java.sql.*;
import java.util.UUID;
import java.util.Date;

public class Program
{
    public static void main(String[] args) throws Exception
    {
        String token = new BeerService().getToken("menor", "menor");
        System.out.println(token);
        System.out.println(new BeerService().getBeers(token)); //5.05
    }
}
