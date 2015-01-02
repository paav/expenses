<?php
class MyFormatter extends CFormatter
{
    public function formatInteger($value)
    {
        return number_format($value, 0, null, ' ');
    }

    public function formatRun($value)
    {
        return $this->formatInteger($value) . ' км';
    }

    public function formatPrice($value)
    {
        return $this->formatNumber($value) . ' руб.';
    }

    public function formatQuantity($value)
    {
        return $value . ' шт.';
    }
}
