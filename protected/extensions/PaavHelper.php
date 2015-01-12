<?php

class PaavHelper extends CApplicationComponent
{
    public function getHash($data, $algo = 'sha256', $key = null)
    {
        $key = $key ?: Yii::app()->params['encryptionKey'];

        return hash_hmac($algo, $data, $key);
    }
}
