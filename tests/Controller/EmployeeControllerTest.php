<?php

namespace App\Test\Controller;

use App\Entity\Employee;
use App\Repository\EmployeeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use \DateTime;

class EmployeeControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EmployeeRepository $repository;
    private string $path = '/employee/';
    private EntityManagerInterface $manager;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Employee::class);
/*
       foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }
        */
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);
       
        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Employee index');
       
        // Use the $crawler to perform additional assertions e.g.
        //self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());
      
        $this->client->request('GET', sprintf('%snew', $this->path));
        self::assertResponseStatusCodeSame(200);
        //$this->markTestIncomplete();
        $this->client->submitForm('Save', [
            'employee[name]' => 'Testing',
            'employee[lastName]' => 'Testing',
            'employee[email]' => 'testing@test.com',
            'employee[current_salary]' => '100',
            'employee[date_to_be_hired]' => date('Y-m-d H:i:s'),
            'employee[data_entity_created]' => date('Y-m-d H:i:s'),
            'employee[date_entity_updated]' => date('Y-m-d H:i:s'),
        ]);
       // $employee = $this->repository->findAll();
       $employee = $this->repository->findOneBy([
        'id' => '1',
        ]);
        echo "___________________";
        //$employee = $this->repository->find(1);
        echo "___________________";
        var_dump($employee->getName());
        //var_dump($fixture);
        //self::assertSame('Testing', $fixture[0]->getName());
        /*
        $insertedEmployee = $this->manager->getRepository(Employee::class)->findOneBy([
            'name' => 'Test Employee',
        ]);
        self::assertNotNull($insertedEmployee);
        self::assertEquals('Test Employee', $insertedProduct->getName());
        self::assertEquals('440', $insertedProduct->getCurrentSalary());
        */

        self::assertResponseRedirects('/employee/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }
   

   /* public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Employee();
        $fixture->setName('My Title');
        $fixture->setLastName('My Title');
        $fixture->setEmail('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Employee');

        // Use assertions to check that the properties are properly displayed.
    }*/

    /*public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Employee();
        $fixture->setName('My Title');
        $fixture->setLastName('My Title');
        $fixture->setEmail('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'employee[name]' => 'Something New',
            'employee[lastName]' => 'Something New',
            'employee[email]' => 'Something New',
        ]);

        self::assertResponseRedirects('/employee/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getLastName());
        self::assertSame('Something New', $fixture[0]->getEmail());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Employee();
        $fixture->setName('My Title');
        $fixture->setLastName('My Title');
        $fixture->setEmail('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/employee/');
    }*/
}
