<?php

namespace App\DataFixtures;

use App\Entity\Adresses;
use App\Entity\Contacts;
use App\Entity\Departments;
use App\Entity\Etablishments;
use App\Entity\Filieres;
use App\Entity\Formations;
use App\Entity\Parcours;
use App\Entity\Users;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $etabs = ['UPH','ITU','IESTIME','ISIME','HEI'];
        $provinces = ['Antananarivo','Toamasina','Antsiranana','Mahajanga','Toliara'];
        $filieres = ['Informatique', 'Gestion', 'Economie', 'BTP', 'Agronomie'];
        $parcours = [
            'Informatique'  => ['genie logiciel', 'administrateur système et réseau'],
            'Gestion' => ['comptable','marketing'],
            'BTP' => ['Genie civil'],
            'Economie' => [],
            'Agronomie' => ['Agro-alimentaire', 'Elevage']
        ];

        for ($i=0; $i < 5; $i++) { 
            $j = $i + 1;
            //create USERS
            $user = new Users();
            $user->setEmail('etablishment'.$j.'@gmail.com')
                ->setPassword('etablishment'.$j);

            //create ETABLISHMENTS
            $etablishment = new Etablishments();
            $etablishment->setName($etabs[$i])
            ->setLogo('logo/'.$etabs[$i].'.png')
                    ->setSlogan('lorem ipsum test')
                    ->setAbout('
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Repellat cum voluptatum omnis inventore ex accusamus quibusdam quidem in eum dicta expedita qui nostrum, itaque dolore praesentium optio incidunt, ipsa perspiciatis.
                    ')
                    ->setUser($user);
    
            //create ADRESSES
            $adresse = new Adresses();
            $adresse->setAdress('adresse '.$etablishment->getName())
                ->setProvince($provinces[$i])
                ->setEtablishment($etablishment);

            //create CONTACTS
            $contact = new Contacts();
            $contact->setPhone1('038 71 697 95')
                ->setEmail($etablishment->getName().'@gmail.com')
                ->setWebsite('https://'.$etablishment->getName().'.com')
                ->setEtablishment($etablishment);
            
            //create FORMATIONS
            $formation = new Formations();
            $formation->setTypeFormation('enligne/presentiel')
                ->setAdmissionCondition('selection du dossier/concours')
                ->setEtablishment($etablishment);

            //create FILIERES
            $filiere = new Filieres();
            $filiere->setFiliere($filieres[$i]);

            //create DEPARTMENTS
            $department = new Departments();
            $department->setDiplomaDelivered('dts/licences/master')
                ->setDiplomaRequired('Bacc S/Bacc OSE/Bacc Technique')
                ->setFormation($formation)
                ->setFiliere($filiere);
            
            //create PARCOURS
            $parcour_list = $parcours[$filieres[$i]];
            for ($k=0; $k < count($parcour_list); $k++) { 
                $parcour = new Parcours();
                $pr = $parcour_list[$k];
                if(empty($parcour_list)){
                    $pr = $filieres($i);
                }
                $parcour->setParcour($pr)
                    ->setDepartment($department);
                $manager->persist($parcour);
            }

            $manager->persist($user);
            $manager->persist($etablishment);
            $manager->persist($adresse);
            $manager->persist($contact);
            $manager->persist($formation);
            $manager->persist($filiere);
            $manager->persist($department);
        }
        $manager->flush();
    }
}
