<?php
/**
 * Plugin Name:       Baizy Custom Blocks
 * Plugin URI:        https://github.com/yukiuota/baizy
 * Description:       TypeScript（Vite ビルド）製のカスタムブロックをブロックエディターに追加します。
 * Version:           1.0.0
 * Requires at least: 6.6
 * Requires PHP:      8.0
 * Author:            Yuki Uota
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       baizy-custom-blocks
 *
 * @package baizy-custom-blocks
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'BAIZY_CB_PATH', plugin_dir_path( __FILE__ ) );
define( 'BAIZY_CB_URL', plugin_dir_url( __FILE__ ) );

/**
 * ビルド済みカスタムブロックをブロックエディターに読み込む
 */
function baizy_cb_enqueue_block_editor_assets() {
	$build_file = BAIZY_CB_PATH . 'build/custom-blocks.js';

	// ビルド成果物がない場合は読み込まない（pnpm build 未実行時）
	if ( ! file_exists( $build_file ) ) {
		return;
	}

	wp_enqueue_script(
		'baizy-custom-blocks',
		BAIZY_CB_URL . 'build/custom-blocks.js',
		array( 'wp-blocks', 'wp-element', 'wp-components', 'wp-block-editor', 'react-jsx-runtime' ),
		filemtime( $build_file ),
		true
	);
}
add_action( 'enqueue_block_editor_assets', 'baizy_cb_enqueue_block_editor_assets' );

/**
 * カスタムブロック用のブロックカテゴリーを登録
 *
 * @param array $categories 既存のブロックカテゴリー.
 * @return array
 */
function baizy_cb_register_block_category( $categories ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug'  => 'baizy-blocks',
				'title' => 'カスタムブロック',
				'icon'  => 'admin-appearance',
			),
		)
	);
}
add_filter( 'block_categories_all', 'baizy_cb_register_block_category' );
