<?php

//escapes data when coming out of the db
function escape($string){
	return htmlentities($string,ENT_QUOTES,'UTF-8');
}