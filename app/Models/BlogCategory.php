<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
  protected $table = 'blog_categories';

  /**
	 * undocumented function
	 *
	 * @return void
	 * @author 
	 **/
	public static function getName($id)
	{
		$blogCategory = BlogCategory::find($id);
    return $blogCategory->name;
	}
}