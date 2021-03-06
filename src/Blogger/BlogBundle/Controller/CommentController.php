<?php
// src/Blogger/BlogBundle/Controller/CommentController.php
namespace Blogger\BlogBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Blogger\BlogBundle\Entity\Comment;
use Blogger\BlogBundle\Form\CommentType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Comment controller.
 */
class CommentController extends Controller
{
    public function newAction($blog_id)
    {
        $blog = $this->getBlog($blog_id);
        $comment = new Comment();
        $comment->setBlog($blog);
        $form   = $this->createForm(CommentType::class, $comment);
        //(new CommentType(), $comment);
        return $this->render('BloggerBlogBundle:Comment:form.html.twig', array( 'form' => $form->createView() ));
    }

    public function createAction(Request $request)
    {  
        $comment  = new Comment();
        $blog = $this->getBlog($request->get("blog_id"));
        $comment->setBlog($blog);
         $comment->setIp($request->getClientIp());
        $form  = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //Persistir la entidad comentario
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
            $link = $this->generateUrl('blogger_blog_blog_show', 
                    array(
                    'id' => $comment->getBlog()->getId()));

            return $this->redirect( $link . '#comment-' . $comment->getId());          
        }
        return $this->render('BloggerBlogBundle:Comment:create.html.twig', array(
            'comment' => $comment,
            'form'    => $form->createView()
        ));
    }

    public function approveAction($comment_id){
        $em = $this->getDoctrine()
                    ->getEntityManager();
        $comment = $em->getRepository('BloggerBlogBundle:Comment')->find($comment_id);
        if($comment->getApproved() == 0){
            $comment->setApproved(1);
        }
        $em->flush();
        return new Response();
    }
    
    protected function getBlog($blog_id)
    {
        $em = $this->getDoctrine()
                    ->getManager();
        $blog = $em->getRepository('BloggerBlogBundle:Blog')->find($blog_id);
        if (!$blog) {
            throw $this->createNotFoundException('Unable to find Blog post.');
        }
        return $blog;
    } 
}