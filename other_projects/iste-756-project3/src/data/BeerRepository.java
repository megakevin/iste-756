package data;

import java.util.ArrayList;

public class BeerRepository
{
    private String dbName = "kac2375";
    private String user = "kac2375";
    private String pswd = ".que.vaina.es.esta.";
    private String host = "localhost";
    private String port = "3306";

    public double getPrice(String beer) throws Exception
    {
        double price = 0.00;

        DatabaseAccess db = new DatabaseAccess(this.dbName, this.user, this.pswd, this.host, this.port);

        String sql = "select beerprice FROM beers where beername = ?;";
        ArrayList<String> params = new ArrayList<String>();
        params.add(beer);

        ArrayList<ArrayList<String>> result = db.getDataPS(sql, params);

        if (result != null)
        {
            price = Double.parseDouble(result.get(0).get(0));
        }

        return price;
    }

    public boolean setPrice(String beer, double price) throws Exception
    {
        boolean updated = false;

        DatabaseAccess db = new DatabaseAccess(this.dbName, this.user, this.pswd, this.host, this.port);

        String sql = "UPDATE beers SET beerprice = ? where beername = ?;";
        ArrayList<String> params = new ArrayList<String>();
        params.add(Double.toString(price));
        params.add(beer);

        int updated_rows = db.nonSelect(sql, params);

        if (updated_rows > 0)
        {
            updated = true;
        }

        return updated;
    }

    public ArrayList<String> getBeers() throws Exception
    {
        ArrayList<String> beers = new ArrayList<String>();

        DatabaseAccess db = new DatabaseAccess(this.dbName, this.user, this.pswd, this.host, this.port);

        String sql = "select id, beername, beerprice from beers;";
        ArrayList<ArrayList<String>> result = db.getData(sql);

        if (result != null)
        {
            for (ArrayList<String> row : result)
            {
                beers.add(row.get(1));
            }
        }

        return beers;
    }

    public String getCheapest() throws Exception
    {
        String cheapest = "";

        DatabaseAccess db = new DatabaseAccess(this.dbName, this.user, this.pswd, this.host, this.port);

        String sql = "select beername FROM beers order by beerprice asc limit 1;";
        ArrayList<ArrayList<String>> result = db.getData(sql);

        if (result != null)
        {
            cheapest = result.get(0).get(0);
        }

        return cheapest;
    }

    public String getCostliest() throws Exception
    {
        String costliest = "";

        DatabaseAccess db = new DatabaseAccess(this.dbName, this.user, this.pswd, this.host, this.port);

        String sql = "select beername FROM beers order by beerprice desc limit 1;";
        ArrayList<ArrayList<String>> result = db.getData(sql);

        if (result != null)
        {
            costliest = result.get(0).get(0);
        }

        return costliest;
    }
}
