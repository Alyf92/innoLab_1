<?php


class Mistakes
{

    public function __construct()
    {
        $a = 41;;;
    }
    public function mistake_1()
    {
        $arr = array(1, 2, 3, 4);
        foreach ($arr as &$value) {
            $value = $value * 2;
        }
        // $arr is now array(2, 4, 6, 8)

        $array = [1, 2, 3];
        echo implode(',', $array), "\n";

        foreach ($array as &$value) {
        }    // by reference
        echo implode(',', $array), "\n";

        foreach ($array as $value) {
        }     // by value (i.e., copy)
        echo implode(',', $array), "\n";
    }

    public function mistake_2()
    {
        $data['keyShouldBeSet'] = 1;

        if (!isset($data['keyShouldBeSet'])) {
            // do something here if 'keyShouldBeSet' is not set
        }

        $_POST['active'] = null;
        if ($_POST['active']) {
            $postData = var_dump($_POST);
        }

        // other example
        if (!isset($postData)) {
            echo 'post not active';
        }
    }

    //prepeared for mistake_3
    private $values = [];
    public function getValues()
    {
        return $this->values;
    }

    public function mistake_3()
    {
        // getValues() returns a COPY of the $values array, so this adds a 'test' element
        // to a COPY of the $values array, but not to the $values array itself.
        $this->getValues()['test'] = 'test';
        // getValues() again returns ANOTHER COPY of the $values array, and THIS copy doesn't
        // contain a 'test' element (which is why we get the "undefined index" message).
        echo $this->getValues()['test'];
        //PHP Notice:  Undefined index: test in /path/to/my/script.php on line 21
    }

    public function mistake_4()
    {
        $connection = new mysqli('localhost', 'root', '', 'userverwaltung');
        $models = [];
        $inputValues = array(1, 2, 3, 4, 5);
        foreach ($inputValues as $inputValue) {
            $models[] = $inputValue;
        }

        $data = [];
        $ids = array(1, 2, 3, 4, 5);
        foreach ($ids as $id) {
            $result = $connection->query("SELECT * FROM `users` WHERE `id` = " . $id);
            $data[] = $result->fetch_row();
        }
    }

    public function mistake_5()
    {
        $connection = new mysqli('localhost', 'root', '', 'userverwaltung');
        $res = $connection->query('SELECT * FROM `users` LIMIT 10000');
        echo "Limit 10000: " . memory_get_peak_usage() . "\n";
    }

    public function mistake_6()
    {
        $_POST['name'][0] = 'Schrödinger';
        strlen($_POST['name'][0]);
    }

    public function mistake_7()
    {
        unset($_POST);
        var_dump($_POST);
    }

    public function mistake_8()
    {
        for ($c = 'a'; $c <= 'z'; $c++) {
            echo $c . "\n";
        }
        $c = 'z';
        echo ++$c . "\n";
    }

    public function mistake_9()
    {
        //The main problem in this code is that the user-submitted value 
        //($_GET['query']) is output directly to the page, 
        //resulting in a Cross Site Scripting (XSS) vulnerability.
        echo ("<p>Search results for query: " .
            $_GET['query'] . ".</p>");
        echo ("<p>Search results for query: " .
            htmlspecialchars($_GET['query']) . ".</p>");
    }

    public function mistake_10()
    {
        // PHP 5.0 or later:
        $array = [];
        var_dump(empty($array));        // outputs bool(true) 
        $array = new ArrayObject();
        var_dump(empty($array));        // outputs bool(false)
        // why don't these both produce the same output?F
    }
}

$mistake = new Mistakes();

$mistake->mistake_1();
$mistake->mistake_2();
$mistake->mistake_3();
$mistake->mistake_4();
$mistake->mistake_5();
$mistake->mistake_6();
