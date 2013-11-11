<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Vic
 * Date: 2013.11.10.
 * Time: 21:52
 * To change this template use File | Settings | File Templates.
 */

class CommonUtils {

    public static function csvToKeyArray($file, $delimiter){
        // Arrays we'll use later
        $keys = array();
        $newArray = array();

        // Do it
        $data = CommonUtils::csvToArray($file, $delimiter);

		debug($data);

        // Set number of elements (minus 1 because we shift off the first row)
        $count = count($data) - 1;

        //Use first row for names
        $labels = array_shift($data);

        foreach ($labels as $label) {
            $keys[] = $label;
        }

        // Add Ids, just in case we want them later
        $keys[] = 'id';

        for ($i = 0; $i < $count; $i++) {
            $data[$i][] = $i;
        }

        // Bring it all together
        for ($j = 0; $j < $count; $j++) {
            $d = array_combine($keys, $data[$j]);
            $newArray[$j] = $d;
        }
    }

    // Function to convert CSV into associative array
    private function csvToArray($file, $delimiter) {
        if (($handle = fopen($file, 'r')) !== FALSE) {
            $i = 0;
            while (($lineArray = fgetcsv($handle, 4000, $delimiter, '"')) !== FALSE) {
                for ($j = 0; $j < count($lineArray); $j++) {
                    $arr[$i][$j] = $lineArray[$j];
                }
                $i++;
            }
            fclose($handle);
        }
        return $arr;
    }

}