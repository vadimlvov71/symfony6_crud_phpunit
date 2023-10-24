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
    }

    public function testNew(): int
    {
        $this->client->request(
            'POST',
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
        );
        $response = $this->client->getResponse();
        $json_array = json_decode($response->getContent(),true);
        $id = $json_array[1];
         //asserts:
        $this->assertResponseStatusCodeSame(200);
        $this->assertContains('validate_success', $json_array);
        $this->assertContains('insert_success', $json_array);
        //varable passed the other methods
        return $id;
    }
   
    /**
     * @depends testNew
     */
    public function testShow($id): void
    {

        $this->client->request('GET', sprintf('%s%s', $this->path, $id));
        $response = $this->client->getResponse();
        $json_array = json_decode($response->getContent(),true);

        //asserts:
        $this->assertResponseStatusCodeSame(200);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertTrue($response->headers->contains('Content-Type', 'application/json'));
        $this->assertArrayHasKey('name', $json_array);

    }
    /**
     * @depends testNew
     */
    public function testEdit($id): void
    {
        $this->id = 1;
        $this->client->request(
            'POST',
            //"" ,
            $this->path. $id."/edit",
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
        $json_array = json_decode($response->getContent(),true);

        //asserts:
        $this->assertTrue($response->headers->contains('Content-Type', 'application/json'));
        $this->assertContains('validate_success', $json_array);
        $this->assertContains('update_success', $json_array);       
    }
    /**
     * @depends testNew
     */
    /*
    public function testDelete($id): void
    {
        $this->client->request('POST', sprintf('%s%s', $this->path."delete/", $id));
        $response = $this->client->getResponse();
        $json_array = json_decode($response->getContent(),true);
        
        //asserts:
        $this->assertResponseStatusCodeSame(200);
        $this->assertContains('delete_success', $json_array);
    }
    */
}
