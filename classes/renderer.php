<?php
// This file is part of Class list tool for Moodle
//
// Class list is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Advanced Spam Cleaner is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// For a copy of the GNU General Public License, see <http://www.gnu.org/licenses/>.

/**
 * Define renderer.
 *
 * @package    tool_classlist
 * @copyright  2013 Ankit Agarwal
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Renderer for tool_classlist
 *
 * Class tool_classlist_renderer
 */
class tool_classlist_renderer extends plugin_renderer_base {

    /**
     * Render classlist
     *
     * @return string
     */
    public function render_tool_classlist() {
        $html = $this->render_angular_table();
        return $html;
    }

    public function render_angular_table() {
        global $OUTPUT;
        $html = html_writer::start_div('', array('ng-app' => 'tool_classlist_table', 'ng-controller' => 'classList',
                'ng-init' => 'init()'));
        $html .= html_writer::tag('strong', 'Page:{{page}}(Perpage:{{perPage}})');

        // Filter controls.
        $html .= html_writer::start_div();

        $option = html_writer::tag('option', get_string('all'), array('value' => 0));
        $html .= get_string('select');
        $html .= html_writer::tag('select', $option, array('ng-model' => 'color', 'ng-options' => "comp.component as
                comp.component for comp in data"));

        $html .= get_string('filter');
        $html .= html_writer::tag('input', '', array('type' => 'text', 'ng-model' => 'query'));

        $html .= html_writer::tag('span', get_string('perpage', 'tool_classlist'));
        $html .= html_writer::tag('button', 10, array('ng-click' => 'updatePerPage(10)'));
        $html .= html_writer::tag('button', 25, array('ng-click' => 'updatePerPage(25)'));
        $html .= html_writer::tag('button', 50, array('ng-click' => 'updatePerPage(50)'));
        $html .= html_writer::tag('button', 100, array('ng-click' => 'updatePerPage(100)'));
        $html .= html_writer::tag('button', get_string('all'), array('ng-click' => 'updatePerPage(total)'));

        $html .= html_writer::tag('button', 'Show Next' , array('ng-show' => 'hasNext()', 'ng-click' => 'showNext()'));
        $html .= html_writer::tag('button', 'Show Previous' , array('ng-show' => 'hasPrevious()', 'ng-click' => 'showPrevious()'));

        $html .= html_writer::end_div();

        // Actual content.
        $iconasc = $OUTPUT->pix_icon('t/sort_asc', '', '', array('class' => 'iconsmall sorticon',
                'ng-show' => 'showSortingIcon(col, true)'));
        $icondesc = $OUTPUT->pix_icon('t/sort_desc', '', '', array('class' => 'iconsmall sorticon',
                'ng-show' => 'showSortingIcon(col, false)'));

        $link = html_writer::link('', '{{col}}', array('ng-click' => 'updateSorting(col)'));
        $th = html_writer::tag('th', $link . $iconasc . $icondesc, array('ng-repeat' => 'col in cols'));
        $tr = html_writer::tag('tr', $th);
        $td = html_writer::tag('td', '{{class[col]}}', array('ng-repeat' => 'col in cols'));
        $tr .= html_writer::tag('tr', $td, array('ng-repeat' => 'class in classes | filter:query'));
        $html .= html_writer::tag('table', $tr , array('class' => 'generaltable tool_classlist_table'));

        // Show next, previous.
        $html .= html_writer::start_div();
        $html .= html_writer::tag('button', 'Show Next' , array('ng-show' => 'hasNext()', 'ng-click' => 'showNext()'));
        $html .= html_writer::tag('button', 'Show Previous' , array('ng-show' => 'hasPrevious()', 'ng-click' => 'showPrevious()'));
        $html .= html_writer::end_div();

        $html .= html_writer::end_div();
        return $html;
    }
}