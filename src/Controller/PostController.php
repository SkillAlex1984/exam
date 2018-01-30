<?php
/**
 * Created by PhpStorm.
 * User: MY
 * Date: 28.01.2018
 * Time: 10:29
 */

namespace App\Controller;

use App\Entity\Post;
use App\Form\CommentType;
use App\Form\PostType;
use App\Entity\Coment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Tests\Fixtures\DescriptorCommand1;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
class PostController extends Controller
{
     /**
     * @Route("/", name="show_post")
     */
    public function defaultPage ()
    {
        $repo = $this->getDoctrine()->getRepository(Post::class);
        $posts = $repo->findBy([], ['dataPost' => 'DESC'], 3);
        return $this->render('exam/homepage.html.twig', ['posts'=>$posts]);
    }


     /**
      *
      * @Route("/exam/post-page/{id}", name="post_page")
     */
    public function postPage (Post $post, Request $request, EntityManagerInterface $em, SessionInterface $session)
    {

        $comments =$post->getComents();
        $comm = new Coment();

        $form = $this->createForm(CommentType::class, $comm);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $post->addComents($comm);
            $em->persist($comm);
            $em->flush();
            $id = $post->getId();

            return $this->redirectToRoute('post_page', ['id' => $id]);
        }
        return $this->render('exam/postpage.html.twig', array(
            'form' => $form->createView(),
            'post' => $post,
            'comments' => $comments,
        ));
    }
    /**
     * @Route("/exam/add-post", name="add_post")
     */
    public function addPostPage(Request $request)
    {
        $post = new Post();

        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
            $id = $post->getId();
            return $this->redirectToRoute('show_post', ['id' => $id]);
        }
        return $this->render('exam/addpost.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    /**
     * @Route("/exam/edit-post/{id}", name = "edit_post")
     *
     * @ParamConverter("id", options={"mapping":{"id": "id"}})
     */
    public function editPostPage(Post $post, Request $request, EntityManagerInterface $em, SessionInterface $session)
    {
        $form = $this->postPage($post, $session);

        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $id = $post->getId();
            $em->persist($post);
            $em->flush();
            return $this->redirectToRoute('post_page', ['id'=>$id]);
        }
        return $this->render('exam/editpost.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("delete-post/{id}", name="del_post")
     */
    public function deletePost($id)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository(Post::class)->find($id);
        $id = $post->getId();
        $em->remove($post);
        $em->flush();
        return $this->redirectToRoute('show_post', ['post'=>$post]);
    }

}