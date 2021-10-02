<?php
require_once 'config.php';

if(Sessions::exists('success'))
{
 echo Sessions::flash('success');
}


