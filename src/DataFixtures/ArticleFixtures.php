<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('ru_RU');

        foreach (range(1, 10) as $_) {
            $article = new Article();
            $article->setTitle($faker->realText(100));
            $article->setBody($faker->realText(200));

            $manager->persist($article);
        }

        $manager->flush();
    }
}
