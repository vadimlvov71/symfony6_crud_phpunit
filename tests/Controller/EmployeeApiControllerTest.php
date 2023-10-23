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
    private string $path = '/employee/api/';
    private EntityManagerInterface $manager;
    private $id; 

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Employee::class);
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $fixture = new Employee();
        $fixture->setName('For test1');
        $fixture->setLastName('For test1');
        $fixture->setEmail('fortest@test.com');
        $fixture->setCurrentSalary('999');
        $fixture->setDateToBeHired(\DateTime::createFromFormat('Y-m-d', date('Y-m-d')));
        $fixture->setDataEntityCreated(date(('Y-m-d')));

        $this->manager->persist($fixture);
        $this->manager->flush();
        $this->id = $fixture->getId();
        echo "aaaaaaaaa___________".$this->id;
     
    }

    public function testNew(): void
    {
        
        $this->client->request(
            'POST',
            //"" ,
            $this->path . 'new',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{
                "employee[name]":"Fabien",
                "employee[lastName]":"Testing",
                "employee[email]":"testing@test.com",
                "employee[current_salary]":"100",
                "employee[date_to_be_hired]":"'.date('Y-m-d').'"
                
            }'
            //"employee[date_to_be_hired]":"2023-10-21"
        );
        $response = $this->client->getResponse();
        $json_array = json_decode($response->getContent(),true);

        $this->assertResponseStatusCodeSame(200);
        $this->assertContains('validate_success', $json_array);
        $this->assertContains('insert_success', $json_array);
    }
   

    public function testShow(): void
    {

        $this->client->request('GET', sprintf('%s%s', $this->path, $this->id));
        
        self::assertResponseStatusCodeSame(200);
        $response = $this->client->getResponse();
        
        $json_array = json_decode($response->getContent(),true);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertTrue($response->headers->contains('Content-Type', 'application/json'));
        $this->assertArrayHasKey('name', $json_array);

    }
/*
    public function testEdit(): void
    {
        $this->client->request(
            'POST',
            //"" ,
            $this->path. $this->id."/edit",
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{
                "employee[name]":"FabienBBBB",
                "employee[lastName]":"Testing",
                "employee[email]":"testing@test.com",
                "employee[current_salary]":"100",
                "employee[date_to_be_hired]":"'.date('Y-m-d').'"
                
            }'
        );
        $response = $this->client->getResponse();

        $this->assertTrue($response->headers->contains('Content-Type', 'application/json'));
        $json_array = json_decode($response->getContent(),true);
        $this->assertContains('validate_success', $json_array);
        $this->assertContains('update_success', $json_array);       
    }
/*
    public function testDelete(): void
    {
        $this->client->request('POST', sprintf('%s%s', $this->path."delete/", $this->id));
        
        self::assertResponseStatusCodeSame(200);
        $response = $this->client->getResponse();
        
        $json_array = json_decode($response->getContent(),true);
        $this->assertContains('delete_success', $json_array);
    }
    */
}
