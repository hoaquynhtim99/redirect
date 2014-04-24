<?php

/**
 * @Project NUKEVIET 3.1
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2011 VINADES.,JSC. All rights reserved
 * @Createdate 24-06-2011 10:35
 */

if ( ! defined( 'NV_IS_REDIRECT_ADMIN' ) ) die( 'Stop!!!' );

if( $nv_Request->isset_request( "submit", "post" ) )
{
	$url = $nv_Request->get_string( "url", "post", "" );
	$db->sql_query( "REPLACE INTO `" . NV_PREFIXLANG . "_" . $module_data . "` VALUES(1, " . $db->dbescape( $url ) . ")" );
	
	nv_del_moduleCache( $module_name );
	
    Header( "Location: " . NV_BASE_ADMINURL . "index.php?" . NV_NAME_VARIABLE . "=" . $module_name );
    die();
}

$xtpl = new XTemplate( "main.tpl", NV_ROOTDIR . "/themes/" . $global_config['module_theme'] . "/modules/" . $module_file );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'GLANG', $lang_global );
$xtpl->assign( 'URL', $redirect_url );

$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

include ( NV_ROOTDIR . "/includes/header.php" );
echo nv_admin_theme( $contents );
include ( NV_ROOTDIR . "/includes/footer.php" );

?>