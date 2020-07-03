using UnityEngine;
using System;

[Serializable]
public class FireworkInfo : MonoBehaviour
{
    public string author;
    public string x;
    public string y;

    public FireworkInfo(string author, string x, string y)
    {
        this.author = author;
        this.x = x;
        this.y = y;
    }

    override public string ToString()
    {
        return string.Format("{0} lance son feu d'artifice à la position ({1}, {2})", author, x, y);
    }
}
