<?php


namespace App\Infrastructure\Http;

use App\Domain\Entity\Question;
use App\Domain\Entity\ShallowUser;
use App\Domain\Repository\QuestionRepositoryInterface;
use DateTime;
use Exception;
use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Response;

class GuzzleQuestionHttpRepository implements QuestionRepositoryInterface
{

    public function findAll(): array|null
    {
        return [];
    }

    public function findBy($tagged, $fromdate = null, $todate = null): array|null
    {
        $client = new Client();

        if (isset($todate)) {
            if (!$this->isValidFormatDate($todate)) {
                throw new Exception(
                    'Error format field to date', Response::HTTP_BAD_REQUEST
                );
            } else {
                $todate = '&todate=' . strtotime($todate);
            }
        }
        if (isset($fromdate)) {
            if (!$this->isValidFormatDate($fromdate)) {
                throw new Exception(
                    'Error format field from date', Response::HTTP_BAD_REQUEST
                );
            } else {
                $fromdate = '&todate=' . strtotime($fromdate);
            }
        }

        $response = $client->request(
            'GET',
            $_ENV['URL_API'] . '2.3/questions?tagged=' . $tagged . $fromdate . $todate . '&site=stackoverflow'
        );
        $items = json_decode($response->getBody(), true)['items'];
        $questions = [];

        foreach ($items as $item) {
            $owner = new ShallowUser(
                isset($item['owner']['user_type']) ? $item['owner']['user_type'] : null,
                isset($item['owner']['profile_image']) ? $item['owner']['profile_image'] : null,
                isset($item['owner']['display_name']) ? $item['owner']['display_name'] : null,
                isset($item['owner']['link']) ? $item['owner']['link'] : null,
                isset($item['owner']['reputation']) ? $item['owner']['reputation'] : null,
                isset($item['owner']['user_id']) ? $item['owner']['user_id'] : null,
                isset($item['owner']['accept_rate']) ? $item['owner']['accept_rate'] : null,
            );

            $question = new Question(
                $item['tags'],
                isset($item['question_id']) ? $item['question_id'] : null,
                isset($item['is_answered']) ? $item['is_answered'] : null,
                isset($item['view_count']) ? $item['view_count'] : null,
                isset($item['favorite_count']) ? $item['favorite_count'] : null,
                isset($item['down_vote_count']) ? $item['down_vote_count'] : null,
                isset($item['up_vote_count']) ? $item['up_vote_count'] : null,
                isset($item['answer_count']) ? $item['answer_count'] : null,
                isset($item['score']) ? $item['score'] : null,
                isset($item['last_activity_date']) ? date_format(
                    (new DateTime)->setTimestamp($item['last_activity_date']),
                    'Y-m-d H:i:s'
                ) : null,
                isset($item['creation_date']) ? date_format(
                    (new DateTime)->setTimestamp($item['creation_date']),
                    'Y-m-d H:i:s'
                ) : null,
                isset($item['link']) ? $item['link'] : null,
                isset($item['title']) ? $item['title'] : null,
                isset($item['body']) ? $item['body'] : null,
                isset($item['last_edit_date']) ? date_format(
                    (new DateTime)->setTimestamp($item['last_edit_date']),
                    'Y-m-d H:i:s'
                ) : null,
                isset($item['owner']) ? $owner : null
            );

            $questions[] = $question->serializeToJson();
        }

        return $questions;
    }

    private function isValidFormatDate($date, $format = 'Y-m-d')
    {
        $dt = DateTime::createFromFormat($format, $date);
        return $dt && $dt->format($format) === $date;
    }
}