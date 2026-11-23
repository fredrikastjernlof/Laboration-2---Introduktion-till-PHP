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
        $sql = "SELECT * FROM bucketlist 
        WHERE completed = 0 
        ORDER BY FIELD(priority, 'high', 'medium', 'low');";
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

        $sql = "INSERT INTO bucketlist (name, description, priority) VALUES (?, ?, ?)"; 
        $stmt = $this->db->prepare($sql); 
        $stmt->bind_param("sss", $name, $description, $priority);
        return $stmt->execute(); 

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
        $sql = "UPDATE bucketlist SET name = ?, description = ?, priority = ? WHERE id = ?"; 
        $stmt = $this->db->prepare($sql); 
        $stmt->bind_param("sssi", $name, $description, $priority, $id); 
        return $stmt->execute(); 
    }

    // Metod för att hämta ett specifikt bucketlist-objekt baserat på dess ID
    public function getBucketById(int $id): ?array
    {
        $sql = "SELECT * FROM bucketlist WHERE id = ?"; 
        $stmt = $this->db->prepare($sql); 
        $stmt->bind_param("i", $id); 
        $stmt->execute(); 
        $result = $stmt->get_result(); 
        return $result->fetch_assoc();
    }

    // Metod för att ta bort ett bucketlist-objekt baserat på dess ID
    public function deleteBucket(int $id): bool
    {
        $sql = "DELETE FROM bucketlist WHERE id = ?"; 
        $stmt = $this->db->prepare($sql); 
        $stmt->bind_param("i", $id); 
        return $stmt->execute(); 
    }

    // Metod för att markera ett bucketlist-objekt som genomfört
    public function updateBucketCompleted(int $id, bool $completed): bool
    {
        $sql = "UPDATE bucketlist SET completed = ? WHERE id = ?"; 
        $stmt = $this->db->prepare($sql); 
        $stmt->bind_param("ii", $completed, $id); 
        return $stmt->execute();
    }

    public function getCompletedBuckets(): array
    {
        $sql = "SELECT * FROM bucketlist WHERE completed = 1"; 
        $result = mysqli_query($this->db, $sql); 
        return mysqli_fetch_all($result, MYSQLI_ASSOC); 
    }


    // GETTER OCH SETTER FÖR KLASSENS EGENSKAPER
    public function setName(string $name): bool
    {
        if (trim($name) !== "" && mb_strlen($name) <= 64) { 
            $this->name = $name;
            return true;
        }
        return false;
    }

    public function setDescription(string $description): bool
    {
        if (trim($description) !== "" && mb_strlen($description) <= 255) { 
            $this->description = $description;
            return true;
        }
        return false;
    }

    public function setPriority(string $priority): bool
    {
        if (in_array($priority, ['low', 'medium', 'high'], true)) { 
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
