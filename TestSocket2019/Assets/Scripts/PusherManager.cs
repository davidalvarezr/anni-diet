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
    public PEvent<FireworkInfo> pe;

    private const string PUSHER_KEY = "8c2980cfa587778b9cf5";
    private const string PUSHER_CLUSTER = "eu";
    private const string PUSHER_CHANNEL_NAME = "private-firework";  // "my-channel"

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
            pusher = new Pusher(PUSHER_KEY, new PusherOptions()
            {
                Cluster = PUSHER_CLUSTER,
                Encrypted = true
            });

            pusher.Error += OnPusherOnError;
            pusher.ConnectionStateChanged += PusherOnConnectionStateChanged;
            pusher.Connected += PusherOnConnected;

            try
            {
                channel = await pusher.SubscribeAsync(PUSHER_CHANNEL_NAME);
            }
            catch (Exception e)
            {
                Debug.LogError($"{e.GetType()} - {e.Message}\n{e.StackTrace}");
            }

            
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
                pe = new PEvent<FireworkInfo>(pusherEvent);
                Debug.Log(pe);
                              
                //var fVFX = new FireworksVFX(pe.data.author, float.Parse(pe.data.x), float.Parse(pe.data.y));
                //fVFX.Throwfirework();

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
