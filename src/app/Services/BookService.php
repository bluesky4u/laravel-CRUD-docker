<?php

namespace App\Services;

interface BookService
{
    /**
     * @param string $downloadItem items to download
     * @param string $downloadAs file type to download
     *
     * @return Closure
     */
    public function export(string $downloadItem, string $downloadAs);

    /**
     * @param string $downloadItem
     *
     * @return Closure
     */
    public function convertToCsv(string $downloadItem);

    /**
     * @param string $downloadItem
     *
     * @return Closure
     */
    public function convertToXml(string $downloadItem);
}
