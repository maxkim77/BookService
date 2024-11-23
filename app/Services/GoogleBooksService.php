<?php

namespace App\Services;

use Google_Client;
use Google_Service_Books;

class GoogleBooksService
{
    private $client;
    private $service;
        /*
    Google Books API 키를 환경변수에서 가져옵니다.
    Google Client를 초기화하고, 애플리케이션 이름과 API 키를 설정합니다.
    GoogleBooks 서비스 객체를 생성합니다.
    */
    public function __construct()
    {   

        $API_KEY = env('GOOGLE_BOOKS_KEY');

        $this->client = new Google_Client();
        $this->client->setApplicationName("BookTrunk");
        $this->client->setDeveloperKey($API_KEY);

        $this->service = new Google_Service_Books($this->client);
    }
    /**
     * 주어진 키워드로 책을 검색합니다.
     *
     * @param string $keyword 검색할 키워드
     * @param array $optParams 선택 매개변수 (예: 필터링 옵션)
     * @return array 검색된 책 데이터
     */
    public function searchBooks(string $keyword, array $optParams = [])
    {
        $results = $this->service->volumes->listVolumes($keyword, $optParams);
        return $this->transformBooks($results);
    }
    /**
     * 주어진 ID로 책을 가져옵니다.
     *
     * @param string $id 책의 ID
     * @return array 책 데이터
     */
    public function getBook(string $id)
    {
        $book = $this->service->volumes->get($id);
        return $this->transformBookData($book);
    }

    /**
     * 책 데이터를 변환합니다.
     *
     * @param array $books 변환할 책 데이터
     * @return array 변환된 책 데이터 배열
     */

    private function transformBooks($books)
    {
        $data = [];
        foreach ($books as $book) {
            $data[] = $this->transformBookData($book);
        }
        return $data;
    }
    /**
     * 단일 책 데이터를 변환합니다.
     *
     * @param object $book 변환할 단일 책 데이터
     * @return array 변환된 책 데이터
     * 책의 불륨정보와 판매정보를 가져옵니다.
     * 필요한 책정보를 배열형태로 변환해서 반환합니다.   
     */

    private function transformBookData($book)
    {
        $volumeInfo = $book['volumeInfo'];
        $saleInfo = $book['saleInfo'];
        $imageLinks = $volumeInfo['imageLinks'] ?? [];

        return [
            'id' => $book['id'],
            'title' => $volumeInfo['title'],
            'author' => $volumeInfo['authors'] ?? [],
            'description' => $volumeInfo['description'] ?? [],
            'thumbnail' => $imageLinks['thumbnail'] ?? null,
            'extraLarge' => $imageLinks['extraLarge'] ?? null,
            'category' => $volumeInfo['categories'] ?? [],
            'publisher' => $volumeInfo['publisher'] ?? null,
            'publishedDate' => $volumeInfo['publishedDate'] ?? null,
            'price' => $saleInfo['retailPrice'] ?? null,
            'buyLink' => $saleInfo['buyLink'] ?? null,
        ];
    }
}
