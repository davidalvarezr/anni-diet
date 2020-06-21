using System;
using System.Threading.Tasks;
using JetBrains.Annotations;
using Newtonsoft.Json;
using Newtonsoft.Json.Linq;
using PusherClient;
using UnityEngine;

public class PusherManager : MonoBehaviour
{
    public static PusherManager instance = null;
    private Pusher pusher;
    private Channel channel;

    async Task Start()
    {
        if (instance == null)
        {
            instance = this;
        }
        else if (instance != this)
        {
            Destroy(gameObject);
        }
        DontDestroyOnLoad(gameObject);
        await InitialisePusher();
    }

    private async Task InitialisePusher()
    {

        if (pusher == null)
        {
            pusher = new Pusher("8c2980cfa587778b9cf5", new PusherOptions()
            {
                Cluster = "eu",
                Encrypted = true
            });

            pusher.Error += OnPusherOnError;
            pusher.ConnectionStateChanged += PusherOnConnectionStateChanged;
            pusher.Connected += PusherOnConnected;
            channel = await pusher.SubscribeAsync("my-channel");
            channel.Subscribed += OnChannelOnSubscribed;
            await pusher.ConnectAsync();
        }
    }

    private void PusherOnConnected(object sender)
    {
        Debug.Log("Connected");
        channel.Bind("my-event", (dynamic pusherEvent) =>
        {
            //Debug.Log("my-event received");
            //Debug.Log(pusherEvent.GetType().ToString());
            //Debug.Log(((JObject)pusherEvent).ToString());

            try
            {
                PEvent<FireworkInfo> pe = new PEvent<FireworkInfo>(pusherEvent);
                Debug.Log(pe);
            } catch (Exception e)
            {
                Debug.LogError($"{e.GetType()} - {e.Message}\n{e.StackTrace}");
            }
        });
        //channel.Trigger("my-event", JObject.Parse("{message: ent from Unity}"));
    }

    private void PusherOnConnectionStateChanged(object sender, ConnectionState state)
    {
        Debug.Log("Connection state changed");
    }

    private void OnPusherOnError(object s, PusherException e)
    {
        Debug.Log("Errored");
    }

    private void OnChannelOnSubscribed(object s)
    {
        Debug.Log("Subscribed");
    }

    async Task OnApplicationQuit()
    {
        if (pusher != null)
        {
            await pusher.DisconnectAsync();
        }
    }
}
