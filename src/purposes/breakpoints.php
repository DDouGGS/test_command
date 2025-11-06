<?php

namespace test_command\purposes;

use test_command\Prints;
use test_command\purposes\BreakpointsInterface;

class Breakpoints extends Prints implements BreakpointsInterface
{
    public static function break($output = array(), $condition = true)
    {
        // condition
        if (is_bool($condition) && $condition === true && !empty($output)) {
            // print
            self::block($output, self::backtrace());
            // footer
            self::$index++;
            if(self::getFollow()){self::follow();}
        }
    }

    public static function begin($output = array(), $condition = true)
    {
        // condition
        if (is_bool($condition) && $condition === true && !empty($output)) {
            self::getConnection()->begin_transaction();
            // print
            self::block($output, self::backtrace());
            // footer
            self::$index++;
            if(self::getFollow()){self::follow();}
        }
    }

    public static function rollback($output = array(), $condition = true)
    {
        // condition
        if (is_bool($condition) && $condition === true && !empty($output)) {
            self::getConnection()->rollback_transaction();
            // print
            self::block($output, self::backtrace());
            // footer
            self::$index++;
            if(self::getFollow()){self::follow();}
        }
    }
}