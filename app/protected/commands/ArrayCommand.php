<?php
class ArrayCommand extends CConsoleCommand {

    /**
     * TODO:: Вы тут скорей хотели увидеть быстрые алгортимы работы с массивами
     * @param string $a
     * @param string $b
     */
    public function actionIndex($a, $b) {
        $attrResultA = $this->getArray($a);
        $attrResultB = $this->getArray($b);
        $attrDiffA = $this->getDiff($attrResultA, $attrResultB);
        $attrDiffB = $this->getDiff($attrResultB, $attrResultA);
        if ($attrDiffA) {
            echo 'Массив [а] не содежит следующие элементы массива [б]:
            ' . implode(',', $attrDiffA) . PHP_EOL;
        }
        if ($attrDiffB) {
            echo 'Массив [б] не содежит следующие элементы массива [а]:
            ' . implode(',', $attrDiffB) . PHP_EOL;
        }
    }

    /**
     * @param array $attrA
     * @param array $attrB
     * @return array
     */
    private function getDiff(array $attrA, array $attrB) {
        $attrResult = array();
        foreach ($attrB as $val) {
            if (!array_search($val, $attrA)) {
                $attrResult[] = $val;
            }
        }
        return $attrResult;
    }

    private function getArray($string) {
        $attrResult = explode(' ', $string);
        if (count($attrResult)==1 && $attrResult[0]==$string) {
            return $this->getArrayFile($attrResult[0]);
        }
        return $attrResult;
    }

    /**
     * @param string $strFileName
     * @return array
     */
    private function getArrayFile($strFileName) {
        if (file_exists($strFileName) && is_readable($strFileName)) {
            return explode(' ', file_get_contents($strFileName));
        }
        return array();
    }
} 