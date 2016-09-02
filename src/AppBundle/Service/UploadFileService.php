<?php
/**
 * Created by PhpStorm.
 * User: renan
 * Date: 9/2/2016
 * Time: 7:02 PM
 */

namespace AppBundle\Service;


use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadFileService
{
    private $diretorio;

    public function __construct($diretorio) {
        $this->diretorio = $diretorio;
    }
    public function upload(UploadedFile $file) {

        $fileName = md5(uniqid()).'.'.$file->getClientOriginalExtension();

        $file->move($this->diretorio, $fileName);

        return $fileName;

    }
}