<?php

namespace src\Models\UserModel;

use DateTime;
use Exception;
use src\Structure\AbstractModel\AbstractModel;

class UserModel extends AbstractModel
{
    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->result['id'];
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->result['username'];
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->result['firstname'];
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return  $this->result['lastname'];
    }

    /**
     * @return string
     */
    public function getRegMail(): string
    {
        return $this->result['email'];
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->result['active'];
    }

    /**
     * @return int
     */
    public function getDev(): int
    {
        return $this->result['dev'];
    }

    /**
     * @return DateTime
     * @throws Exception
     */
    public function getCreateTime(): DateTime
    {
        return new DateTime($this->result['create_time']);
    }
}
