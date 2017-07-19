<?php
    function justForFun() {
        $file_path = "/Users/yangman/Desktop/query_result.csv";
        $str =[];

        if(file_exists($file_path)) {
            $fp = fopen($file_path,"r");
            while(!feof($fp)) {
                $str[] = fgetcsv($fp);//逐行读取。如果fgets不写length参数，默认是读取1k。

            }

            fclose($fp);
            $result = [];
            foreach ($str as $key => &$value) {
                  $first = $value[7];
                  if(!empty($first) && ($first == 'params')) {
                      continue;
                  }

                  $param = $value[7];
                  eval("\$param = \"$param\";");

                  $decodeValue = json_decode($param);

                  $value[7] = $decodeValue;

                  $result[] = json_encode($value);
            }
            $result = implode("\n", $result);
            file_put_contents('/Users/yangman/Desktop/new.txt', print_r($result, true));
        }
    }
    justForFun();