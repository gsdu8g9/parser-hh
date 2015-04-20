<?php

namespace St\Command;

/**
 * Класс хранящий в с себе параметры для получения команды для получения количества вакансий.
 *
 * @package St\Command
 */
class VacanciesCountQueryParams
{
    /** Код города москва. */
    const CODE_CITY_MOSCOW = 1;

    /** Код города Ульяновск. */
    const CODE_CITY_ULYANOVSK = 1614;

    /**
     * Название вакансии.
     *
     * @var string
     */
    private $vacancy;

    /**
     * Идентификатор города.
     *
     * @var string
     */
    private $cityId;

    /**
     * @param string $vacancy
     * @param string $cityId
     */
    public function __construct($vacancy, $cityId)
    {
        $this->vacancy = strtolower($vacancy);
        $this->cityId = (int) $cityId;
    }

    /**
     * @return string
     */
    public function getVacancy()
    {
        return $this->vacancy;
    }

    /**
     * @return string
     */
    public function getCityId()
    {
        return $this->cityId;
    }

}
