<?php 

class Basemodel extends Eloquent
{
	public static function validate(array $input)
	{
		if ( count(static::$rules) > 0 ) {
			return Validator::make( $input, static::$rules );
		}

		return false;
	}
}