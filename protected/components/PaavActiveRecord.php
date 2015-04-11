<?php
class PaavActiveRecord extends CActiveRecord
{
    public function formatForView($isForForm = false)
    {
        $attrs = $this->attributes;
        $nf = Yii::app()->numberFormatter;

        foreach  ($attrs as $name => $value) {
            if (!is_numeric($value))
                continue;

            if (!$isForForm) {
                $this->$name = $nf->formatDecimal($value);
                continue;
            }

            // '1.00' == '1'
            if ($value === (string)(int)$value)
                continue;

            // (float)1.00 === 1
            if ($value == (string)(float)$value)
                $this->$name = $nf->format('#0.00', $value);
        }
    }

    protected function beforeValidate()
    {
        // Changes comma in number to point
        //

        $attrs = $this->attributes;

        foreach  ($attrs as $name => $value) {
            // TODO: think about locale issues
            $value = str_replace(',', '.', $value);

            if (!is_numeric($value))
                continue;

            $this->$name = $value;
        }

        return parent::beforeValidate();
    }
}
