<?php


namespace App;


trait DateFormat
{
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format($this->getDateFormat());
    }
}
