<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Users;
use App\Entity\Categories;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = Faker\Factory::create();

        $users= [];

        for($i = 0; $i < 50; $i++){
            $user = new Users();
            $user->setUsername($faker->name);
            $user->setFirstname($faker->firstname());
            $user->setLastname($faker->lastname());
            $user->setEmail($faker->email);
            $user->setPassword($faker->password);
            $user->setCreateAt(new \DateTime());
            $manager->persist($user); // Le manager va catch les informations que l'on a demandé a l'USER
            $users[] = $user;
            
        }

        $categories = [];

        for($i = 0; $i < 15; $i++){
            $category = new Categories();
            $category->setTitle($faker->text(50));
            $category->setDescription($faker->text(250));
            $category->setImage($faker->imageUrl());
            $manager->persist($category);
            $categories[] = $category;
            
        }

        for($i = 0; $i < 100; $i++){
            $article = new Article();
            $article->setName($faker->text(50));
            $article->setContent($faker->text(5000));
            $article->setImage($faker->imageUrl());
            $article->setCreatedAt(new \DateTime());
            $article->addCategory($categories[$faker->numberBetween(0,14)]);
            $article->setAuthor($users[$faker->numberBetween(0,49)]);
            $manager->persist($article);
            $categories[] = $article;
        }

        $manager->flush();// Le Flush permet d'insérer ces données en base de donndées.
    }
}
