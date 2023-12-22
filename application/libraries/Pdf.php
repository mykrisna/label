<?php
class Pdf
{
    function __construct()
    {
        include_once APPPATH . '/third_party/fpdf186/fpdf.php';
        //include_once APPPATH . '/third_party/fpdf186/code128.php';
    }
}
