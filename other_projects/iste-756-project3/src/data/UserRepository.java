package data;

import java.beans.ExceptionListener;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;

import domain.Token;
import domain.User;

public class UserRepository extends BaseRepository
{
    public UserRepository()
    {

    }

    public User getUser(String username, String password) throws Exception
    {
        User user = null;

        DatabaseAccess db = new DatabaseAccess(this.dbName, this.user, this.pswd, this.host, this.port);

        String sql = "select id, username, age, role FROM users where username = ? and password = ?;";
        ArrayList<String> params = new ArrayList<String>();
        params.add(username);
        params.add(password);

        ArrayList<ArrayList<String>> result = db.getDataPS(sql, params);

        if (result != null)
        {
            ArrayList<String> userRow = result.get(0);
            user = new User();

            user.id = Integer.parseInt(userRow.get(0));
            user.username = userRow.get(1);
            user.age = Integer.parseInt(userRow.get(2));
            user.role = userRow.get(3);
        }

        return user;
    }

    public void createToken(int userId, String tokenGuid, Date expirationDate) throws Exception
    {
        DatabaseAccess db = new DatabaseAccess(this.dbName, this.user, this.pswd, this.host, this.port);

        String sql = "INSERT INTO tokens(guid, expiration_date, user_id) VALUES (?, ?, ?);";
        ArrayList<String> params = new ArrayList<String>();
        params.add(tokenGuid);
        params.add(new SimpleDateFormat("yyyy-MM-dd HH:mm:ss").format(expirationDate));
        params.add(Integer.toString(userId));

        db.nonSelect(sql, params);
    }

    public Token getToken(String tokenGuid) throws Exception
    {
        Token token = null;

        DatabaseAccess db = new DatabaseAccess(this.dbName, this.user, this.pswd, this.host, this.port);

        String sql = "select id, guid, expiration_date, user_id FROM tokens where guid = ?;";
        ArrayList<String> params = new ArrayList<String>();
        params.add(tokenGuid);

        ArrayList<ArrayList<String>> result = db.getDataPS(sql, params);

        if (result != null)
        {
            ArrayList<String> tokenRow = result.get(0);
            token = new Token();

            token.id = Integer.parseInt(tokenRow.get(0));
            token.guid = tokenRow.get(1);
            token.expirationDate = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss").parse(tokenRow.get(2));
            token.userId = Integer.parseInt(tokenRow.get(3));
        }

        return token;
    }

    public User getUserFromToken(String tokenGuid) throws Exception
    {
        User user = null;

        DatabaseAccess db = new DatabaseAccess(this.dbName, this.user, this.pswd, this.host, this.port);

        String sql =
                "select u.id, u.username, u.age, u.role " +
                "from tokens as t " +
                "inner join users as u on t.user_id = u.id " +
                "where t.guid = ?;";
        ArrayList<String> params = new ArrayList<String>();
        params.add(tokenGuid);

        ArrayList<ArrayList<String>> result = db.getDataPS(sql, params);

        if (result != null)
        {
            ArrayList<String> userRow = result.get(0);
            user = new User();

            user.id = Integer.parseInt(userRow.get(0));
            user.username = userRow.get(1);
            user.age = Integer.parseInt(userRow.get(2));
            user.role = userRow.get(3);
        }

        return user;
    }

    public void deleteToken(String tokenGuid) throws Exception
    {
        DatabaseAccess db = new DatabaseAccess(this.dbName, this.user, this.pswd, this.host, this.port);

        String sql = "DELETE FROM tokens WHERE guid = ?;";
        ArrayList<String> params = new ArrayList<String>();
        params.add(tokenGuid);

        db.nonSelect(sql, params);
    }

    public void deleteTokenForUser(int userId) throws Exception
    {
        DatabaseAccess db = new DatabaseAccess(this.dbName, this.user, this.pswd, this.host, this.port);

        String sql = "DELETE FROM tokens WHERE user_id = ?;";
        ArrayList<String> params = new ArrayList<String>();
        params.add(Integer.toString(userId));

        db.nonSelect(sql, params);
    }
}
