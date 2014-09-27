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

- __DIN_STI__ er den sti du vil kalde i APIen
- _PARAMETRE_ er de parametre (GET eller POST) du vil sende med
- _METODE_ er enten GET eller POST. Du kan med fordel bruge konstanterne `Greenticket::GET` og `Greenticket::POST`