<?php

namespace Model;

interface Model
{
    function create();
    function getAll();
    function getById($id);
    function update();
    function delete($id);

}