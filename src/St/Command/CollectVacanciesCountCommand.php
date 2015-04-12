<?php

namespace St\Command;

use St\Base\CommandAbstract;
use St\Parser\ParserInterface;

class CollectVacanciesCountCommand extends CommandAbstract
{
    /**
     * @var ParserInterface
     */
    private $parser;

    /**
     * @var string
     */
    private $resourceUrl;

    public function __construct($name, $resourceUrl)
    {
        parent::__construct($name);
        $this->resourceUrl = $resourceUrl;
    }

    /**
     * @return mixed
     */
    public function run()
    {
        $parsed = $this->parser->parse($this->resourceUrl);
        $foundResult = current($parsed->find('.resumesearch__result-count'));
        preg_match('/\d+/', $foundResult->innertext(), $matches);
        $countVacancies = $matches[0];

        $addRecord = 'insert into `vacancien_count` (`search_string`, `find_result`) values ("php", "' . $countVacancies . '")';
        // @todo внедрить PDO
        try {
            $dbc = new \PDO('mysql:host=localhost;dbname=st', 'root', 'root');
            $dbc->exec($addRecord);
        } catch (\PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function setParser(ParserInterface $parser)
    {
        $this->parser = $parser;
    }

}
