<?php

namespace Dbogdanoff\Bitbucket;

use Exception;

class PullRequest extends Base
{
    /** @var array */
    protected $pullRequest = [];

    /**
     * @throws Exception
     */
    public function __construct()
    {
        if (strpos($_SERVER['HTTP_X_EVENT_KEY'], 'pullrequest:') === false) {
            throw new Exception('Invalid request type');
        }

        parent::__construct();

        if (array_key_exists('pullrequest', $this->rawData)) {
            $this->pullRequest = $this->rawData['pullrequest'];
        }
    }

    public function getPullRequest(): array
    {
        return $this->pullRequest;
    }

    public function getLinks(): array
    {
        return $this->pullRequest['links'];
    }

    public function getLink(): string
    {
        return $this->pullRequest['links']['html']['href'];
    }

    public function getTitle(): string
    {
        return $this->pullRequest['title'] ?: '';
    }

    public function getAuthor(): array
    {
        return $this->getPullRequest()['author'];
    }
}
