package domain;

public class User
{
    public static String ADMIN_ROLE = "admin";

    public int id;
    public String username;
    public String role;
    public int age;

    @Override
    public String toString()
    {
        return Integer.toString(this.id) + " " +
               this.username + " " +
               this.role + " " +
               Integer.toString(this.age);
    }
}
