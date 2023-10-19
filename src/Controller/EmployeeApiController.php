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

#[Route('/employee/api')]
class EmployeeApiController extends AbstractController
{
    #[Route('/', name: 'app_employee_api_index', methods: ['GET'])]
    public function index(EmployeeRepository $employeeRepository): Response
    {
        $data = [];
        $employees = $employeeRepository->findAll();
        foreach ($employees as $product) {
           $data[] = [
               'id' => $product->getId(),
               'name' => $product->getName(),
           ];
        }
       // $parameters = json_decode($request->getContent(), true);
        //echo $parameters['name']; // will print 'user'
       // $data['a'] = $parameters['name'];
        return $this->json($data);
       /* return $this->render('employee/index.html.twig', [
            'employees' => $employeeRepository->findAll(),
        ]);*/
    }

    #[Route('/new', name: 'app_employee_api_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, validatorInterface $validator): Response
    {
        $constraints = new Assert\Collection([
            'employee[name]' => [
                new Assert\NotBlank()
            ],
            'employee[lastName]' => [
                new Assert\NotBlank()
            ],
            'employee[email]' => [
                new Assert\NotBlank(),
                new Assert\Email()
            ],
            'employee[current_salary]' => [
                new Assert\Type('int'),
                new Assert\GreaterThan(99)
            ],
            'employee[date_to_be_hired]' => [
                new Assert\DateTime(),
            ],
            'employee[data_entity_created]' => [
                new Assert\DateTime(),
            ],
            'employee[date_entity_updated]' => [
                new Assert\DateTime(),
            ],
        ]);
        $employee = new Employee();
        $response = [];
        $responseItem = [];

           // $entityManager->persist($employee);
           // $entityManager->flush();

        $postData = $request->toArray();
        //$test = $postData['test'];
        $name = $postData['employee[name]'];
        //$errors = $validator->validate($employee);
        $validationResult = $validator->validate($postData, $constraints); 
        if(count($validationResult) > 0){
            foreach($validationResult as $result){
                $responseItem[$result->getPropertyPath()] = $result->getMessage();
            }  
            $response['error'] = $responseItem;
        }
        $response['error1'] = $validationResult[1]->getPropertyPath();
        if (!isset($parameters['employee[name]'])){
            //$response['error'] = count($validationResult);
            //$response['error1'] = $validationResult[1];
           // return $this->json($data);
        }
        $response['test'] = $name;
        return $this->json($response);
    }

    #[Route('/{id}', name: 'app_employee_show', methods: ['GET'])]
    public function show(Employee $employee): Response
    {
        return $this->render('employee/show.html.twig', [
            'employee' => $employee,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_employee_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Employee $employee, EntityManagerInterface $entityManager, validatorInterface $validator): Response
    {
        $form = $this->createForm(EmployeeType::class, $employee);
        $form->handleRequest($request);
        $errors = $validator->validate($employee);
        /*if (count($errors) > 0) {
            /*
             * Использует метод __toString в переменной $errors, которая является объектом
             * ConstraintViolationList. Это дает хорошую строку для отладки.
             */
           // $errorsString = (string) $errors;
    
            //return new Response($errorsString);
        //}
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_employee_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('employee/edit.html.twig', [
            'employee' => $employee,
            'form' => $form,
            'errors' => $errors,
        ]);
    }

    #[Route('/{id}', name: 'app_employee_delete', methods: ['POST'])]
    public function delete(Request $request, Employee $employee, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$employee->getId(), $request->request->get('_token'))) {
            $entityManager->remove($employee);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_employee_index', [], Response::HTTP_SEE_OTHER);
    }
}
