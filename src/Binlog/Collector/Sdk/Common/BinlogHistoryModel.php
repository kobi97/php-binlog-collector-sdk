<?php
namespace Binlog\Collector\Sdk\Common;

use Gnf\db\base;

/**
 * Class BinlogHistoryModel
 * @package Binlog\Collector\Sdk\Common
 */
abstract class BinlogHistoryModel
{
    /**
     * @var base
     */
    protected $db;

    private function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * @param base $db
     *
     * @return static
     */
    public static function create(base $db)
    {
        return new static($db);
    }

    public function transactional(callable $callable)
    {
        return $this->db->transactional($callable);
    }
}
