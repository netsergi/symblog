<?php 
namespace Blogger\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Blogger\BlogBundle\Entity\Blog;
use Blogger\BlogBundle\Entity\Comment;
use Symfony\Component\HttpFoundation\Request;


/**
 * Controlador del Blog.
 */
class BlogController extends Controller
{
    /**
     * Muestra una entrada del blog
     */
    public function showAction($id, $slug)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $blog = $em->getRepository('BloggerBlogBundle:Blog')->find($id);
        if (!$blog) {
            throw $this->createNotFoundException('Unable to find Blog post');
        }
        $comments = $em->getRepository('BloggerBlogBundle:Comment')
               ->getCommentsForBlog($blog->getId());
             
        return $this->render('BloggerBlogBundle:Blog:show.html.twig', array('blog' => $blog,'comments' => $comments));
    }

    public function createAction()
    {
        $em = $this->get('doctrine')->getManager();
        $blog = new Blog();
        $blog->setTitle("Begur, un lloc paradisiac");
        $blog->setAuthor("Sergi Navarro");
        $blog->setBlog(mysql_real_escape_string ('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut turpis tortor. Aliquam imperdiet id ante sit amet tincidunt. Mauris quis sem a mi finibus ullamcorper dapibus sed purus. Donec ut quam sapien. Sed augue massa, rutrum sed iaculis id, bibendum id est. Donec eu libero quis mi maximus condimentum. Nullam ac leo tincidunt, tristique purus non, mollis dolor. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Curabitur mollis libero, id lacinia nulla vulputate at. Fusce fringilla bibendum urna sed porta.'));
        // Crea un comentario y lo añade a nuestro blog
        $blog->setTags("Estiu a begur");
        $blog->setImage('Begur.jpg');
        $em->persist($blog);
        $em->flush();
        return $this->render('BloggerBlogBundle:Blog:create.html.twig', array('blog'=> $blog));
    }

     public function editAction(Request $request)
    {
        $id = $request->get('id');
        $em = $em = $this->getDoctrine()->getEntityManager();
        $blog = $em->getRepository('BloggerBlogBundle:Blog')->find($id);
        if (!$blog) {
            throw $this->createNotFoundException('No blog found for id');
        }
        $blog->setAuthor('Joan Manel');
        $em->persist($blog);
        $em->flush();
        return $this->render('BloggerBlogBundle:Blog:create.html.twig', array('blog'=> $blog,'msg'=>'Autor del post modificat!'));
    }





}