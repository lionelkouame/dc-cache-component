<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Blog\Post;

class PostFixtures extends Fixture
{
    public const POST_COUNT = 100000; // Changer le nombre de données ici

    public function load(ObjectManager $manager): void
    {
        $bacth =  0;
        for ($i = 0; $i < self::POST_COUNT; $i++) {
            $post = new Post;
            $post->setTitle('Title ' . $i);
            $post->setExtract('Extract ' . $i);
            $post->setContent('Content ' . $i);

            $bacth++;

            if ($bacth === 1000) {
                $manager->persist($post);
                $manager->flush();
                $manager->clear();
                $bacth = 0;
            }

        }

    }
}
