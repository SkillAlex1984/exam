<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ComentRepository")
 */
class Coment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     *
     */
    private $dataComent;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=250)
     */
    private $nikname;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $textComent;

    /**
     * @var Post
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Post", inversedBy="coments")
     * @ORM\JoinColumn(name="post_id", nullable=true)
     */
    private $post;



    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Coment
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDataComent(): ? \DateTime
    {
        return $this->dataComent;
    }

    /**
     * @param \DateTime $dataComent
     * @return Coment
     */
    public function setDataComent(\DateTime $dataComent): Coment
    {
        $this->dataComent = $dataComent;
        return $this;
    }

    /**
     * @return string
     */
    public function getNikname(): ? string
    {
        return $this->nikname;
    }

    /**
     * @param string $nikname
     * @return Coment
     */
    public function setNikname(string $nikname): Coment
    {
        $this->nikname = $nikname;
        return $this;
    }

    /**
     * @return string
     */
    public function getTextComent(): ? string
    {
        return $this->textComent;
    }

    /**
     * @param string $textComent
     * @return Coment
     */
    public function setTextComent(string $textComent): Coment
    {
        $this->textComent = $textComent;
        return $this;
    }



    /**
     * @return mixed
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @return Post $post
     */
    public function setPost(Post $post): Coment
    {
        $this->post = $post;
        return $this;
    }

     /**
     /**
     * Comment constructor.
     */
    public function __construct(    )
    {
        $this->dataComent = new \DateTime();
    }



}
