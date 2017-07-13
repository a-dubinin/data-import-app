<?php

namespace AppBundle\Core\Helper;

/**
 * Class CSVFormatMap helps to identify columns in .csv-file.
 * @package AppBundle\Core\Helper
 */
class CSVFormatMap
{
    const COLUMN_COUNT = 6;

    const COLUMN_PRODUCT_CODE         = 0;
    const COLUMN_PRODUCT_NAME         = 1;
    const COLUMN_PRODUCT_DESC         = 2;
    const COLUMN_PRODUCT_STOCK        = 3;
    const COLUMN_PRODUCT_COST         = 4;
    const COLUMN_PRODUCT_DISCONTINUED = 5;
}
