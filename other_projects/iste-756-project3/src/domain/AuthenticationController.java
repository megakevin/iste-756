package domain;

import data.UserRepository;

import java.util.Date;
import java.util.UUID;
import java.util.Calendar;
import java.util.GregorianCalendar;

public class AuthenticationController
{
    private UserRepository repository;

    private int token_expiration_minutes = 5;
    private int allowed_age = 21;

    public AuthenticationController()
    {
        this.repository = new UserRepository();
    }

    public String authenticate(String username, String password) throws Exception
    {
        User user = this.repository.getUser(username, password);

        if (user != null)
        {
            String newGuid = UUID.randomUUID().toString();

            this.repository.deleteTokenForUser(user.id);

            Calendar cal = Calendar.getInstance();
            cal.add(Calendar.MINUTE, this.token_expiration_minutes);

            this.repository.createToken(user.id, newGuid, cal.getTime());

            return newGuid;
        }
        else
        {
            throw new Exception("User not found");
        }
    }

    public boolean isValidToken(String token_guid) throws Exception
    {
        Token token = this.repository.getToken(token_guid);
        boolean isValid = false;

        if (token != null)
        {
            if (token.expirationDate.after(new Date()))
            {
                isValid = true;
            }
            else
            {
                this.destroyToken(token_guid);
            }
        }

        return isValid;
    }

    public boolean isAllowedAge(String token) throws Exception
    {
        User user = this.repository.getUserFromToken(token);
        boolean isAllowed = false;

        if (user.age >= this.allowed_age)
        {
            isAllowed = true;
        }

        return isAllowed;
    }

    public boolean isAllowedTime()
    {
        boolean isAllowed = false;

        Calendar cal = Calendar.getInstance();

        Date current = cal.getTime();

        Date openHour = new GregorianCalendar(
                cal.get(Calendar.YEAR),
                cal.get(Calendar.MONTH),
                cal.get(Calendar.DAY_OF_MONTH),
                10, 00, 00).getTime();

        Date closeHour = new GregorianCalendar(
                cal.get(Calendar.YEAR),
                cal.get(Calendar.MONTH),
                cal.get(Calendar.DAY_OF_MONTH),
                23, 59, 59).getTime();

        if (current.before(closeHour) || current.after(openHour))
        {
            isAllowed = true;
        }

        return isAllowed;
    }

    public boolean isAdmin(String token) throws Exception
    {
        User user = this.repository.getUserFromToken(token);
        boolean isAdmin = false;

        if (user != null)
        {
            if (user.role.equals(User.ADMIN_ROLE))
            {
                isAdmin = true;
            }
        }

        return isAdmin;
    }

    public void destroyToken(String token) throws Exception
    {
        this.repository.deleteToken(token);
    }
}
