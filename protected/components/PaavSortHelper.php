<?php

// TODO: make documentation.
class PaavSortHelper
{
    const ORDER_ASC = 'asc';
    const ORDER_DESC = 'desc';

    private $_paramName = 'sort_by';
    private $_paramDelim = '.';
    private $_sortableAttrs = array();
    private $_defaultOrder = self::ORDER_ASC;
    private $_sortBy;
    private $_defaultSortBy = '';

    public $isAsc = true;

    public function __construct($attrs)
    {
        $this->_sortableAttrs = $attrs;

        reset($attrs);
        $this->_sortBy = $this->_defaultSortBy = key($attrs);
    }

    public function isSortable($attr)
    {
        return isset($this->_sortableAttrs[$attr]);
    }

    public function getSqlOrder($request)
    { 
        if (!isset($request[$this->_paramName]))
            return $this->_buildSqlOrder($this->_sortBy, $this->_defaultOrder); 

        $params = explode('.', $request[$this->_paramName]);

        // If array contains 2 elements
        if (isset($params[1])) {
            list($attr, $order) = $params; 
            $this->isAsc = false;
        } else {
            $attr = $params[0];
            $order = $this->_defaultOrder;
        }

        if ($this->isSortable($attr) && self::_isValidOrder($order)) {
            $this->_sortBy = $attr;

            return $this->_buildSqlOrder($this->_sortableAttrs[$attr], $order);
        }
    }

    public function getParams($attr)
    {
        if ($this->isAsc && $this->isSortBy($attr))
            $value = $attr . $this->_paramDelim . self::ORDER_DESC;
        else
            $value = $attr;

        return array($this->_paramName => $value);
    }

    private function _isvalidOrder($order)
    {
        if ($order == self::ORDER_ASC || $order == self::ORDER_DESC)
            return true;
    }

    public function isSortBy($attr)
    {
        return $this->_sortBy == $attr;
    }

    public function getParamName()
    {
        return $this->_paramName;
    }

    private function _buildSqlOrder($column, $order)
    {
        return $column . ' ' . $order;
    }

    public function getSortable(array $attrs)
    {
        if (!isset($attrs))
            return $this->_sortableAttrs;

        return array_intersect($attrs, array_flip($this->_sortableAttrs));
    }

    public function getSortBy()
    {
        return isset($this->_sortBy) ? $this->_sortBy : false;
    }

    public function setSortBy($attr)
    {
        if (!$this->isSortable($attr))
            return;

        $this->_sortBy = $attr;

        return true;
    }
} 
  
  
