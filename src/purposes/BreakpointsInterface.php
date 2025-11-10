<?php

namespace test_command\purposes;

interface BreakpointsInterface
{
    public function halt($output = array(), $condition = true);

    public function begin($output = array(), $condition = true);

    public function rollback($output = array(), $condition = true);
}