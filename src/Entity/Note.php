<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NoteRepository")
 */
class Note
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $note;

    /**
     * @ORM\Column(type="text")
     */
    private $avis;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_enregistrement;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Membre", cascade={"persist", "remove"})
     */
    private $membre_note_id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Membre", cascade={"persist", "remove"})
     */
    private $membre_notant_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getAvis(): ?string
    {
        return $this->avis;
    }

    public function setAvis(string $avis): self
    {
        $this->avis = $avis;

        return $this;
    }

    public function getDateEnregistrement(): ?\DateTimeInterface
    {
        return $this->date_enregistrement;
    }

    public function setDateEnregistrement(\DateTimeInterface $date_enregistrement): self
    {
        $this->date_enregistrement = $date_enregistrement;

        return $this;
    }

    public function getMembreNoteId(): ?Membre
    {
        return $this->membre_note_id;
    }

    public function setMembreNoteId(?Membre $membre_note_id): self
    {
        $this->membre_note_id = $membre_note_id;

        return $this;
    }

    public function getMembreNotantId(): ?Membre
    {
        return $this->membre_notant_id;
    }

    public function setMembreNotantId(?Membre $membre_notant_id): self
    {
        $this->membre_notant_id = $membre_notant_id;

        return $this;
    }
}
