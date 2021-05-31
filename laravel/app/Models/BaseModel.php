<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Config;
use DB;

class BaseModel extends Model
{

    protected static $masterConnection = null;
    protected static $slaveConnection = null;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        if (self::$masterConnection == null) {
            self::$masterConnection = Config::get('database.default');
        }

        if (self::$slaveConnection == null) {
            try {
                self::$slaveConnection = Config::get('database.slave');
                if (!Config::get('database.connections.' . self::$slaveConnection)) {
                    self::$slaveConnection = self::$masterConnection;
                }
            } catch (\Exception $e) {
                self::$slaveConnection = self::$masterConnection;
            }
        }
    }

    public function master()
    {
        return $this->setConnection(self::$masterConnection);
    }

    public function slave()
    {
        return $this->setConnection(self::$slaveConnection);
    }

    public function getMasterConnection()
    {
        return self::$masterConnection;
    }

    public function getSlaveConnection()
    {
        return self::$slaveConnection;
    }

    public function fullTableName()
    {
        $table = $this->getTable();
        $tablePreFix = DB::getTablePrefix();
        return $tablePreFix . $table;
    }

    public function tableName()
    {
        return $this->getTable();
    }
}
