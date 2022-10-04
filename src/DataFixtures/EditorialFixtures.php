<?php

namespace App\DataFixtures;
use App\Entity\Editorial;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EditorialFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i=0; $i<30; $i++){
           
            $editorial=new Editorial(); 
            $editorial->getId();  
            $editorial->setNombre("Ed prueba -$i");
            $manager->persist($editorial);
       
        }

        $manager->flush();
    }
}
