<?php
/**
 * Author: Diogo Marcos de Oliveira
 * Date: 15/03/2017
 * Site: http://www.diogomarcos.com
 */

namespace Controller;

// Classe com operações úteis
class Util
{
    /**
     * @param $date_of_birth
     *
     * @return int
     */
    public static function CalculateAge($date_of_birth)
    {
        $date_of_birth_explode = explode('-', $date_of_birth);
        $date_current = date('Y-m-d');
        $date_current_explode = explode('-', $date_current);

        $age = $date_current_explode[0] - $date_of_birth_explode[0];

        if ($date_of_birth_explode[1] >= $date_current_explode[1]) {
            if ($date_of_birth_explode[2] <= $date_current_explode[2]) {
                return $age;
            } else {
                return $age-1;
            }
        } else {
            return $age;
        }
    }
}
