<?php

namespace App\Services;

use App\Repositories\BookRepository;
use App\Utils\Csv\Exporter;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Kyslik\ColumnSortable\Sortable;

class BookServiceConcrete implements BookService
{
    use Sortable;
    private BookRepository $bookRepository;
    private Exporter $exporter;

    public function __construct(
        BookRepository $bookRepository,
        Exporter $exporter,
    ) {
        $this->bookRepository = $bookRepository;
        $this->exporter = $exporter;
    }

    /**
     * @param string $toDownload
     *
     * @return array
     */
    public function export(string $downloadItem, string $downloadAs): array
    {
        if ($downloadAs == 'csv') {
            $headers = $this->exporter::DOWNLOAD_CSV_HEADER;
            $fileName = sprintf(__('validation.bookList.csv'), Carbon::now('Asia/Tokyo')->format('Ymd-His'));
            $callback = $this->convertToCsv($downloadItem);
        } else {
            $headers = $this->exporter::DOWNLOAD_XML_HEADER;
            $fileName = sprintf(__('validation.bookList.xml'), Carbon::now('Asia/Tokyo')->format('Ymd-His'));
            $callback = $this->convertToXml($downloadItem);
        }

        // return values compacted
        return compact('callback', 'fileName', 'headers');
    }

    /**
     * @param string $downloadItem
     *
     * @return Closure
     */
    public function convertToCsv(string $downloadItem)
    {
        switch ($downloadItem) {
            case 'author':
            case 'title':
                $this->exporter->setHeaders(Arr::only(config('mics.download_header.book'), ['id', $downloadItem]));
                break;
            default:
                $this->exporter->setHeaders(Arr::except(config('mics.download_header.book'), ['createAt', 'updateAt']));
                break;
        }

        // callback function for csv contents
        return $this->exporter->getExporter(function ($processor) {
            $this->bookRepository->chunk(1000, function ($chunk) use ($processor) {
                foreach ($chunk as $data) {
                    $data = $data->only($this->exporter->getHeaders());
                    $processor($data);
                }
            });
        });
    }

    /**
     * @param string $downloadItem
     *
     * @return Closure
     */
    public function convertToXml(string $downloadItem)
    {
        switch ($downloadItem) {
            case 'author':
            case 'title':
                $books = $this->bookRepository->all(Arr::only(config('mics.download_header.book'), ['id', $downloadItem]))->toArray();
                break;
            default:
                $books = $this->bookRepository->all(Arr::except(config('mics.download_header.book'), ['createAt', 'updateAt']))->toArray();
                break;
        }
        $xml = new \SimpleXMLElement('<books></books>');

        // Convert the data to XML
        foreach ($books as $book) {
            $bookElement = $xml->addChild('book');
            foreach ($book as $key => $value) {
                $bookElement->addChild($key, $value);
            }
        }
        // Return the XML as a string
        $xmlData = $xml->asXML();

        return function () use ($xmlData) {
            echo $xmlData;
        };
    }
}
