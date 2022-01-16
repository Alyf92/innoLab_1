<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample #1</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <div class="card">
            <h3>Common Mistake #1: Leaving dangling array references after foreach loops</h3>
            <?php

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
            ?>
        </div>

        <div class="card">
            <h3>Common Mistake #2: Misunderstanding isset() behavior</h3>
            <?php
            $data['keyShouldBeSet'] = 1;
            if (!isset($data['keyShouldBeSet'])) {
                // do something here if 'keyShouldBeSet' is not set
            }

            $_POST['active'] = null;
            if ($_POST['active']) {
                $postData = var_dump($_POST);
            }

            // ...

            if (!isset($postData)) {
                echo 'post not active';
            }
            ?>
        </div>
        <div class="card">
            <h3>Common Mistake #3: Confusion about returning by reference vs. by value</h3>
            <?php
            class Config
            {
                private $values = [];

                public function getValues()
                {
                    return $this->values;
                }
            }

            $config = new Config();
            // getValues() returns a COPY of the $values array, so this adds a 'test' element
            // to a COPY of the $values array, but not to the $values array itself.
            $config->getValues()['test'] = 'test';
            // getValues() again returns ANOTHER COPY of the $values array, and THIS copy doesn't
            // contain a 'test' element (which is why we get the "undefined index" message).
            echo $config->getValues()['test'];
            ?>
        </div>

        <div class="card">
            <h3>Common Mistake #4: Performing queries in a loop</h3>
            <?php
            $models = [];

            foreach ($inputValues as $inputValue) {
                $models[] = $valueRepository->findByValue($inputValue);
            }

            $data = [];
            foreach ($ids as $id) {
                $result = $connection->query("SELECT `x`, `y` FROM `values` WHERE `id` = " . $id);
                $data[] = $result->fetch_row();
            }
            ?>
        </div>

        <div class="card">
            <h3>Common Mistake #5: Memory usage headfakes and inefficiencies</h3>
            <?php
            $res = $connection->query('SELECT `x`,`y` FROM `test` LIMIT 10000');
            echo "Limit 10000: " . memory_get_peak_usage() . "\n";
            ?>
        </div>

        <div class="card">
            <h3>Common Mistake #6: Ignoring Unicode/UTF-8 issues</h3>
            <?php
            $_POST['name'][0] = 'Schrödinger';
            strlen($_POST['name']);
            ?>
        </div>

        <div class="card">
            <h3>Common Mistake #7: Assuming $_POST will always contain your POST data</h3>
            <?php
            unset($_POST);
            var_dump($_POST);
            ?>
        </div>

        <div class="card">
            <h3>Common Mistake #8: Thinking that PHP supports a character data type</h3>
            <?php
            for ($c = 'a'; $c <= 'z'; $c++) {
                echo $c . "\n";
            }
            $c = 'z';
            echo ++$c . "\n";
            ?>
        </div>

        <div class="card">
            <h3>Common Mistake #9: Ignoring coding standards</h3>
            <?php

            ?>
        </div>

        <div class="card">
            <h3>Common Mistake #10: Misusing empty()</h3>
            <?php
            // PHP 5.0 or later:
            $array = [];
            var_dump(empty($array));        // outputs bool(true) 
            $array = new ArrayObject();
            var_dump(empty($array));        // outputs bool(false)
            // why don't these both produce the same output?
            ?>
        </div>
    </div>

</body>

</html>