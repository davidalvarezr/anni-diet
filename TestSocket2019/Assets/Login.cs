using Boo.Lang;
using Newtonsoft.Json;
using Newtonsoft.Json.Linq;
using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.Networking;
using UnityEngine.UI;

public class Login : MonoBehaviour
{
    public InputField EmailInput;
    public InputField PasswordInput;
    public Button LoginButton;

    // Start is called before the first frame update
    void Start()
    {
        LoginButton.onClick.AddListener(() =>
        {
            Debug.Log("Click on login");
            StartCoroutine(Upload());
        });
    }


    IEnumerator Upload()
    {
        WWWForm form = new WWWForm();
        form.AddField("email", EmailInput.text);
        form.AddField("password", PasswordInput.text);

        using (UnityWebRequest www = UnityWebRequest.Post("/api/login", form))
        {
            www.SetRequestHeader("Accept", "application/json");
            yield return www.SendWebRequest();
            
            if (www.isNetworkError || www.isHttpError)
            {
                Debug.Log(www.error);
                Debug.LogError(www.downloadHandler.text);
            } else
            {
                Debug.Log("Form uploaded complete!");
                string responseText = www.downloadHandler.text;
                Debug.Log("Response Text:" + responseText);
                string accessToken = (string) JObject.Parse(responseText)["token"];
                Debug.Log("access token: " + accessToken);
                User user = (JObject.Parse(responseText)["user"]).ToObject<User>();
                Debug.Log("user: " +  user);
            }
        }
    }

    // Update is called once per frame
    void Update()
    {
        
    }
}
