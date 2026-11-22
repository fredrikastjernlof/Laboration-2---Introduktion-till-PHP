<?php

class BucketList
{
    private mysqli $db;
    private ?string $name = null;
    private ?string $description = null;
    private ?string $priority = null;
    private ?bool $completed = null;

    // Konstruktor som tar emot mysqli-anslutningen
    public function __construct(mysqli $db)
    {
        $this->db = $db;
    }

    //DATABASMETODER

    // Metod för att hämta bucketlistan från databasen
    public function getBucketList(): array
    {
        $sql = "SELECT * FROM bucketlist;";
        $result = mysqli_query($this->db, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // Metod för att lägga till ett nytt bucketlist-objekt
    public function addBucket(string $name, string $description, string $priority): bool
    {
        $validName = $this->setName($name);
        $validDescription = $this->setDescription($description);
        $validPriority = $this->setPriority($priority);

        if (!$validName || !$validDescription || !$validPriority) {
            return false;
        }

        $sql = "INSERT INTO bucketlist (name, description, priority) VALUES (?, ?, ?)"; // Använder prepared statements för att förhindra SQL-injektion
        $stmt = $this->db->prepare($sql); // Förbereder SQL-frågan
        $stmt->bind_param("sss", $name, $description, $priority); // "sss" betyder att alla tre parametrar är strängar
        return $stmt->execute(); // Returnerar true om insättningen lyckades, annars false

    }

    // Metod för att uppdatera ett befintligt bucketlist-objekt
    public function updateBucket(int $id, string $name, string $description, string $priority): bool
    {
        $validName = $this->setName($name);
        $validDescription = $this->setDescription($description);
        $validPriority = $this->setPriority($priority);

        if (!$validName || !$validDescription || !$validPriority) {
            return false;
        }
        $sql = "UPDATE bucketlist SET name = ?, description = ?, priority = ? WHERE id = ?"; // Använder prepared statements för att förhindra SQL-injektion
        $stmt = $this->db->prepare($sql); // Förbereder SQL-frågan
        $stmt->bind_param("sssi", $name, $description, $priority, $id); // "sssi" betyder att de tre första parametrarna är strängar och den sista är ett heltal
        return $stmt->execute(); // Returnerar true om uppdateringen lyckades, annars false
    }

    // Metod för att hämta ett specifikt bucketlist-objekt baserat på dess ID
    public function getBucketById(int $id): ?array
    {
        $sql = "SELECT * FROM bucketlist WHERE id = ?"; // Använder prepared statements för att förhindra SQL-injektion
        $stmt = $this->db->prepare($sql); // Förbereder SQL-frågan
        $stmt->bind_param("i", $id); // "i" betyder att parametern är ett heltal
        $stmt->execute(); // Kör SQL-frågan
        $result = $stmt->get_result(); // Hämtar resultatet
        return $result->fetch_assoc(); // Returnerar resultatet som en associativ array
    }

    // Metod för att ta bort ett bucketlist-objekt baserat på dess ID
    public function deleteBucket(int $id): bool
    {
        $sql = "DELETE FROM bucketlist WHERE id = ?"; // Använder prepared statements för att förhindra SQL-injektion
        $stmt = $this->db->prepare($sql); // Förbereder SQL-frågan
        $stmt->bind_param("i", $id); // "i" betyder att parametern är ett heltal
        return $stmt->execute(); // Returnerar true om borttagningen lyckades, annars false
    }

    // Metod för att markera ett bucketlist-objekt som genomfört
    public function updateBucketCompleted(int $id, bool $completed): bool
    {
        $this->setCompleted($completed); // Sätter completed-egenskapen
        $sql = "UPDATE bucketlist SET completed = ? WHERE id = ?"; // Använder prepared statements för att förhindra SQL-injektion
        $stmt = $this->db->prepare($sql); // Förbereder SQL-frågan
        $stmt->bind_param("ii", $completed, $id); // "ii" betyder att båda parametrarna är heltal
        return $stmt->execute(); // Returnerar true om uppdateringen lyckades, annars false
    }

    public function getCompletedBuckets(): array
    {
        $sql = "SELECT * FROM bucketlist WHERE completed = 1"; // Hämtar alla objekt som är markerade som genomförda
        $result = mysqli_query($this->db, $sql); // Kör SQL-frågan
        return mysqli_fetch_all($result, MYSQLI_ASSOC); // Returnerar resultatet som en associativ array
    }


    // GETTER OCH SETTER FÖR KLASSENS EGENSKAPER
    public function setName(string $name): bool
    {
        if (trim($name) !== "" && mb_strlen($name) <= 64) { // Kontrollerar att namnet inte är tomt och inte längre än 64 tecken
            $this->name = $name;
            return true;
        }
        return false;
    }

    public function setDescription(string $description): bool
    {
        if (trim($description) !== "" && mb_strlen($description) <= 255) { // Kontrollerar att beskrivningen inte är tom och inte längre än 255 tecken
            $this->description = $description;
            return true;
        }
        return false;
    }

    public function setPriority(string $priority): bool
    {
        if (in_array($priority, ['low', 'medium', 'high'], true)) { // Kontrollerar att prioriteten är en av de tillåtna värdena
            $this->priority = $priority;
            return true;
        }
        return false;
    }

    public function setCompleted(bool $completed): bool
    {
        $this->completed = $completed;
        return true;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getPriority(): ?string
    {
        return $this->priority;
    }

    public function getCompleted(): ?bool
    {
        return $this->completed;
    }
}
