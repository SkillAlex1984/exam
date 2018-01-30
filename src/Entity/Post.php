<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 * @ORM\Table(name="post")
 */
class Post
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
    private $dataPost;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=250)
     */
    private $heading;
    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $textPost;

    /**
     * @var Coment[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Coment", mappedBy="post")
     * @ORM\OrderBy({"dataComent" = "DESC"})
     * @ORM\JoinColumn(name="post_id", onDelete="CASCADE")
     *
     */
    private $coments;



    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @param mixed $id
     * @return Post
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    /**
     * @return \DateTime
     */
    public function getDataPost(): ? \DateTime
    {
        return $this->dataPost;
    }
    /**
     * @param \DateTime $dataPost
     * @return Post
     */
    public function setDataPost(\DateTime $dataPost): Post
    {
        $this->dataPost = $dataPost;
        return $this;
    }
    /**
     * @return string
     */
    public function getHeading(): ? string
    {
        return $this->heading;
    }
    /**
     * @param string $heading
     * @return Post
     */
    public function setHeading(string $heading): Post
    {
        $this->heading = $heading;
        return $this;
    }
    /**
     * @return string
     */
    public function getTextPost(): ? string
    {
        return $this->textPost;
    }
    /**
     * @param string $textPost
     * @return Post
     */
    public function setTextPost(string $textPost): Post
    {
        $this->textPost = $textPost;
        return $this;
    }

    public function getParagraph(Post $post)
    {
        $patern="#<[\s]*p[\s]*>([^<]*)<[\s]*/p[\s]*>#i";
        $text = $post->getTextPost();
        if(preg_match($patern, $text, $matches)) {
            return  $matches[1];
        }
    }



    public function __construct()
    {
        $this->coments = new ArrayCollection();
        $this->dataPost = new \DateTime();
    }

    /**
     *@return Coment[]|ArrayCollection
     */
    public function getComents(): Collection
    {
        return $this->coments;
    }

    /**
     * @param mixed $coments
     * @return Post
     */
    public function addComents(Coment $coment)
    {
        $this->coments->add($coment);
        $coment->setPost($this);

        return $this;
    }




}
