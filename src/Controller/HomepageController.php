<?php

namespace App\Controller;

use App\Entity\Blog\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class HomepageController extends AbstractController
{

    #[Route('/homepage', name: 'app_homepage')]
    public function index(EntityManagerInterface $entityManager, CacheInterface $cache,): Response
    {
        $posts = $cache->get('homepage_posts', function (ItemInterface $item) use ($entityManager) {
            $item->expiresAfter(10);
            return $entityManager->getRepository(Post::class)->findAll();
        });

        return $this->render('homepage/index.html.twig', [
            'controller_name' => 'HomepageController',
            'posts' => $posts,
        ]);
    }
}
