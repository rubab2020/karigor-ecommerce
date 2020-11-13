<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeOption extends Model
{
	protected $table = 'attribute_options';

	public static function getAttributeMappedOptions() {
	    $attrOptions = self::get();
		$attributeMappedOptions = [];
		foreach($attrOptions as $attrOption){
	        $attributeMappedOptions['attrid_'.$attrOption->attribute_id]['optid_'.$attrOption->id] = $attrOption->name;
	    }
	    return $attributeMappedOptions;
	}
}
