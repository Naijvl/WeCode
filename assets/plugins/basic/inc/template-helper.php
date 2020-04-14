<?php



/**
 * 返回给定 slug 对应的分类。
 *
 * @param $slug
 *
 * @return string
 */
function fatwp_get_category_link_by_slug( $slug )
{
	$cat    = get_category_by_slug( $slug );
	$result = '';

	if ( $cat ) {
		$result = get_category_link( $cat->term_id );
	}

	return $result;
}



