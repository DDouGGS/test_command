<?php

namespace test_command\purposes;

interface BreakpointsInterface
{
    public static function break($output = array(), $condition = true);

    public static function begin($output = array(), $condition = true);

    public static function rollback($output = array(), $condition = true);
}