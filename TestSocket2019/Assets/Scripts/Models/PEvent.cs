using Newtonsoft.Json.Linq;
using System;

[Serializable]
public class PEvent<T> 
{
    public string @event;
    public string channel;
    public T data;


    public PEvent(dynamic pusherEvent)
    {
        this.@event = pusherEvent["event"];
        this.channel = pusherEvent["channel"];
        this.data = JObject.Parse((string)pusherEvent["data"])["message"].ToObject<T>();
    }

    public override string ToString()
    {
        return data.ToString();
    }
}
