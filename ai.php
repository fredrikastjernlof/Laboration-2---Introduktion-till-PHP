<?php
$title = 'AI';
$currentPage = 'ai';

require_once __DIR__ . '/includes/header.php';
?>
<section class="info-container">
    <h1>AI</h1>
    <article class="info-card">
        <h2>🤖 Så har jag arbetat med AI</h2>
        <p>
            Under arbetet med laborationen har jag använt två
            AI-verktyg: ChatGPT och GitHub Copilot.
        </p>
        <details>
            <summary></summary>
            <p>
                Tanken var att ChatGPT skulle fungera som stöd vid felsökning, 
                kodgranskning och när jag behövde hjälp att förstå PHP-syntax 
                och hur olika delar av koden samverkar. Det har fungerat sådär. 
                ChatGPT har absolut varit till hjälp i många situationer, men 
                jag har också fått förslag på lösningar som jag inte har bett om. 
                Ibland har det handlat om omfattande förändringar av kodens 
                struktur och funktion, trots att jag egentligen bara bett om 
                hjälp med en specifik sak.  
            </p>
            <p>
                Jag testade även GitHub Copilot i Visual Studio Code,
                men valde ganska snabbt att stänga av det. I stället
                för att hjälpa mig att skriva kod föreslog Copilot
                ofta stora kodblock som inte alls motsvarade det
                jag försökte göra. Förslagen blev mer störande än
                hjälpsamma och gjorde det svårare att koncentrera
                sig på min egen kod.
            </p>
        </details>
    </article>

    <article class="info-card">
        <h2>🤯 Mina erfarenheter och slutsatser </h2>
        <p>
            Min erfarenhet av AI som utvecklingsstöd har varit ganska frustrerande.
            ChatGPT har visserligen hjälpt mig att lösa vissa problem och få funktioner
            att fungera, men jag upplever inte att det har gjort mig säkrare på
            mina programmeringskunskaper.
        </p>
        <details>
            <summary></summary>
            <p>
                Just ChatGPT har verkligen testat mitt tålamod i den här uppgiften.
                Jag vet förstås att jag inte pratar med en riktig person, men det är 
                svårt att inte bli frustrerad när svaren ständigt förändras. 
                Särskilt störande är tendensen att hålla med och be om ursäkt så
                fort man ifrågasätter något, i stället för att förklara och stå för
                en tidigare bedömning. Ena stunden är en lösning bra, nästa stund
                rekommenderas något helt annat, och när man påpekar motsägelsen får
                man bara ett nytt medhåll. Det får mig att vilja skicka näven genom
                skärmen. 
            </p>
            <p>
                Ett tydligt exempel är användningen av setters för validering. Först 
                fick jag beskedet att jag hade byggt en bra lösning, vid en senare kontroll
                av något annat fick jag beskedet att det inte var så man 
                brukade göra. När jag berättade att min lösning byggde på  
                en liknande metod som min lärare hade använt under en föreläsning så var 
                den plötsligt helt okej igen. AI lägger sig platt så fort man inte håller med.
            </p>
            <p>
                Jag har också märkt hur lätt det är att börja förlita sig på AI, 
                eller åtminstone förvänta sig att svaren ska vara korrekta. Jag 
                har kontrollerat alla förslag, men när jag bett om hjälp är 
                det ju för att underlätta arbetet. När AI i stället ger felaktiga 
                eller motsägelsefulla svar blir frustrationen nästan större än 
                när jag gör fel själv. Då har jag först lagt tid på att be om 
                hjälp och sedan ytterligare tid på att granska, ifrågasätta och 
                rätta förslagen. Min slutsats är därför att AI inte nödvändigtvis 
                gör utvecklingsarbetet enklare eller snabbare. 
                Många gånger har jag känt det som att det hade varit mer effektivt 
                att lösa problemet själv från början.
            </p>
        </details>
    </article>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>