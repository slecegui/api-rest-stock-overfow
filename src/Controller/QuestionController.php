<?php

namespace App\Controller;

use App\Application\Services\QuestionsByFiltersService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/questions')]
class QuestionController extends AbstractController
{
   #[Route('/getQuestionsByFilters', name: 'get_questions_by_filters', methods: ['GET'])]
    public function getQuestionsByFilters(Request $request, QuestionsByFiltersService $questionsByFiltersService): Response
    {
        if (!empty($request->get('tagged'))) try{
            return $this->json($questionsByFiltersService->findBy( $request->get('tagged'), $request->get('fromdate'), $request->get('todate')));
        }catch (Exception $e){
            return $this->json(['msn'=>$e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR );
        } else{
            return $this->json(['msn'=>'Bad Request, tagged required'], Response::HTTP_BAD_REQUEST);
        }
    }
}
