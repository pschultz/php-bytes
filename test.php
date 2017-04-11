<?php

class Test extends PHPUnit\Framework\TestCase
{
    public function samples()
    {
        yield [   '',  0 ];
        yield [  '1',  1 ];
        yield [ ' 0',  0 ];
        yield [ '-1', -1 ];
        yield [ '-2', -2 ];

        yield [ '-1k',  -1*1024           ];
        yield [  '1k',   1*1024           ];
        yield [  '1K',   1*1024           ];
        yield [  '8K',   8*1024           ];
        yield [  '1m',   1*1024*1024      ];
        yield [  '1g',   1*1024*1024*1024 ];
        yield [  '1x',   1                ];
        yield [  '1MB',  1                ];
        yield [  '1xY',  1                ];
        yield [ '3.5m',  3*1024*1024      ];
        yield [ '011M',  9*1024*1024      ]; // base 8
        yield [ '0xBM', 11*1024*1024      ]; // base 16
        yield [ 'X',               0      ];

        yield [ '3BM',  3*1024*1024 ];
        // Yes, really :(  Try `php -d memory_limit=3BM -r 'array_fill(0, 1<<30, null);'`
    }

    /** @dataProvider samples */
    public function testBytes($given, $expected)
    {
        $this->assertSame($expected, bytes($given));
    }
}
