<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\Article;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CommentFixture extends BaseFixtures implements DependentFixtureInterface
{
//    public function load(ObjectManager $manager)
//    {
//        // $product = new Product();
//        // $manager->persist($product);
//
//        $manager->flush();
//    }

    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(100, 'comment_main', function($i){
            $comment = new Comment();
            $comment->setContent(
                $this->faker->boolean ? $this->faker->paragraph : $this->faker->sentences(2, true)
            );
            $comment->setAuthorName($this->faker->name);
            $comment->setCreatedAt($this->faker->dateTimeBetween('-1 months', '-1 seconds'));
            $comment->setIsDeleted($this->faker->boolean(20));
            $comment->setArticle($this->getRandomReference('article_main'));
            return $comment;
        });
        $manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    public function getDependencies()
    {
        // TODO: Implement getDependencies() method.
        return [ArticleFixtures::class];
    }
}
