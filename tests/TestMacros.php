<?php

namespace MortenScheel\LaravelMacros\Tests;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TestMacros extends TestCase
{
    public function testSortCollectionKeysRecursivelyAscending()
    {
        $unsorted = [
            'b' => [
                'y' => 1,
                'x' => [
                    'd' => 1,
                    'f' => 2,
                    'e' => 3,
                ],
                'z' => 3,
            ],
            'c' => 2,
            'a' => [
                'c' => 1,
                'a' => 2,
                'b' => 3,
            ],
        ];
        $expected = [
            'a' => [
                'a' => 2,
                'b' => 3,
                'c' => 1,
            ],
            'b' => [
                'x' => [
                    'd' => 1,
                    'e' => 3,
                    'f' => 2,
                ],
                'y' => 1,
                'z' => 3,
            ],
            'c' => 2,
        ];
        $sorted = collect($unsorted)->sortKeysRecursively()->toArray();
        $this->assertEquals($expected, $sorted);
    }

    public function testSortCollectionKeysRecursivelyDescending()
    {
        $unsorted = [
            'b' => [
                'y' => 1,
                'x' => [
                    'd' => 1,
                    'f' => 2,
                    'e' => 3,
                ],
                'z' => 3,
            ],
            'c' => 2,
            'a' => [
                'c' => 1,
                'a' => 2,
                'b' => 3,
            ],
        ];
        $expected = [
            'c' => 2,
            'b' => [
                'z' => 3,
                'y' => 1,
                'x' => [
                    'f' => 2,
                    'e' => 3,
                    'd' => 1,
                ],
            ],
            'a' => [
                'c' => 1,
                'b' => 3,
                'a' => 2,
            ],
        ];
        $sorted = collect($unsorted)->sortKeysRecursively()->toArray();
        $this->assertEquals($expected, $sorted);
    }


    public function testCarbonRoundUpToNearest()
    {
        $tests = [
            ['00:00:00', 15, '00:00:00'],
            ['00:00:01', 15, '00:15:00'],
            ['00:14:59', 15, '00:15:00'],
            ['00:15:00', 15, '00:15:00'],
            ['00:15:00', 60, '01:00:00'],
            ['01:00:00', 60, '01:00:00'],
            ['01:00:01', 60, '02:00:00'],
            ['02:00:01', 30, '02:30:00'],
        ];
        foreach ($tests as $test) {
            [$start, $minutes, $expected] = $test;
            $carbon = Carbon::make('1970-01-01 ' . $start);
            $carbon = $carbon->upToNearest($minutes);
            $result = $carbon->format('H:i:s');
            $this->assertEquals($expected, $result);
        }
    }

    public function testCarbonRoundDownToNearest()
    {
        $tests = [
            ['00:00:00', 15, '00:00:00'],
            ['00:00:01', 15, '00:00:00'],
            ['00:14:59', 15, '00:00:00'],
            ['00:15:01', 15, '00:15:00'],
            ['00:15:00', 60, '00:00:00'],
            ['01:00:00', 60, '01:00:00'],
            ['01:00:01', 60, '01:00:00'],
            ['02:00:01', 30, '02:00:00'],
            ['02:49:59', 30, '02:30:00'],
        ];
        foreach ($tests as $test) {
            [$start, $minutes, $expected] = $test;
            $carbon = Carbon::make('1970-01-01 ' . $start);
            $carbon = $carbon->downToNearest($minutes);
            $result = $carbon->format('H:i:s');
            $this->assertEquals($expected, $result);
        }
    }

    public function testPlainTextResponse()
    {
        $generated = response()->plain('I am plaintext');
        $contentType = $generated->headers->get('Content-Type');
        $this->assertEquals('text/plain;charset=UTF-8', $contentType);
    }

    public function testQueryBuilderInlineQuery()
    {
        $date = now()->startOfDay()->toDateTimeString();
        $query = DB::table('my_table')->where('id', '>', 1)->where('created_at', '<=', $date);
        $inline = $query->inlineQuery();
        $expected = "select * from `my_table` where `id` > '1' and `created_at` <= '$date'";
        $this->assertEquals($expected, $inline);
    }

    public function testFilesystemModifyFile()
    {
        /** @var \Illuminate\Filesystem\Filesystem $filesystem */
        $filesystem = app('files');
        $testFilePath = storage_path('test.txt');
        if ($filesystem->exists($testFilePath)) {
            $filesystem->delete($testFilePath);
        }
        $filesystem->put($testFilePath, 'Foo');
        $filesystem->modify($testFilePath, function ($content) {
            $this->assertEquals('Foo', $content);
            return 'Bar';
        });
        $modified = $filesystem->get($testFilePath);
        $this->assertEquals('Bar', $modified);
    }
}
