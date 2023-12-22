<?php
class Excel
{
    function __construct()
    {
        include_once APPPATH . '/third_party/spreadsheet-reader/php-excel-reader/excel_reader2.php';
    }
}
