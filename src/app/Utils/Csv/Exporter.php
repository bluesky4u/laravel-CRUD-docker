<?php

namespace App\Utils\Csv;

interface Exporter
{
    /**
     * @var array
     */
    public const DOWNLOAD_CSV_HEADER = [
        'Content-Type' => 'text/csv',
    ];

    public const DOWNLOAD_XML_HEADER = [
        'Content-Type' => 'application/xml',
    ];

    /**
     * @param array $headers
     *
     * @return static
     */
    public function setHeaders(array $headers);

    /**
     * @return array
     */
    public function getHeaders();

    /**
     * @param string $encodeing
     *
     * @return static
     */
    public function setOutputEncoding(string $encodeing);

    /**
     * @param \Closure $provider
     * @param string|resource $outputDest
     *
     * @return \App\Utils\FileExporter
     */
    public function getExporter(\Closure $provider, $outputDest = 'php://output'): \App\Utils\FileExporter;

    /**
     * @param \Closure $provider
     * @param string|resource $outputDest
     *
     * @return resource
     */
    public function createStream(\Closure $provider, $outputDest = 'php://output');
}
