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
        $etabs = ['UPH','ITU','IESTIME','ISIME','HEI','IST','E-MEDIA','UPRIM','IS-INFO','ESTIIM','ISFPS', 'ONIFRA','ISPM','UCM','ACCEEM'];
        $provinces = ['Antananarivo','Toamasina','Antsiranana','Mahajanga','Toliara'];
        $filieres = ['Informatique', 'Gestion', 'Economie', 'BTP', 'Agronomie'];
        $parcours = [
            'Informatique'  => ['genie logiciel', 'administrateur système et réseau'],
            'Gestion' => ['comptable','marketing'],
            'BTP' => ['Genie civil'],
            'Economie' => ['economie'],
            'Agronomie' => ['Agro-alimentaire', 'Elevage']
        ];

        for ($i=0; $i < count($etabs); $i++) { 
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
                ->setProvince($provinces[rand(0 , count($provinces) - 1)])
                ->setEtablishment($etablishment);

            //create CONTACTS
            $contact = new Contacts();
            $contact->setPhone1('038 71 697 95')
                ->setEmail($etablishment->getName().'@gmail.com')
                ->setWebsite('https://'.$etablishment->getName().'.com')
                ->setEtablishment($etablishment);
            
            //create FORMATIONS
            $formation = new Formations();
    
            $formation->setAdmissionCondition('selection du dossier/concours')
                ->setEtablishment($etablishment);

            $formation_types = [];
            for ($v=0; $v < rand(1,3) ; $v++) { 
                $formation_types[] = $v;
            }

            $formation->setFormation_types(implode('/', $formation_types));

            $manager->persist($user);
            $manager->persist($etablishment);
            $manager->persist($adresse);
            $manager->persist($contact);
            $manager->persist($formation);
        }
        //create FILIERES
        for ($k=0; $k < count($filieres) ; $k++) { 
            $filiere = new Filieres();
            $filiere->setFiliere($filieres[$k]);
            $manager->persist($filiere);
        }


        $manager->flush();

        //creation DEPARTMENTS
        $formationRepo = $manager->getRepository(Formations::class);
        $filieresRepo = $manager->getRepository(Filieres::class);
        $fil_list = $filieresRepo->findAll();
        $formations = $formationRepo->findAll();
        foreach ($formations as $f) {
            $fil_index = rand(0, 4);
            $fil_index_lists = [$fil_index];

            for ($i=0; $i < rand(1,5); $i++) { 
                //create DEPARTMENTS
                while(in_array($fil_index, $fil_index_lists)){
                    $fil_index = rand(0,4);
                }

                array_push($fil_index_lists, $fil_index);

                $department = new Departments();
                $department->setDiplomaDelivered('0/1/2')
                    ->setDiplomaRequired('3/4/5')
                    ->setFormation($f)
                    ->setFiliere($fil_list[$fil_index]);
                
                //create PARCOURS
                $parcour_list = $parcours[$fil_list[$i]->getFiliere()];
                for ($k=0; $k < count($parcour_list); $k++) { 
                    $parcour = new Parcours();
                    $pr = $parcour_list[$k];
                    $parcour->setParcour($pr)
                        ->setDepartment($department);
                    $manager->persist($parcour);
                }
                $manager->persist($department);
            }
        }
        $manager->flush();
    }
}
