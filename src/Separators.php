<?php
namespace IdeasOnPurpose\WP\Admin;

/**
 * Simple class to add separators to the main WordPress admin left-sidebar
 * Initialize the class with a list (array or multiple arguments) of numbers
 * representing the menu index locations where separators should appear.
 * Separators will appear after the provided index.
 */
class Separators
{
    /**
     * seps - Flattened array of separator indexes
     *
     * @var
     */
    public $seps = [];

    public function __construct()
    {
        $this->parseArgs(func_get_args());
        // $this->seps = new \RecursiveIteratorIterator(new \RecursiveArrayIterator(func_get_args()));
        add_action("admin_menu", [$this, "addSeparators"]);
        add_action("admin_enqueue_scripts", [$this, "styleSeparators"], 100);
    }

    /**
     * parseArgs - Extract a flattened array from whatever mess the args
     * came as. They might be a list of numbers, a list of number-like strings,
     * an array of numbers or strings, or a mix of everything.
     *
     * Non-numeric strings should be rejected.
     * Duplicate indexes should be combined.
     *
     * @param  mixed $args
     * @return void
     */
    public function parseArgs($args)
    {
        $seps = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($args));
        foreach ($seps as $sep) {
            if (is_numeric($sep)) {
                // $this->seps[] = (int) $sep;
                $this->seps[] = floatval($sep);
            }
        }
        $this->seps = array_values(array_unique($this->seps));
    }

    /**
     * addSeparators - Directly adds separators to the admin menu.
     * Indexes are converted to floats so the separator will appear AFTER
     * any menu item with the same index.
     *
     * @return void
     */
    public function addSeparators()
    {
        global $menu;
        foreach ($this->seps as $pos) {
            /**
             * Add small float value to integers so they appear after any
             * matching menu items.
             */
            if (intval($pos) == $pos) {
                $pos += (count($menu) + 1) / 1000;
            }
            $menu["$pos"] = [
                0 => "",
                1 => "read",
                2 => "separator-$pos",
                3 => "",
                4 => "wp-menu-separator",
            ];
        }
        ksort($menu);
    }

    /**
     * styleSeparators - Injects inline styles for the separators.
     *
     * This is self-contained, unlike adminStyles in wp-data-model's CPT class.
     *
     * @return void
     */
    public function styleSeparators()
    {
        $css = '
            #adminmenu li.wp-menu-separator {
              margin: 6px 0;
            }
            #adminmenu li.wp-menu-separator .separator {
              border-top: 1px dotted rgba(255, 255, 255, 0.25);
            }
        ';
        wp_add_inline_style("wp-admin", $css);
    }
}
