<?php

namespace ECAM\MyProjectBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;

use Symfony\Component\Serializer\Serializer;


/**
 * Note
 *
 * @ORM\Table(name="note")
 * @ORM\Entity(repositoryClass="ECAM\MyProjectBundle\Repository\noteRepository")
 */
class note
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=255)
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;



    /**
     * @var categorie
     *
     * @Assert\NotNull()
     * @ORM\ManyToOne(targetEntity="categorie", inversedBy="note")
     */
    private $categorie;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return note
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return note
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return note
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * note constructor.
     */
    public function __construct()
    {
        $this->date         = new \Datetime();
    }


    /**
     * Set categorie
     *
     * @param \ECAM\MyProjectBundle\Entity\Categorie $categorie
     *
     * @return Note
     */
    public function setCategorie(\ECAM\MyProjectBundle\Entity\Categorie $categorie = null)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \ECAM\MyProjectBundle\Entity\Categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }
}
