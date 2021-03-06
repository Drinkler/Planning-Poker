<?php


namespace PlanningPoker\Library;


class Github
{
    private $username;
    private $repository;

    /**
     * Github constructor.
     * @param $url
     */
    public function __construct($url)
    {
        $url = $url.explode("/", $url);
        $this->username = $url[2];
        $this->repository = $url[3];
    }

    public function fetchIssues() {
        $issues = array();

        /**
         * https://developer.github.com/v3/issues/#list-repository-issues
         *
         * Needs to be a public Repository.
         * Username and Repository name must be given.
         */
        $curl = curl_init("https://api.github.com/repos/". $this->getUsername() ."/". $this->getRepository() ."/issues");

        /**
         * https://developer.github.com/v3/#user-agent-required
         *
         * All API requests MUST include a valid User-Agent header. Requests with no User-Agent header will be rejected.
         * Github wants you to use the Project name or your Username. So they can reach you if there are any problems.
         */
        curl_setopt($curl, CURLOPT_USERAGENT, 'User-Agent: Planning-Poker');

        // To return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);

        $response = curl_exec($curl);
        $response = json_decode($response);

        foreach ($response as $issue) {
            array_push($issues, new Issue($issue->title, $issue->body));
        }

        // Reverse is used because the github api gives the newest issues first. Now it starts with the oldest.
        return array_reverse($issues);
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * @param mixed $repository
     */
    public function setRepository($repository): void
    {
        $this->repository = $repository;
    }




}