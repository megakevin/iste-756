package domain;

import java.util.Date;

public class Token
{
    public int id;
    public String guid;
    public Date expirationDate;
    public int userId;

    @Override
    public String toString()
    {
        return Integer.toString(this.id) + " " +
                this.guid + " " +
                this.expirationDate.toString() + " " +
                Integer.toString(this.userId);
    }
}
