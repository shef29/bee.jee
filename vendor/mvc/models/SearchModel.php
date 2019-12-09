<?php

namespace app\vendor\mvc\models;


class SearchModel
{

    /**
     * @var Название модели для поиска
     */
    public $ClassName;
    /**
     * @var Кол-во всех записей
     */
    public $totalRecords;

    /**
     * @var Кол-во страниц для пагинации
     */
    public $totalPages = 1;
    public $paginate = false;
    public $currentPage = 1;
    public $offset = 0;
    public $order = '';

    /**
     * @var int Кол-во результатов на страницу
     */
    public $limit = 30;

    /** @var array Переменная для полей по которым можно сортировать */
    public $availableFields = [];

    public $sort;
    public $defaultSort = 'id desc';

    public $result = null;
    public $params = [];

    public function __construct($attrs = [])
    {
        if (!empty($attrs) and is_array($attrs)) {
            foreach ($attrs as $attr => $value) {
                if (isset($this->$attr)) {
                    $this->$attr = $value;
                }
            }
        }
        $this->setTotalRecords();   // Установить кол-во всех записей
        $this->setTotalPages();     // Установить кол-во страниц для пагинации
    }

    public function setTotalRecords()
    {
        $this->totalRecords = $this->ClassName::count();
    }

    public function getTotalRecords()
    {
        return $this->totalRecords;
    }

    public function setTotalPages()
    {
        if ($this->totalRecords > 0) {
            $this->totalPages = ceil($this->totalRecords / $this->limit);
            $this->setPaginate();
        }
    }

    public function setOffset()
    {
        $this->offset = ($this->currentPage - 1) * $this->limit;
    }

    public function setPaginate()
    {
        if ($this->totalRecords > $this->limit) {
            $this->paginate = true;
        }
    }

    public function getResult()
    {
        return $this->result;
    }

    public function findResult($searchParams = [])
    {
        $this->load($searchParams);

        $this->result = $this->ClassName::find('all', $this->getParamsForQuery());

        return $this->result;
    }

    public function load($searchParams = [])
    {
        if (empty($searchParams)) return false;

        $this->checkAndSetCurrentPage($searchParams);
        $this->setOffset();

        $this->setSort($searchParams);
    }

    public function checkAndSetCurrentPage($searchParams)
    {
        if (isset($searchParams['page'])) {
            $page = (int)$searchParams['page'];
            if ($page <= 0 or $page > $this->totalPages) {
                return to_404();
            } else {
                $this->currentPage = $page;
            }
        }
    }

    /**
     * @param $params - В данном случаи $_GET
     * @return bool
     */
    protected function setSort($params)
    {
        if (!is_array($params) or empty($params)) {
            return false;
        }

        foreach ($params as $key => $value) {
            if (in_array($key, $this->availableFields)) {
                if ($value === 'd') {
                    $this->sort[$key] = 'a'; // для сортировки во view
                    $this->order .= $key . ' ' . 'desc, ';
                }
                if ($value === 'a') {
                    $this->sort[$key] = 'd';
                    $this->order .= $key . ' ' . 'asc, ';
                }
            }
        }
        $this->order = trim($this->order, ', ');
    }

    protected function getParamsForQuery()
    {
        if ($this->limit > 0) {
            $this->params = [
                'limit' => $this->limit,
                'offset' => $this->offset,
            ];
        }
        if (!empty($this->order)) {
            $this->params['order'] = $this->order;
        } else {
            $this->params['order'] = $this->defaultSort;
        }

        return $this->params;
    }

    public function getSortUrlByAttr($attr)
    {
        if (key_exists($attr, $_GET) and key_exists($attr, $this->sort)) {
            $params = array_merge($_GET, [$attr => $this->sort[$attr]]);
        } else {
            $params = array_merge($_GET, [$attr => 'd']);
        }
        
        return '?' . trim(http_build_query($params), '?');
    }

    public function getUrlForNav($i)
    {
        $params = array_merge($_GET, ['page' => $i]);
        return '?' . trim(http_build_query($params), '?');
    }
}