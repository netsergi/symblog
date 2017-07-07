<?php
// src/Blogger/BlogBundle/Repository/BlogRepository.php

namespace Blogger\BlogBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * BlogRepository
 *
 * Esta clase fue generada por el ORM de Doctrine. Abajo añade
 * tu propia personalización a los métodos del repositorio.
 */
class BlogRepository extends EntityRepository
{

	public function getLatestBlogs($limit = null)
	    {
	        $qb = $this->createQueryBuilder('b')
	               ->select('b')
	               ->select('b', 'c')
	               ->select('b', 't')
	               ->select('b', 'a')
	               ->leftJoin('b.comments', 'c')
	               ->leftJoin('b.tagsCol','t')
	               ->leftjoin('b.author','a')
	               ->addOrderBy('b.created', 'DESC');

	        if (false === is_null($limit))
	            $qb->setMaxResults($limit);

	        return $qb->getQuery()
	                  ->getResult();
	    }
	
 }    