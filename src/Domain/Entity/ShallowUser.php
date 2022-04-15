<?php


namespace App\Domain\Entity;

class ShallowUser
{
    private $reputation;
    private $user_id;
    private $user_type;
    private $accept_rate;
    private $profile_image;
    private $display_name;
    private $link;

    public function __construct(
        string $user_type,
        string $profile_image = null,
        string $display_name = null,
        string $link = null,
        int $reputation = null,
        int $user_id = null,
        int $accept_rate = null
    ) {
        $this->reputation = $reputation;
        $this->user_id = $user_id;
        $this->user_type = $user_type;
        $this->accept_rate = $accept_rate;
        $this->profile_image = $profile_image;
        $this->display_name = $display_name;
        $this->link = $link;
    }

    public function serializeToJson(): array
    {
        return [
            "reputation" => $this->reputation,
            "user_id" => $this->user_id,
            "user_type" => $this->user_type,
            "accept_rate" => $this->accept_rate,
            "profile_image" => $this->profile_image,
            "display_name" => $this->display_name,
            "link" => $this->link
        ];
    }

}