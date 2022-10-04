<?php

namespace App\DataFixtures;
use App\Entity\Libro;
use App\Entity\Editorial;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LibroFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i=0; $i<30; $i++){
            $libro=new Libro();
            $editorial=new Editorial();
            
            $editorial->getId();
            $libro->setTitulo("Libro prueba - $i");
            $libro->setAutor('Autor prueba ');
            $manager->persist($libro);
       
        }
            $manager->flush();
    }
}