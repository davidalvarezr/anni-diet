using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.VFX;

public class FireworksVFX : MonoBehaviour
{
    public string colorBoom;
    public string colorTrail;
    public VisualEffect VFX;
    public PEvent<FireworkInfo> pe;

    void Start()
    {
        VFX = gameObject.GetComponent<VisualEffect>();
        pe = gameObject.GetComponent<PusherManager>().pe;
    }

    void Update()
    {
        
    }

    public FireworksVFX(string _creator, string _colorBoom, string _colorTrail, float x, float y)
    {
        this.creator = _creator;
        this.colorBoom = _colorBoom;
        this.colorTrail = _colorTrail;
        this.launchBase = new Vector2(x, y);
        //this.VFX = gameObject.GetComponent<VisualEffect>();
    }

    public FireworksVFX(string _creator, float x, float y)
    {
        this.creator = _creator;
        this.launchBase = new Vector3(x, y, 0);
        //this.VFX = gameObject.GetComponent<VisualEffect>();
    }

    public void Throwfirework()
    {
        this.gameObject.transform.position = launchBase;
        //VFX.enabled = true;
    }
}
