<?php
/**
 * Created by PhpStorm.
 * User: RUBEN
 * Date: 2018-06-18
 * Time: 11:07
 */

namespace AppBundle\Service\FormManager;


class FormManager
{

    public function detetePolishChars($var)
    {
        return strtr($var, 'ĘęÓóĄąŚśŁłŹźŻżĆćŃń', 'EeOoAaSsLlZzZzCcNn');
    }

    public function timestampToDate($timestamp)
    {
        $date = new \DateTime();
        $date->setTimestamp($timestamp);
        return $date->format('d-m-Y');
    }

}