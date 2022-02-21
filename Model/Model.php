<?php

namespace Model;

interface Model
{
    function create();
    function getAll();
    function update($id);
    function delete($id);

}