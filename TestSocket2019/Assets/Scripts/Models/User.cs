
using System;

[Serializable]
public class User
{
    public string id;
    public string name;
    public string email; 

    public override string ToString()
    {
        return string.Format("id: {0}\nname: {1}\nemail: {2}", id, name, email);
    }
}
