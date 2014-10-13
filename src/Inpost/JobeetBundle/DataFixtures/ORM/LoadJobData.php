<?php

namespace Inpost\JobeetBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Inpost\JobeetBundle\Entity\Job;
use Faker;

class LoadJobData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $faker = Faker\Factory::create();
        $job_time = array('full-time', 'part-time');
        $category = array('category-design', 'category-programming', 'category-manager', 'category-administrator');

        for($i=0; $i<10; $i++) {
            $job = new Job();
            $job->setCategory($em->merge($this->getReference($category[$i%4])));
            $job->setType($job_time[$i%2]);
            $job->setCompany($faker->company);
            $job->setLogo($faker->imageUrl(50,50));
            $job->setUrl($faker->url);
            $job->setPosition('Web Developer');
            $job->setLocation($faker->city.', '. $faker->state);
            $job->setDescription($faker->text(200));
            $job->setHowToApply('Send your resume to fabien.potencier [at] sensio.com');
            $job->setIsPublic(true);
            $job->setIsActivated(true);
            $job->setToken($faker->unique()->word);
            $job->setEmail($faker->email);
            $job->setExpiresAt($faker->dateTime());
            $em->persist($job);
        }

        $job_extreme_sensio = new Job();
        $job_extreme_sensio->setCategory($em->merge($this->getReference('category-design')));
        $job_extreme_sensio->setType('part-time');
        $job_extreme_sensio->setCompany('Extreme Sensio');
        $job_extreme_sensio->setLogo('extreme-sensio.gif');
        $job_extreme_sensio->setUrl('http://www.extreme-sensio.com/');
        $job_extreme_sensio->setPosition('Web Designer');
        $job_extreme_sensio->setLocation('Paris, France');
        $job_extreme_sensio->setDescription('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in.');
        $job_extreme_sensio->setHowToApply('Send your resume to fabien.potencier [at] sensio.com');
        $job_extreme_sensio->setIsPublic(true);
        $job_extreme_sensio->setIsActivated(true);
        $job_extreme_sensio->setToken('job_extreme_sensio');
        $job_extreme_sensio->setEmail('job@example.com');
        $job_extreme_sensio->setExpiresAt(new \DateTime('2012-10-10'));


        $em->persist($job_extreme_sensio);

        $em->flush();
    }

    public function getOrder()
    {
        return 2; // the order in which fixtures will be loaded
    }
}