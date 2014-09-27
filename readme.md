#Greenticket PHP SDK

Med dette SDK kan du let kalde Greenticket's semi åbne web API.

For at få tildelt adgang til APIen skal du kontakte dev@greenticket.dk.

##Brug

For at komme igang skal du importere Greenticket.php i dit project og initialisere Greenticket klassen:

```PHP
require "greenticket-php-sdk/src/greenticket.php";

$gt = new Greenticket({DIT_APP_ID}, {DIN_APP_SECRET});
```

Herefter kan du let kalde Greentickets API ved at kalde:

```PHP
$result = $gt -> api({DIN_STI}, {PARAMETRE}, {METODE});
```

- _DIN_STI_ er den sti du vil kalde i APIen
- _PARAMETRE_ er de parametre (GET eller POST) du vil sende med, i form af et array
- _METODE_ er enten GET eller POST. Du kan med fordel bruge konstanterne `Greenticket::GET` og `Greenticket::POST`

##Eksempel
Her følger et hypotetisk eksempel _(alle variabler her findes ikke og eksemplet vil ikke virke, med mindre du udskifter dem)_

```PHP
require "greenticket-php-sdk/src/greenticket.php";

function getMyEvents() {
    $gt = new Greenticket(10023, "3HBdsau1sd");
    $result = $gt -> api("users/237/events", null, Greenticket::POST});
    if ($result["success"])
        return $result["events"];
}

$myEvents = getMyEvents();
```

Dette vil returnere et array fyldt med alle events, som brugeren med id _237_ er administrator på.

##Greenticket stier
De stier du kan kalde på Greenticket’s API kan findes på http://docs.greenticketdk.apiary.io (Ikke komplet). Din mulighed for at kalde de forskellige vil variere alt efter hvad Greenticket har givet dig adgang til.