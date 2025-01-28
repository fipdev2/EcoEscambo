<?php

namespace src\Actions;
class UploadFileAction
{
    //Attributes
    private string $path;
    private string $clientPath;
    private string $fileName;
    private string $extension;
    private array $image;

    //Constructor
    public function __construct(array $image)
    {
        $this->extension = pathinfo($image['name'], PATHINFO_EXTENSION);
        $this->fileName = date("d_m_Y_H_i_s") . "." . $this->extension;
        $this->image = $image;
        $this->path = $_SERVER['DOCUMENT_ROOT'] . '/storage/' . $this->fileName;
        $this->clientPath = '/storage/' . $this->fileName;
    }

    //Methods
    public function execute(): bool
    {
        $from = $this->image['tmp_name'];
        $to = $this->path;

        return move_uploaded_file($from, $to);
    }

    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getClientPath(): string
    {
        return $this->clientPath;
    }


}