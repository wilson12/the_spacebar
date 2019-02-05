<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Common\Persistence\ObjectManager;

class TagFixtures extends BaseFixtures
{

    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(10,'tag_main', function($i) {
            $tag = new Tag();
            $tag->setName($this->faker->realText(20));
            return $tag;
        });
        $manager->flush();
    }
}
