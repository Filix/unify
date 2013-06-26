<?php
namespace Unify\WebBundle\Util;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\File\UploadedFile as File;

class UploadFileUtil extends ContainerAware {
    
    const BASEDIR = 'uploads/';
    const TYPES = 'image/jpeg|image/jpg|image/png|image/gif';
    const MAX_SIZE = 6291456; //B

    private $file;
    
    private $name;
    
    private $filename;


    private $sub_dir;
    
    private $error;
    
    
    public function __construct(){
        
    }
    
    public function setName($name){
        $this->name = $name;
    }
    
    public function getFileName(){
        if($this->filename){
            return $this->filename;
        }
        if($this->name == null){
            $this->filename = md5($this->file->getClientOriginalName().uniqid()).time().'.' . $this->getExtension();
        }else{
            $this->filename = $this->name.'.' . $this->getExtension();
        }
        return $this->filename;
    }
    
    
    public function setSubDir($subDir){
        $this->sub_dir = trim($subDir, '/');
    }
    
    public function upload(File $file = null){
        if($file == null){
            return ;
        }
        $this->file = $file;
        if(!$this->isValid()){
            return false;
        }
        try{
            $this->file->move($this->getUploadRootDir(), $this->getFileName());
            return true;
        }  catch (\Exception $e){
            $this->setError($e->getMessage());
            return false;
        }
    }
    
    public function getPath(){
        return $this->sub_dir ? $this->sub_dir . '/' . $this->getFileName() : $this->getFileName();
    }
    
    protected function getUploadRootDir(){
        return self::BASEDIR . $this->sub_dir;
    }
    
    protected function getExtension(){
        switch($this->getMimeType()){
            case 'image/jpeg':
            case 'image/jpg':
                return 'jpg';
            case 'image/png':
                return 'png';
            case 'image/gif':
                return 'gif';
        }
        return '';
    }
    
    protected function isValid(){
        if(!$this->file->isValid()){
            $this->setError($this->file->getError());
            return false;
        }
        if(!$this->sizeValid()){
            $this->setError('图片最大'.($this->getMaxSize()/1024/1024).'MB');
            return false;
        }
        if(!$this->typeValid()){
            $this->setError('图片格式只支持jpg,png,gif');
            return false;
        }
        return true;
    }
    
    protected function sizeValid(){
        return $this->getSize() <= $this->getMaxSize() ? true : false;
    }

    protected function typeValid(){
        return strpos(self::TYPES, $this->getMimeType()) === false ? false : true;
    }
    
    protected function getSize(){
        return $this->file->getSize();
    }
    
    protected function getMaxSize(){
       return min($this->file->getMaxFileSize(), self::MAX_SIZE);
    }
    
    protected function getMimeType(){
        return $this->file->getMimeType();
    }

    
    protected function setError($error){
        $this->error = $error;
    }
    
    public function getError(){
        return $this->error;
    }
    
    
}
?>
