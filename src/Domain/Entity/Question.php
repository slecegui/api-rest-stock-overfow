<?php

namespace App\Domain\Entity;

final class Question
{

    private $tags;
    private $owner;
    private $is_answered;
    private $view_count;
    private $favorite_count;
    private $down_vote_count;
    private $up_vote_count;
    private $answer_count;
    private $score;
    private $last_activity_date;
    private $creation_date;
    private $last_edit_date;
    private $question_id;
    private $link;
    private $title;
    private $body;

    /**
     * Question constructor.
     * @param array $tags
     * @param int $question_id
     * @param bool $is_answered
     * @param int $view_count
     * @param int $favorite_count
     * @param int $down_vote_count
     * @param int $up_vote_count
     * @param int $answer_count
     * @param int $score
     * @param string $last_activity_date
     * @param string $creation_date
     * @param string $link
     * @param string $title
     * @param string $body
     * @param string $last_edit_date
     * @param ShallowUser|null $owner
     */
    public function __construct(
        array $tags,
        int $question_id = null,
        bool $is_answered = null,
        int $view_count = null,
        int $favorite_count = null,
        int $down_vote_count = null,
        int $up_vote_count = null,
        int $answer_count = null,
        int $score = null,
        string $last_activity_date = null,
        string $creation_date = null,
        string $link = null,
        string $title = null,
        string $body = null,
        string $last_edit_date = null,
        ShallowUser $owner = null
    ) {
        $this->tags = $tags;
        if (isset($owner)) {
            $this->owner = $owner;
        }
        $this->question_id = $question_id;
        $this->is_answered = $is_answered;
        $this->view_count = $view_count;
        $this->favorite_count = $favorite_count;
        $this->down_vote_count = $down_vote_count;
        $this->up_vote_count = $up_vote_count;
        $this->answer_count = $answer_count;
        $this->score = $score;
        $this->last_activity_date = $last_activity_date;
        $this->creation_date = $creation_date;
        $this->last_edit_date = $last_edit_date;
        $this->link = $link;
        $this->title = $title;
        $this->body = $body;
    }

    /**
     * @return array
     */
    public function serializeToJson(): array
    {
        return [
            "tags" => $this->tags,
            "owner" => isset($this->owner) ? $this->owner->serializeToJson() : null,
            "is_answered" => $this->is_answered,
            "view_count" => $this->view_count,
            "favorite_count" => $this->favorite_count,
            "down_vote_count" => $this->down_vote_count,
            "up_vote_count" => $this->up_vote_count,
            "answer_count" => $this->answer_count,
            "score" => $this->score,
            "last_activity_date" => $this->last_activity_date,
            "creation_date" => $this->creation_date,
            "last_edit_date" => $this->last_edit_date,
            "question_id" => $this->question_id,
            "link" => $this->link,
            "title" => $this->title,
            "body" => $this->body
        ];
    }

}