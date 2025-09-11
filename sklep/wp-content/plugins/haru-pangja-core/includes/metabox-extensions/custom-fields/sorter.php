<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'RWMB_Sorter_Field' ) ) {
    class RWMB_Sorter_Field extends RWMB_Field {
        static function admin_enqueue_scripts() {
            wp_enqueue_style( 'rwmb-sorter', PLUGIN_HARU_PANGJA_CORE_URL . '/includes/metabox-extensions/custom-fields/assets/css/sorter.css', array() );
            wp_enqueue_script( 'rwmb-sorter', PLUGIN_HARU_PANGJA_CORE_URL . '/includes/metabox-extensions/custom-fields/assets/js/sorter.js', array() );
        }
        /**
         * Get field HTML
         *
         * @param mixed $meta
         * @param array $field
         *
         * @return string
         */
        static function html( $meta, $field ) {
            $meta_arr = array();
            if (isset($meta['enable'])) {
                $meta_arr = explode('||', $meta['enable']);
            }
            $html = sprintf('<div class="rwmb-sorter">');
            $html .= sprintf(
                '<input type="hidden" class="rwmb-hidden" name="%s[enable]" value="%s" data-enable="true"/>',
                $field['field_name'],
                isset($meta['enable']) ? $meta['enable'] : ''
            );
            $html .= sprintf(
                '<input type="hidden" class="rwmb-hidden" name="%s[sort]" value="%s" data-sort="true"/>',
                $field['field_name'],
                isset($meta['sort']) ? $meta['sort'] : ''
            );
            $options = array();
            if (isset($meta['sort'])) {
                $meta_sort_arr = explode('||', $meta['sort']);
                foreach ($meta_sort_arr as $key) {
                    if (isset($field['options']) && isset($field['options'][$key])) {
                        $options[$key] = $field['options'][$key];
                    }
                }
            }
            foreach ( $field['options'] as $key => $value ) {
                $options[$key] = $value;
            }

            $html .= sprintf('<ul class="rwmb-sorter-inner">');
            foreach ( $options as $key => $value ) {
                $html .= '<li>';
                $html .= sprintf('<span>%s</span>', $value);
                $html .= sprintf(
                    '<input type="checkbox" class="rwmb-checkbox" id="%s" value="%s"%s>',
                    $field['id'] . '_' . $key,
                    $key,
                    in_array($key, $meta_arr) ? ' checked="checked"' : ''
                );

                $html .= sprintf('<label for="%s" data-on="ON" data-off="OFF"></label>',
                    $field['id'] . '_' . $key
                );
                $html .= '</li>';
            }

            $html .= '</ul>';

            $html .= '</div>';
            return $html;
        }
    }
}