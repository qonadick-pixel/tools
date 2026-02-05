<?php
class FileUpload {

    private $file;

    public function __construct($file) {
        $this->file = $file;
    }

    public function upload() {

        if ($this->canUpload()) {
            $result = $this->doUpload();
            return $result;
        }

        return false;
    }


    protected function canUpload() {

        //see http://htmlbook.ru/html/value/mime
        $types = ['image/jpeg', 'image/png', 'image/bmp', 'image/gif'];

        if (!in_array($this->file['type'], $types))
            return false;

        return true;
    }

    protected function doUpload() {

        $name = mt_rand(0, 10000) . '_' . $this->file['name'];
        $this->file['name'] = $name;
        $upload_dir = ROOT_DIR . '/uploads/' . $name;

        $result = move_uploaded_file($this->file['tmp_name'], $upload_dir);

        if ($result) {
            $this->insert();
            $this->view();
        }

        return $result;
    }


    protected function insert() {
        //$sql = 'INSERT IGNORE INTO users (image) VALUES (:image)';
        //$sth = $this->_db->prepare($sql);
        //$result = $sth->execute([':image' => $this->file['name']]);
        //return $result;

    }

    protected function view() {
        $url = DOMAIN . '/uploads/' . $this->file['name'];
        echo '<img src="' . $url . '" width="300px" />';
        echo '<a href="/profile">взад</a>';

    }
}


const DOMAIN = '/main/';
const ROOT_DIR = __DIR__;

if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
    $f = new FileUpload($_FILES['file']);
    $f->upload();

} else {
    echo 'файл пока не был выбран <a href="/profile">взад</a>';
}
?>