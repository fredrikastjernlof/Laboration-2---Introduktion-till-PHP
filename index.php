<?php
$title = 'Hem';
$currentPage = 'home';

require_once __DIR__ . '/includes/header.php';
?>
<section class="info-container">
    <h1>Laboration 2 - Introduktion till PHP</h1>
    <article class="info-card">
        <h2>📝 Om uppgiften </h2>
        <p>
            Den här webbplatsen är skapad som en del
            av laborationen Introduktion till PHP.
            Uppgiften går ut på att utveckla en dynamisk
            webbplats med PHP, objektorienterad
            programmering och en MySQL-databas.
        </p>
        <details>
            <summary></summary>
        <p>
            Jag har skapat en bucketlist där
            användaren kan samla sina mål och drömmar –
            stora som små. Det går att lägga till nya mål,
            redigera eller radera befintliga och markera
            dem som genomförda.
        </p>
        <p>
            Webbplatsen är byggd med återanvändbara PHP-filer
            och målen lagras i en databas, så att de finns kvar
            mellan besöken.
        </p>
        </details>
    </article>

    <article class="info-card">
        <h2>💭 Mina tankar</h2>
        <p>
            Något jag uppskattar mycket med PHP är möjligheten
            att dela upp koden i mindre delar med hjälp av include
            och require. Det gör både koden och filerna mer
            överskådliga. Det påminner mig lite om Angular, som jag
            tycker väldigt mycket om att arbeta med.
        </p>
        <details>
            <summary></summary>
            <p>
                Det finns också saker jag har svårare för. När filer
                inkluderas kan de dela variabler, vilket innebär att man
                behöver hålla reda på vilka namn som redan används för
                att undvika konflikter. Å andra sidan är det smidigt att
                kunna inkludera en fil och få tillgång till det man behöver
                utan att importera varje enskild funktion.
            </p>
            <p>
                Min största utmaning med PHP är nog syntaxen. Jag förstår
                oftast vad koden gör och har en tydlig bild av vad jag vill
                åstadkomma, men att skriva den själv är en annan historia.
                Ibland ska det vara dollartecken, ibland inte.
                Citationstecken, parenteser och semikolon ska hamna på rätt
                ställen, och till slut känns allt som en enda röra. Det är
                frustrerande när själva förståelsen finns där, men det ändå
                tar en evighet att få ner koden på pränt.
            </p>
            <p>
                Jag har också märkt att AI-stöd inte alltid gör inlärningen
                enklare. När fungerande lösningar ständigt ifrågasätts
                eller ersätts med andra alternativ blir det svårt att veta
                vad som faktiskt är rätt och vad som bara är ett annat sätt
                att lösa samma problem.
            </p>
            <p>
                PHP har alltså både positiva och negativa sidor för mig. Jag
                uppskattar möjligheterna att organisera och återanvända kod,
                men själva programmerandet har varit mer frustrerande än jag
                hade hoppats.
            </p>
        </details>
    </article>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>