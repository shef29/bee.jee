<?php


namespace app\site\models;

use app\vendor\mvc\models\SearchModel;

class TaskSearch extends SearchModel
{

    /** @var array Переменная для полей по которым можно сортировать */
    public $availableFields = ['username', 'email', 'finished', 'title'];

    /**
     * TaskSearch constructor.
     * @param $ClassName - название модели для которой будет осуществлятся поиск (Обязательный)
     * @param array $attrs
     */
    public function __construct($ClassName, $attrs = [])
    {
        $this->ClassName = $ClassName;

        parent::__construct($attrs);
    }

    /**
     * Метод для поиска.
     * @param array $searchParams
     * @return mixed|null
     * @throws \ActiveRecord\RecordNotFound
     */
    public function findResult($searchParams = [])
    {
        $this->load($searchParams);

        $this->result = Task::find('all', $this->getParamsForQuery());

        return $this->result;
    }

}