<?php

class PeakFinder {

    private $values = array();
    private $sum;
    private $max;
    private $length;
    private $index;

    public function PeakFinder($length) {
        $this->length = $length;
    }

    public function add($num, $index) {
        array_push($this->values, $num);
        $this->sum += $num;

        if (count($this->values) > $this->length) {
            $n = array_shift($this->values);
            $this->sum -= $n;
        }

        if (count($this->values) === $this->length) {
            if ($this->sum >= $this->max) {
                // save the index of the array
                $this->index = $index;
            }
            $this->max = max($this->sum, $this->max);
        }
    }

    public function max() {
        return $this->max;
    }

    public function loc() {
        return ($this->index - $this->length) + 1;
    }

}

function max_subarray($array, $interval = 1) {

    $finder = new PeakFinder($interval);
    foreach ($array as $k => $v) {
        $finder->add($v, $k);
    }
    return array($finder->max(), $finder->loc());
}

//$arr = array(0,1,2,3,4,5,6,7,8,9);
//list ($max, $idx) = max_subarray($arr, 2);
//
//$arr = array(0,3,3,3,3,9);
//list ($max, $idx) = max_subarray($arr, 3);
//
//$arr = array(0,1,2,2,2,2,2);
//list ($max, $idx) = max_subarray($arr, 4);
?>
