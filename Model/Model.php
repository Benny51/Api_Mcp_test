<?php

namespace Model;

interface Model
{
    function create();
    function getAll();
    function getUserById($id);
    function update($id);
    function delete($id);

}