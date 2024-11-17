<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use App\Entity\Customer;
use App\Entity\Model;
use App\Entity\Option;
use App\Entity\Reservation;
use App\Entity\State;
use App\Entity\Type;
use App\Entity\Vehicle;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasherInterface) {
        $this->hasher = $userPasswordHasherInterface;
    }

    public function load(ObjectManager $manager): void
    {
        /*************************************************************************************************
         * Fixtures of customers
         *************************************************************************************************/

        $customer1 = new Customer();
        $customer1->setAddress("rue Frayssinous");
        $customer1->setCity("Rodez");
        $customer1->setDrivingLicense("Permis B");
        $customer1->setEmail("lucmeyer@gmail.com");
        $customer1->setFirstName("Luc");
        $customer1->setLastName("Meyer");
        $customer1->setPhone("06 23 87 30 21");
        $customer1->setPostCode("12000");
        $customer1->setRole("CLIENT");
        $password = $this->hasher->hashPassword($customer1, 'password');
        $customer1->setPassword($password);

        $customer2 = new Customer();
        $customer2->setAddress("4 Rue Winston Churchill");
        $customer2->setCity("Metz");
        $customer2->setDrivingLicense("Permis BE");
        $customer2->setEmail("client@client.com");
        $customer2->setFirstName("Arnold");
        $customer2->setLastName("Günter");
        $customer2->setPhone("07 45 98 65 37");
        $customer2->setPostCode("57000");
        $customer2->setRole("CLIENT");
        $password = $this->hasher->hashPassword($customer2, 'password');
        $customer2->setPassword($password);

        $customer3 = new Customer();
        $customer3->setAddress("Courtines du Bastion, 32 Rue des Chantiers de France");
        $customer3->setCity("Dunkerque");
        $customer3->setDrivingLicense("Permis B");
        $customer3->setEmail("admin@admin.com");
        $customer3->setFirstName("Renold");
        $customer3->setLastName("Diraudt");
        $customer3->setPhone("07 45 98 65 37");
        $customer3->setPostCode("59140");
        $customer3->setRole("ADMIN");
        $password = $this->hasher->hashPassword($customer3, 'password');
        $customer3->setPassword($password);

        /*************************************************************************************************
         * Fixtures of State
         *************************************************************************************************/

        $state1 = new State();
        $state1->setStatus("Terminée");

        $state2 = new State();
        $state2->setStatus("En cours");
        
        $state3 = new State();
        $state3->setStatus("En attente");

        /*************************************************************************************************
         * Fixtures of Brand
         *************************************************************************************************/

        $brand1 = new Brand();
        $brand1->setName("Peugeot");

        $brand2 = new Brand();
        $brand2->setName("Toyota");

        $brand3 = new Brand();
        $brand3->setName("Renault");

        /*************************************************************************************************
         * Fixtures of Model
         *************************************************************************************************/

        $model1 = new Model();
        $model1->setName("208");
        $model1->setBrand($brand1);

        $model2 = new Model();
        $model2->setName("Yaris");
        $model2->setBrand($brand2);

        $model3 = new Model();
        $model3->setName("Espace");
        $model3->setBrand($brand3);

        /*************************************************************************************************
         * Fixtures of Option
         *************************************************************************************************/

        $option1 = new Option();
        $option1->setName("ABS");

        $option2 = new Option();
        $option2->setName("Sièges chauffants");

        $option3 = new Option();
        $option3->setName("Bluetooth");

        /*************************************************************************************************
         * Fixtures of Type
         *************************************************************************************************/

        $type1 = new Type();
        $type1->setName("SUV");

        $type2 = new Type();
        $type2->setName("Citadine");
        
        $type3 = new Type();
        $type3->setName("Sportive");

        /*************************************************************************************************
         * Fixtures of Vehicle
         *************************************************************************************************/

        $vehicle1 = new Vehicle();
        $vehicle1->setCapacity(5);
        $vehicle1->setModel($model1);
        $vehicle1->setNumberKilometers(30000);
        $vehicle1->setNumberPlate("GG-666-XD");
        $vehicle1->setPicturePath("/image/vehicle3.jpg");
        $vehicle1->setPrice(50);
        $vehicle1->setType($type1);
        $vehicle1->setYearOfVehicle(2024);

        $vehicle2 = new Vehicle();
        $vehicle2->setCapacity(5);
        $vehicle2->setModel($model2);
        $vehicle2->setNumberKilometers(120000);
        $vehicle2->setNumberPlate("DG-727-FR");
        $vehicle2->setPicturePath("/image/vehicle2.jpg");
        $vehicle2->setPrice(35);
        $vehicle2->setType($type2);
        $vehicle2->setYearOfVehicle(2015);

        $vehicle3 = new Vehicle();
        $vehicle3->setCapacity(7);
        $vehicle3->setModel($model3);
        $vehicle3->setNumberKilometers(150500);
        $vehicle3->setNumberPlate("AH-053-BH");
        $vehicle3->setPicturePath("/image/vehicle1.jpg");
        $vehicle3->setPrice(60);
        $vehicle3->setType($type3);
        $vehicle3->setYearOfVehicle(2010);

        /*************************************************************************************************
         * Fixtures of Reservatation
         *************************************************************************************************/

        $reservation1 = new Reservation();
        $reservation1->setCustomer($customer1);
        $reservation1->setDateEnd(new \DateTime("2024-01-01"));
        $reservation1->setDateStart(new \DateTime("2024-02-01"));
        $reservation1->setNumberRentalDay(31);
        $reservation1->setState($state1);
        $reservation1->setTotalCost(100);
        $reservation1->setVehicle($vehicle1);

        $reservation2 = new Reservation();
        $reservation2->setCustomer($customer2);
        $reservation2->setDateEnd(new \DateTime("2024-04-01"));
        $reservation2->setDateStart(new \DateTime("2024-04-15"));
        $reservation2->setNumberRentalDay(15);
        $reservation2->setState($state1);
        $reservation2->setTotalCost(150);
        $reservation2->setVehicle($vehicle2);

        $reservation3 = new Reservation();
        $reservation3->setCustomer($customer3);
        $reservation3->setDateEnd(new \DateTime("2024-11-04"));
        $reservation3->setDateStart(new \DateTime("2024-12-06"));
        $reservation3->setNumberRentalDay(32);
        $reservation3->setState($state2);
        $reservation3->setTotalCost(200);
        $reservation3->setVehicle($vehicle3);

        /*************************************************************************************************
         * Fixtures of relations
         *************************************************************************************************/

        // ADDS of options
        $option1->addVehicle($vehicle1);
        $option1->addVehicle($vehicle2);
        $option1->addVehicle($vehicle3);

        $option2->addVehicle($vehicle1);
        $option2->addVehicle($vehicle2);
        
        $option3->addVehicle($vehicle2);

        // ADDS of vehicles 
        $vehicle1->addReservation($reservation1);
        $vehicle2->addReservation($reservation2);
        $vehicle3->addReservation($reservation3);

        $vehicle1->addOption($option1);
        $vehicle1->addOption($option2);

        $vehicle2->addOption($option1);
        $vehicle2->addOption($option2);
        $vehicle2->addOption($option3);

        $vehicle3->addOption($option1);

        // ADDS of brands
        $brand1->addModel($model1);
        $brand2->addModel($model2);
        $brand3->addModel($model3);

        // ADDS of models
        $model1->addVehicle($vehicle1);
        $model2->addVehicle($vehicle2);
        $model3->addVehicle($vehicle3);

        // ADDS of customers 
        $customer1->addReservation($reservation1);
        $customer2->addReservation($reservation2);
        $customer3->addReservation($reservation3);

        // ADDS of states
        $state1->addReservation($reservation1);
        $state1->addReservation($reservation2);
        $state2->addReservation($reservation3);

        // ADDS of types
        $type1->addVehicle($vehicle1);
        $type2->addVehicle($vehicle2);
        $type3->addVehicle($vehicle3);

        /*************************************************************************************************
         * Persist Fixtures
         *************************************************************************************************/

        $manager->persist($customer1);
        $manager->persist($customer2);
        $manager->persist($customer3);

        $manager->persist($state1);
        $manager->persist($state2);
        $manager->persist($state3);

        $manager->persist($brand1);
        $manager->persist($brand2);
        $manager->persist($brand3);

        $manager->persist($model1);
        $manager->persist($model2);
        $manager->persist($model3);

        $manager->persist($option1);
        $manager->persist($option2);
        $manager->persist($option3);

        $manager->persist($type1);
        $manager->persist($type2);
        $manager->persist($type3);

        $manager->persist($vehicle1);
        $manager->persist($vehicle2);
        $manager->persist($vehicle3);

        $manager->persist($reservation1);
        $manager->persist($reservation2);
        $manager->persist($reservation3);        

        $manager->flush();
    }
}
