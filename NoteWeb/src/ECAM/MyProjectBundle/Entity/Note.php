<?php

/**
 * Created by PhpStorm.
 * User: Louis
 * Date: 25-03-17
 * Time: 22:48
 */
namespace ECAM\MyProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;

use Symfony\Component\Serializer\Serializer;


/**
 * Note
 *
 * @ORM\Table(name="note")
 * @ORM\Entity(repositoryClass="ECAM\MyProjectBundle\Repository\NoteRepository")
 */
class Note
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
     * @Assert\NotBlank()
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var \DateTime
     *
     * @Assert\DateTime()
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @ORM\Column(name="contenu", type="text")
     */
    private $contenu;

    /**
     * @var categorie
     *
     * @Assert\NotNull()
     * @ORM\ManyToOne(targetEntity="Categorie", inversedBy="notes")
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
     * Constructor
     */
    public function __construct()
    {
        $this->date = new \DateTime();
    }


    /**
     * @Assert\IsTrue(message="Contenu is not valid xml")
     */
    public function isValid()
    {
        $dom = new \DOMDocument();
        try {
            $dom->loadXML($this->getXMLContent());
            $dom->schemaValidateSource($this->getXMLSchema());
        } catch (\ErrorException $e) {
            return false;
        }

        return true;
    }




    /**
     * Get the xml schema.
     *
     * @return string
     */
    private function getXMLSchema()
    {
        return
            <<<EOT
            <?xml version="1.0" encoding="UTF-8" ?>
                <xs:schema xmlns:xs="http://www.w3.org/2001/XMLSchema">
                <xs:element name="note">
                  <xs:complexType mixed="true">
                    <xs:sequence>
                      <xs:element name="tag" type="xs:string" minOccurs="0" maxOccurs="unbounded" />
                    </xs:sequence>
                  </xs:complexType>
                </xs:element>
                </xs:schema>
EOT;
    }

    /**
     * Return an array representing this object.
     *
     * @return array
     */
    public function toArray() {
        return array(
            'id' => $this->getId(),
            'titre' => $this->getTitre(),
            'date' => $this->getDate()->format('Y-m-d'),
            'contenu' => $this->getContenu(),
            'categorie' => $this->getCategorie()->toArray(),
        );
    }










    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Note
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Note
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
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Note
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }


    /**
     * @return string
     */
    public function getXMLContent()
    {
        return
            '<?xml version="1.0" encoding="UTF-8" ?>' .
            '<note>' . $this->getContenu() . '</note>';
    }






    /**
     * Set categorie
     *
     * @param \ECAM\MyProjectBundle\Entity\Categorie $categorie
     *
     * @return Note
     */
    public function setCategorie(\ECAM\MyProjectBundle\Entity\Categorie $categorie )
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
