<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Form\EmployeeType;
use App\Repository\EmployeeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Annotations as OA;
use App\Service\Validation;

#[Route('/employee/api')]
class EmployeeApiController extends AbstractController
{
    
    
    
    
    /**
     * List the rewards of the specified user.
     *
     * This call takes into account all confirmed awards, but not pending or refused awards.
     *

     * @OA\Response(
     *     response=200,
     *     description="Returns the result of a new employee insertion",
     *     @OA\JsonContent(
     *        type="array",
     *        @OA\Items(ref=@Model(type=Employee::class, groups={"full"}))
     *     )
     * )
     *@OA\Response(
    *     response=200,
    *     description="Json Employee data",
    *     @OA\JsonContent(@OA\Schema(
    *        type="object",
    *        example={"validate_success","insert_success"}
    *     ))
    * )
    */

    #[Route('/new', name: 'app_employee_api_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, validatorInterface $validator): Response
    {
        
        $constraints = Validation::getConstrains();
        $response = [];
        $responseItem = [];

        $postData = $request->toArray();

        $postData['employee[current_salary]'] = (int)$postData['employee[current_salary]'];
        $postData['employee[date_to_be_hired]'] =  \DateTime::createFromFormat('Y-m-d', $postData['employee[date_to_be_hired]']);
        
        $validationResult = $validator->validate($postData, $constraints); 
      
        if (count($validationResult) > 0) {
            foreach ($validationResult as $result) {
                $responseItem[$result->getPropertyPath()] = $result->getMessage();
            }  
            $response['validate_error'] = $responseItem;
        } else {
            $response[] = "validate_success";
            try {
                $employee = new Employee();
                $employee->setName($postData['employee[name]']);
                $employee->setLastName($postData['employee[lastName]']);
                $employee->setEmail($postData['employee[email]']);
                $employee->setCurrentSalary($postData['employee[current_salary]']);
                $employee->setDateToBeHired($postData['employee[date_to_be_hired]']);
                $employee->setDataEntityCreated(date(('Y-m-d')));
                $entityManager->persist($employee);
                $entityManager->flush();
                $response[] = $employee->getId();
                $response[] = "insert_success";
            } catch (\Exception $e) {
                $response['insert_errror'] = $e->getMessage();
            }
        }
        return $this->json($response);
    }
   
    #[Route('/{id}', name: 'app_employee_ip_show', methods: ['GET'])]
    public function show(Employee $employee): Response
    {
    
        return $this->json($employee);
    }

    
    #[Route('/{id}/edit', name: 'app_employee_ip_edit', methods: ['GET', 'PUT'])]
    public function edit(Request $request, Employee $employee, EntityManagerInterface $entityManager, validatorInterface $validator, EmployeeRepository $employeeRepository): Response
    {
        $constraints = Validation::getConstrains();
        $response = [];
        $responseItem = [];
        
        $postData = $request->toArray();
        $postData['employee[current_salary]'] = (int)$postData['employee[current_salary]'];
        $postData['employee[date_to_be_hired]'] =  \DateTime::createFromFormat('Y-m-d', $postData['employee[date_to_be_hired]']);
        
        $validationResult = $validator->validate($postData, $constraints); 
        
      
        if (count($validationResult) > 0) { 
            foreach ($validationResult as $result) {
                $responseItem[$result->getPropertyPath()] = $result->getMessage();
            }  
            $response['validate_error'] = $responseItem;
        } else {
            $response[] = "validate_success";
            try {
                $employee->setName($postData['employee[name]']);
                $employee->setLastName($postData['employee[lastName]']);
                $employee->setEmail($postData['employee[email]']);
                $employee->setCurrentSalary($postData['employee[current_salary]']);
                $employee->setDateToBeHired($postData['employee[date_to_be_hired]']);
                $employee->setDateEntityUpdated(date(('Y-m-d')));
                $entityManager->persist($employee);
                $entityManager->flush();
                $response[] = "update_success";
            } catch (\Exception $e) {
                $response['update_errror'] = $e->getMessage();
            }
        }
        return $this->json($response);
    }

    #[Route('/new_salary/{id}', name: 'app_employee_ip_new_salary', methods: ['GET', 'PATCH'])]
    public function newSalary(Request $request, Employee $employee, EntityManagerInterface $entityManager, validatorInterface $validator, EmployeeRepository $employeeRepository): Response
    {
        $condition = "current_salary";
        $constraints = Validation::getConstrains($condition);
        $response = [];
        $responseItem = [];
        
        $postData = $request->toArray();
        $postData['employee[current_salary]'] = (int)$postData['employee[current_salary]'];
                
        $validationResult = $validator->validate($postData, $constraints); 
        
      
        if (count($validationResult) > 0) { 
            foreach ($validationResult as $result) {
                $responseItem[$result->getPropertyPath()] = $result->getMessage();
            }  
            $response['validate_error'] = $responseItem;
        } else {
            
            $response[] = "validate_success";
            try {
                $employee->setCurrentSalary($postData['employee[current_salary]']);
                $entityManager->persist($employee);
                $entityManager->flush();
                $response[] = "salary_update_success";
            } catch (\Exception $e) {
                $response['salary_update_errror'] = $e->getMessage();
            }
        }
        return $this->json($response);
    }

    #[Route('/delete/{id}', name: 'app_employee_ip_delete', methods: ['DELETE'])]
    public function delete(Request $request, Employee $employee, EntityManagerInterface $entityManager): Response
    {
        $response = [];
        try {
            $entityManager->remove($employee);
            $entityManager->flush();
            $response[] = 'delete_success';
        } catch (\Exception $e) {
            $response['delete_errror'] = $e->getMessage();
        }

        return $this->json($response);
    }
}
